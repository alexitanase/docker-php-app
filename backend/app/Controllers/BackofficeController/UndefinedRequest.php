<?php

namespace App\Controllers\BackofficeController;

use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;

class UndefinedRequest
{
    private $params = [];
    
    public function __construct($json) {
        $this->params = $json;
    }
    
    public function run(){
        try{
            
            $this->json_response(ErrorEnum::GENERIC_ERROR, "Invalid operation.");
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
    protected function json_response($code, $message){
        die(json_encode(["resultCode"=>$code,"responseInfo"=>$message]));
    }
    
}