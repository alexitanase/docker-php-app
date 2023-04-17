<?php

namespace App\Controllers\BackofficeController;

use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistory;
use PropelService\AdminQuery;
use PropelService\AdminSession;
use PropelService\AdminSessionQuery;
use PropelService\Map\AdminSessionTableMap;
use CodeIgniter\HTTP\RequestInterface;

class LoginRequest
{
    private $params = [];
    protected $request;
    
    public function __construct($json, RequestInterface $request) {
        $this->params = $json;
    }
    
    public function run(){
        try{
    
            if(empty($this->params->email)){
                throw new SecurityException("Undefined email.", ErrorEnum::GENERIC_ERROR());
            }
    
            if(empty($this->params->password)){
                throw new SecurityException("Undefined password.", ErrorEnum::GENERIC_ERROR());
            }
            
            $admin = AdminQuery::create()->filterByEmail($this->params->email)->filterByPasswd(md5($this->params->password))->findOne();
            
            if($admin === null){
                throw new SecurityException("Invalid username/password.", ErrorEnum::GENERIC_ERROR());
            }
    
            $sessions = AdminSessionQuery::create()->filterByStatus(AdminSessionTableMap::COL_STATUS_VALID)->filterByAdminId($admin->getIntId())->getIterator();
    
            /**
             * @var AdminSession $session
             */
            foreach ($sessions as $session) {
                $session->setStatus(AdminSessionTableMap::COL_STATUS_INVALID);
                $session->save();
            }
            
            $session = new AdminSession();
            $session->setAdminId($admin->getIntId());
            $session->setToken(md5($admin->getIntId().time().$admin->getEmail()));
            $session->setIpAddress(@$_SERVER['REMOTE_ADDR']);
            $session->setExpireDate("+10 minutes");
            $session->setStatus(AdminSessionTableMap::COL_STATUS_VALID);
            $session->save();
            $session->reload();
            
            $history = new AdminHistory();
            $history->setSessionId($session->getIntId());
            $history->setAdminId($admin->getIntId());
            $history->setAction(1000);
            $history->setAffected('');
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, $session->getToken());
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
    protected function json_response($code, $message){
        die(json_encode(["resultCode"=>$code,"responseInfo"=>$message]));
    }
    
}