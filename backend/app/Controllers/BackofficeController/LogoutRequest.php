<?php

namespace App\Controllers\BackofficeController;

use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\Admin;
use PropelService\AdminHistory;
use PropelService\Map\AdminSessionTableMap;
use CodeIgniter\HTTP\RequestInterface;

class LogoutRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            $this->session->setStatus(AdminSessionTableMap::COL_STATUS_INVALID);
            $this->session->save();
            $this->session->reload();
    
            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1001);
            $history->setAffected('');
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, "Logout success");
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}