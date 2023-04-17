<?php

namespace App\Controllers\BackofficeController\Partners;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistory;
use PropelService\Map\PartnerTableMap;
use PropelService\PartnerQuery;
use PropelService\StructureQuery;

class UninstallAppRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->appCode)){
                throw new SecurityException("Application code required.", ErrorEnum::GENERIC_ERROR());
            }
            
            $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
            
            $partner = PartnerQuery::create()->findOneByIntId($this->params->internalId);
            
            if($partner===null){
                throw new SecurityException("Partner not found.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(in_array($partner->getStructure(), $array_allow_parents)){
                $filterByParent = ($partner->getStructure() === '' ? 'all' : $partner->getStructure());
            }
    
            if(empty($filterByParent)) {
                throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
            }
            
            
            $options = $partner->getOptions(true);
            if (empty($options['services'][$this->params->appCode])){
                $options['services'][$this->params->appCode] = [
                    "status"  => "disabled",
                    "options" => []
                ];
            }else{
                $options['services'][$this->params->appCode]['status'] = 'disabled';
            }
            $partner->setOptions($options);
            $partner->save();
            $partner->reload();
    
            $partner_name = $partner->getName();
            $partner_name = str_replace(',', ' ', $partner_name);
            $partner_name = str_replace('|', ' ', $partner_name);
    
            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1027);
            $history->setAffected('partner|'.$partner->getIntId().'|'.$partner_name);
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, ["PartnerId"=>$partner->getIntId()]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}