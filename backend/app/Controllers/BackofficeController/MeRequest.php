<?php

namespace App\Controllers\BackofficeController;

use Throwable;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;

class MeRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            $admin = $this->session->getAdmin();
            
            $this->json_response(ErrorEnum::SUCCESS, [
                "id"            => $admin->getIntId(),
                "user"          => $admin->getEmail(),
                "name"          => $admin->getFullname(),
                "ip_address"    => $this->session->getIpAddress()
            ]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response(ErrorEnum::GENERIC_ERROR, $e->getMessage());
        }catch (Throwable $e){
            $this->json_response(ErrorEnum::GENERIC_ERROR, $e->getMessage());
        }
    }
    
}