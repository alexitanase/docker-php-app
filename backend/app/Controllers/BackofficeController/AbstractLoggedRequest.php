<?php

namespace App\Controllers\BackofficeController;

use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use CodeIgniter\HTTP\RequestInterface;
use Predis\Client;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminSessionQuery;
use PropelService\AdminSession;
use PropelService\Admin;
use PropelService\Map\AdminSessionTableMap;
use PropelService\Map\AdminTableMap;

abstract class AbstractLoggedRequest {
    
    protected $request;
    protected AdminSession $session;
    protected Admin $agent;
    protected Client $client;
    
    public function __construct($json, RequestInterface $request) {
        $this->params = $json;
        $this->request = $request;
        $this->logged_check();
    }
    
    public function logged_check(){
        try{
        
            $token = $this->request->getHeaderLine('authorization');
        
            if($token===null||$token===''){
                throw new SecurityException("Undefined token.", ErrorEnum::INTERNAL_ERROR());
            }
        
            $session = AdminSessionQuery::create()->filterByStatus(AdminSessionTableMap::COL_STATUS_VALID)->findOneByToken($token);
        
            if($session===null){
                throw new SecurityException("Invalid session.", ErrorEnum::INTERNAL_ERROR());
            }
        
            if($session->getAdmin()->getStatus() != AdminTableMap::COL_STATUS_ENABLED){
                throw new SecurityException("Agent disabled.", ErrorEnum::INTERNAL_ERROR());
            }
        
            /*if($session->getIpAddress() !== @$_SERVER['REMOTE_ADDR']){
                $session->setStatus(AdminSessionTableMap::COL_STATUS_INVALID);
                $session->save();
                throw new SecurityException("IP changed, session closed.", ErrorEnum::INTERNAL_ERROR());
            }*/
            
            $this->session = $session;
            $this->agent   = $session->getAdmin();
    
            $session->setExpireDate("+10 minutes");
            $session->save();
        
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response(ErrorEnum::GENERIC_ERROR, $e->getMessage());
        }
    }
    
    protected function json_response($code, $message){
        die(json_encode(["resultCode"=>$code,"responseInfo"=>$message]));
    }

    protected function startRedisClient() : bool{
        if(isset($_ENV['REDIS'])){
            $this->client = new Client(@$_ENV['REDIS']);
            return true;
        }else{
            return false;
        }
    }
    
}