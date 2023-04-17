<?php

namespace App\Controllers\BackofficeController\Partners;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\Admin;
use PropelService\AdminHistory;
use PropelService\AdminQuery;
use PropelService\Map\AdminTableMap;
use PropelService\Map\PartnerTableMap;
use PropelService\Partner;
use PropelService\PartnerQuery;
use PropelService\StructureQuery;

class AddPartnerRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->partnerName)){
                throw new SecurityException("Partner name required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->partnerCode)){
                throw new SecurityException("Partner code required.", ErrorEnum::GENERIC_ERROR());
            }
    
            if(empty($this->params->partnerStatus)){
                throw new SecurityException("Partner status required.", ErrorEnum::GENERIC_ERROR());
            }
            
            $already_exists = PartnerQuery::create()->findOneByCode($this->params->partnerCode);
            
            if($already_exists!==null){
                throw new SecurityException(sprintf("Partner already exists with code '%s'", $this->params->partnerCode), ErrorEnum::GENERIC_ERROR());
            }
    
            if(isset($this->params->partnerStructure) && $this->params->partnerStructure!==''){
                $structure = StructureQuery::create()->findOneByCode($this->params->partnerStructure);
                if($structure===null) throw new SecurityException("Structure not found.", ErrorEnum::GENERIC_ERROR());
            }
    
            $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
            if(isset($this->params->partnerStructure)){
                if(in_array($this->params->partnerStructure, $array_allow_parents)){
                    $filterByParent = ($this->params->partnerStructure === '' ? 'all' : $this->params->partnerStructure);
                }
            }
    
            if(empty($filterByParent)) {
                throw new SecurityException(sprintf("Invalid structure."), ErrorEnum::GENERIC_ERROR());
            }
            
            $partner = new Partner();
            $partner->setName($this->params->partnerName);
            $partner->setCode($this->params->partnerCode);
            $partner->setLogo((isset($this->params->partnerLogo) ? $this->params->partnerLogo : ''));
            $partner->setStatus(($this->params->partnerStatus == 'ENABLED' ? PartnerTableMap::COL_STATUS_ENABLED : PartnerTableMap::COL_STATUS_DISABLED));
            $partner->setStructure((isset($this->params->partnerStructure) && $this->params->partnerStructure !== '' ? $this->params->partnerStructure : ''));
            $partner->save();
            $partner->reload();
    
            $partner_name = $partner->getName();
            $partner_name = str_replace(',', ' ', $partner_name);
            $partner_name = str_replace('|', ' ', $partner_name);
    
            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1026);
            $history->setAffected('partner|'.$partner->getIntId().'|'.$partner_name);
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, ["PartnerId"=>$partner->getIntId()]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}