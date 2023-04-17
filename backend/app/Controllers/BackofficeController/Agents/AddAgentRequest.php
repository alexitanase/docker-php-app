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

class AddAgentRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->agentEmail)){
                throw new SecurityException("Agent email required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->agentPassword)){
                throw new SecurityException("Agent password required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->agentPasswordConf)){
                throw new SecurityException("Agent password confirmation required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if($this->params->agentPassword !== $this->params->agentPassword){
                throw new SecurityException("Passwords do not match.", ErrorEnum::GENERIC_ERROR());
            }
    
            if(empty($this->params->agentStatus)){
                throw new SecurityException("Agent status required.", ErrorEnum::GENERIC_ERROR());
            }
            
            $already_exists = AdminQuery::create()->findOneByEmail($this->params->agentEmail);
            
            if($already_exists!==null){
                throw new SecurityException("Email already exists", ErrorEnum::GENERIC_ERROR());
            }
    
            if(isset($this->params->agentStructure) && $this->params->agentStructure!==''){
                $structure = StructureQuery::create()->findOneByCode($this->params->agentStructure);
                if($structure===null) throw new SecurityException("Structure not found.", ErrorEnum::GENERIC_ERROR());
            }
    
            $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
            if(isset($this->params->agentStructure)){
                if(in_array($this->params->agentStructure, $array_allow_parents)){
                    $filterByParent = ($this->params->agentStructure === '' ? 'all' : $this->params->agentStructure);
                }
            }
    
            if(empty($filterByParent)) {
                throw new SecurityException(sprintf("Invalid structure."), ErrorEnum::GENERIC_ERROR());
            }
            
            $agent = new Admin();
            $agent->setEmail($this->params->agentEmail);
            $agent->setFullname((isset($this->params->agentFullname) ? $this->params->agentFullname : ''));
            $agent->setPasswd(md5($this->params->agentPassword));
            if(empty($this->params->agentType)) $agent->setType($this->params->agentType);
            $agent->setStatus(($this->params->agentStatus == 'ENABLED' ? AdminTableMap::COL_STATUS_ENABLED : AdminTableMap::COL_STATUS_DISABLED));
            $agent->setStructure((isset($this->params->agentStructure) && $this->params->agentStructure !== '' ? $this->params->agentStructure : ''));
            $agent->setLastAddress('');
            $agent->save();
            $agent->reload();
    
            $agent_name = $agent->getFullname();
            $agent_name = str_replace(',', ' ', $agent_name);
            $agent_name = str_replace('|', ' ', $agent_name);
            
            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1011);
            $history->setAffected('admin|'.$agent->getIntId().'|'.$agent_name);
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, ["AgentId"=>$agent->getIntId()]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}