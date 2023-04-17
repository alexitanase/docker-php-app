<?php

namespace App\Controllers;

use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Apps\AppResponderFactory;
use PropelService\Map\PartnerTableMap;
use PropelService\PartnerQuery;

class IntegrationController extends BaseController
{
    
    public function run($partner_code, $application = 'local')
    {
        try {
            
            $partner = PartnerQuery::create()->findOneByCode($partner_code);
            
            if(is_null($partner)){
                throw new SecurityException("Invalid partner", ErrorEnum::GENERIC_ERROR());
            }
            
            if($partner->getStatus() == PartnerTableMap::COL_STATUS_DISABLED){
                throw new SecurityException("Partner disabled", ErrorEnum::GENERIC_ERROR());
            }
            
            $partner_options = $partner->getOptions(true);
            
            if(empty($partner_options['services']) || isset($partner_options['services']) && empty($partner_options['services'][$application]) || isset($partner_options['services']) && isset($partner_options['services'][$application]) && $partner_options['services'][$application]['status'] == 'disabled'){
                throw new SecurityException(sprintf("Service disabled (%s)", $application), ErrorEnum::GENERIC_ERROR());
            }
    
            $responder = AppResponderFactory::getInstance($partner, $application);
            $responder->service_options = $partner_options['services'][$application];
            $responder->handleRequest($this->request);
            
        }catch (SecurityException $e){
            $this->sendResponse($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->sendResponse($e->getCode(), $e->getMessage());
        }catch (\Throwable $e) {
            $this->sendResponse($e->getCode(), $e->getMessage());
        }
    }
    
    private function sendResponse($code, $info){
        header('Content-type: application/json');
        die(json_encode(["resultCode"=>$code,"responseInfo"=>$info]));
    }
    
}