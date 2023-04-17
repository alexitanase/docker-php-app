<?php

namespace App\Controllers\BackofficeController\Partners;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistory;
use PropelService\Map\PartnerTableMap;
use PropelService\PartnerQuery;

class EditStatusPartnerRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
    
            if(empty($this->params->partnerStatus)){
                throw new SecurityException("Partner status required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(strpos($this->params->internalId, ',') !== false){
                $partner_id = explode(',', $this->params->internalId);
            }else{
                $partner_id = $this->params->internalId;
            }
            
            if(is_array($partner_id)){
                $partners = PartnerQuery::create()->filterByIntId($partner_id)->find();
                $partners_name = [];
                
                foreach ($partners as $partner){
    
                    $partner->setStatus(($this->params->partnerStatus == 'ENABLED' ? PartnerTableMap::COL_STATUS_ENABLED : PartnerTableMap::COL_STATUS_DISABLED));
                    $partner->save();
                    $partner->reload();
                    
                    $partner_name = $partner->getName();
                    $partner_name = str_replace(',', ' ', $partner_name);
                    $partner_name = str_replace('|', ' ', $partner_name);
                    
                    array_push($partners_name, $partner_name);
                }
                
                $history = new AdminHistory();
                $history->setSessionId($this->session->getIntId());
                $history->setAdminId($this->agent->getIntId());
                $history->setAction(1028);
                $history->setAffected('partner|'.$this->params->internalId.'|'.implode(',', $partners_name));
                $history->save();
                
                $this->json_response(ErrorEnum::SUCCESS, ["PartnerId"=>$partner_id]);
            }else{
                $partner = PartnerQuery::create()->findOneByIntId($partner_id);
                
                if($partner===null){
                    throw new SecurityException('Partner not found.', ErrorEnum::GENERIC_ERROR());
                }
                
                $partner->setStatus(($this->params->partnerStatus == 'ENABLED' ? PartnerTableMap::COL_STATUS_ENABLED : PartnerTableMap::COL_STATUS_DISABLED));
                $partner->save();
                $partner->reload();
                
                $partner_name = $partner->getName();
                $partner_name = str_replace(',', ' ', $partner_name);
                $partner_name = str_replace('|', ' ', $partner_name);
                
                $history = new AdminHistory();
                $history->setSessionId($this->session->getIntId());
                $history->setAdminId($this->agent->getIntId());
                $history->setAction(1028);
                $history->setAffected('partner|'.$this->params->internalId.'|'.$partner_name);
                $history->save();
                
                $this->json_response(ErrorEnum::SUCCESS, ["PartnerId"=>$partner_id]);
            }
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}