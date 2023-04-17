<?php

namespace App\Controllers\BackofficeController\Agents;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistory;
use PropelService\AdminQuery;
use PropelService\Map\AdminTableMap;
use PropelService\StructureQuery;

class EditStatusAgentRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->agentStatus)){
                throw new SecurityException("Sport status required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(strpos($this->params->internalId, ',') !== false){
                $agent_id = explode(',', $this->params->internalId);
            }else{
                $agent_id = $this->params->internalId;
            }
            
            if(is_array($agent_id)){
                $agents = AdminQuery::create()->filterByIntId($agent_id)->find();
                $agents_names = [];
                
                foreach ($agents as $agent){
                    $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
                    if(in_array($agent->getStructure(), $array_allow_parents)){
                        $filterByParent = $agent->getStructure();
                    }
    
                    if($this->agent->getStructure() == ""){
                        $filterByParent = "OWNER";
                    }
    
                    if(empty($filterByParent)) {
                        throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
                    }
                    
                    $agent_name = $agent->getFullname();
                    $agent_name = str_replace(',', ' ', $agent_name);
                    $agent_name = str_replace('|', ' ', $agent_name);
    
                    array_push($agents_names, $agent_name);
                    
                    $agent->setStatus(($this->params->agentStatus == 'ENABLED' ? AdminTableMap::COL_STATUS_ENABLED : AdminTableMap::COL_STATUS_DISABLED));
                    $agent->save();
                    $agent->reload();
                }
    
                $history = new AdminHistory();
                $history->setSessionId($this->session->getIntId());
                $history->setAdminId($this->agent->getIntId());
                $history->setAction(1013);
                $history->setAffected('admin|'.$this->params->internalId.'|'.implode(',', $agents_names));
                $history->save();
    
                $this->json_response(ErrorEnum::SUCCESS, ["AgentIds"=>$agent_id]);
            }else{
                $agent = AdminQuery::create()->findOneByIntId($agent_id);
    
                $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
                if(in_array($agent->getStructure(), $array_allow_parents)){
                    $filterByParent = $agent->getStructure();
                }
                
                if($agent->getStructure() == ""){
                    $filterByParent = "OWNER";
                }
    
                if(empty($filterByParent)) {
                    throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
                }
    
                if($agent===null){
                    throw new SecurityException('Agent not found.', ErrorEnum::GENERIC_ERROR());
                }
    
                $agent->setStatus(($this->params->agentStatus == 'ENABLED' ? AdminTableMap::COL_STATUS_ENABLED : AdminTableMap::COL_STATUS_DISABLED));
                $agent->save();
                $agent->reload();
    
                $agent_name = $agent->getFullname();
                $agent_name = str_replace(',', ' ', $agent_name);
                $agent_name = str_replace('|', ' ', $agent_name);
    
                $history = new AdminHistory();
                $history->setSessionId($this->session->getIntId());
                $history->setAdminId($this->agent->getIntId());
                $history->setAction(1013);
                $history->setAffected('admin|'.$this->params->internalId.'|'.$agent_name);
                $history->save();
    
                $this->json_response(ErrorEnum::SUCCESS, ["AgentId"=>$agent_id]);
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