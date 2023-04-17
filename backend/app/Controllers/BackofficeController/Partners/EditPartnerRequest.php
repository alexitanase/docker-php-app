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

class EditPartnerRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
    
            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
    
            if(empty($this->params->partnerCode)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
    
            $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
            if(isset($this->params->partnerStructure)){
                if(in_array($this->params->partnerStructure, $array_allow_parents)){
                    $filterByParent = ($this->params->partnerStructure === '' ? 'all' : $this->params->partnerStructure);
                }
            }
    
            if(empty($filterByParent)) {
                throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
            }
    
            $partner = PartnerQuery::create()->findOneByIntId($this->params->internalId);
    
            if($partner===null){
                throw new SecurityException("Partner not found.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(isset($this->params->partnerStructure) && $this->params->partnerStructure!==''){
                $structure = StructureQuery::create()->findOneByCode($this->params->partnerStructure);
                if($structure===null) throw new SecurityException("Structure not found.", ErrorEnum::GENERIC_ERROR());
            }
            
            $partner_options = $partner->getOptions(true);
            
            if(isset($this->params->services)){
                if(isset($partner_options['services'])){
                    $partner_options['services'] = [];
                }
                $toArrayServices = json_decode(json_encode($this->params->services), true);
                $resultado = array_merge($partner_options['services'], $toArrayServices);
                $partner_options['services'] = $resultado;
                $partner->setOptions($partner_options);
            }
    
            $partner->setName((isset($this->params->partnerName) ? $this->params->partnerName : ''));
            $partner->setCode((isset($this->params->partnerCode) ? $this->params->partnerCode : ''));
            $partner->setLogo((isset($this->params->partnerLogo) ? $this->params->partnerLogo : ''));
            if(empty($this->params->partnerStatus)){
                $partner->setStatus(PartnerTableMap::COL_STATUS_DISABLED);
            }else{
                if($this->params->partnerStatus === 'on') $partner->setStatus(PartnerTableMap::COL_STATUS_ENABLED);
            }
            $partner->setStructure((isset($this->params->partnerStructure) && $this->params->partnerStructure !== '' ? $this->params->partnerStructure : ''));
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