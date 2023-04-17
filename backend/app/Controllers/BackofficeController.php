<?php

namespace App\Controllers;

use App\Controllers\BackofficeController\RequestFactory;
use App\Enum\ErrorEnum;
use PropelService\AdminSessionQuery;
use PropelService\Map\AdminSessionTableMap;
use Propel\Runtime\Exception\PropelException;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Enum\Exception\SecurityException;

class BackofficeController extends BaseController
{
    
    public function html($page = '', $subpage = '', $item = '')
    {
        helper('cookie');
        try {
            $token = get_cookie('RL_BO_TOKEN');
            if($token === null){
                $logged = false;
            }else{
                $logged = true;
            }
    
            if($logged){
                $session = AdminSessionQuery::create()->filterByStatus(AdminSessionTableMap::COL_STATUS_VALID)->findOneByToken($token);
    
                if($session === null){
                    return view('bo/login');
                }
                
                if($session->getExpireDate()->getTimestamp() < time()){
                    $session->setStatus(AdminSessionTableMap::COL_STATUS_INVALID);
                    $session->save();
                    return view('bo/login');
                }
                
                try {
                    $admin = $session->getAdmin();
                    return view('bo/logged', [
                        "basePath"   => '/bo',
                        "ms"         => '/',
                        "as"         => '/bo/api',
                        "session"    => [
                            "token"      => $token,
                            "name"       => ($admin->getFullname() === null ? explode('@', $admin->getEmail())[0] : $admin->getFullname()),
                            "email"      => $admin->getEmail(),
                            "structure"  => $admin->getStructure()
                        ],
                        "page"=>$page,
                        "subpage"=>$subpage,
                        "item"=>$item,
                    ]);
                }catch (\Exception $e){
                    throw PageNotFoundException::forPageNotFound(($_SERVER['CI_ENVIRONMENT'] == 'development' ? $e : ''));
                }
            }else{
                return view('bo/login');
            }
        }catch (PropelException $e){
            throw PageNotFoundException::forPageNotFound();
        }
    }
    
    public function api(){
        try {
    
            $request_json = file_get_contents('php://input');
    
            if (!empty($_POST)) {
                $request_json = json_encode($_POST);
            }
            
            if (isset($_POST["info"])) {
                $request_json = $_POST["info"];
            }
    
            $Interface = RequestFactory::factory($request_json, $this->request);
    
            $Interface->run();
            
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
