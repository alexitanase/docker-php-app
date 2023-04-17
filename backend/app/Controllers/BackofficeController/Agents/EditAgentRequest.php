<?php

namespace App\Controllers\BackofficeController\Agents;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\Admin;
use PropelService\AdminHistory;
use PropelService\AdminQuery;
use PropelService\Map\AdminTableMap;
use PropelService\StructureQuery;

class EditAgentRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
    
            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(isset($this->params->agentPassword) && isset($this->params->agentPasswordConf)){
                if($this->params->agentPassword !== $this->params->agentPasswordConf){
                    throw new SecurityException("Passwords do not match.", ErrorEnum::GENERIC_ERROR());
                }
                $new_password = md5($this->params->agentPassword);
            }
    
            $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
            if(isset($this->params->agentStructure)){
                if(in_array($this->params->agentStructure, $array_allow_parents)){
                    $filterByParent = ($this->params->agentStructure === '' ? 'all' : $this->params->agentStructure);
                }
            }
    
            if(empty($filterByParent)) {
                throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
            }

            if(empty($this->params->agentStatus)){
                throw new SecurityException("Agent status required.", ErrorEnum::GENERIC_ERROR());
            }
    
            $agent = AdminQuery::create()->findOneByIntId($this->params->internalId);
    
            if($agent===null){
                throw new SecurityException("Agent not found.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(isset($this->params->agentStructure) && $this->params->agentStructure!==''){
                $structure = StructureQuery::create()->findOneByCode($this->params->agentStructure);
                if($structure===null) throw new SecurityException("Structure not found.", ErrorEnum::GENERIC_ERROR());
            }
            
            $agent->setFullname((isset($this->params->agentFullname) ? $this->params->agentFullname : ''));
            $agent->setPhonenumber((isset($this->params->agentPhoneNumber) ? $this->params->agentPhoneNumber : ''));
            if(isset($new_password)) $agent->setPasswd($new_password);
            if(isset($this->params->agentType)) $agent->setType($this->params->agentType);
            $agent->setStatus(($this->params->agentStatus == 'ENABLED' ? AdminTableMap::COL_STATUS_ENABLED : AdminTableMap::COL_STATUS_DISABLED));
            $agent->setStructure((isset($this->params->agentStructure) && $this->params->agentStructure !== '' ? $this->params->agentStructure : ''));
            $agent->save();
            $agent->reload();
    
            $agent_name = $agent->getFullname();
            $agent_name = str_replace(',', ' ', $agent_name);
            $agent_name = str_replace('|', ' ', $agent_name);
    
            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1012);
            $history->setAffected('admin|'.$agent->getIntId().'|'.$agent_name);
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, ["AgentId"=>$agent->getIntId()]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}