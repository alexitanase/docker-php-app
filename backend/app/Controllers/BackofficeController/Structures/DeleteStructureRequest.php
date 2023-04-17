<?php

namespace App\Controllers\BackofficeController\Structures;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistory;
use PropelService\SportQuery;
use PropelService\StructureQuery;

class DeleteStructureRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(strpos($this->params->internalId, ',') !== false){
                $structure_id = explode(',', $this->params->internalId);
            }else{
                $structure_id = $this->params->internalId;
            }
            
            if(is_array($structure_id)){
                $structures = StructureQuery::create()->filterByIntId($structure_id)->find();
                $structures_name = [];
                
                foreach ($structures as $structure){
                    
                    $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);

                    if(in_array($structure->getCode(), $array_allow_parents)){
                        $filterByParent = $structure->getCode();
                    }
    
                    if(empty($filterByParent)) {
                        throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
                    }
    
                    $structure_name = $structure->getName();
                    $structure_name = str_replace(',', ' ', $structure_name);
                    $structure_name = str_replace('|', ' ', $structure_name);
                    
                    array_push($structures_name, $structure_name);
                    
                    $structure->delete();
                }
    
                $history = new AdminHistory();
                $history->setSessionId($this->session->getIntId());
                $history->setAdminId($this->agent->getIntId());
                $history->setAction(1024);
                $history->setAffected('structure|'.$this->params->internalId.'|'.implode(',',$structures_name));
                $history->save();
                
                $this->json_response(ErrorEnum::SUCCESS, ["StructureIds"=>$structure_id]);
            }else{
                $structure = StructureQuery::create()->findOneByIntId($structure_id);
    
                $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
                if(in_array($structure->getCode(), $array_allow_parents)){
                    $filterByParent = $structure->getCode();
                }
                
                if($this->agent->getStructure() == ""){
                    $filterByParent = "OWNER";
                }
    
                if(empty($filterByParent)) {
                    throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
                }
                
                if($structure===null){
                    throw new SecurityException('Structure not found.', ErrorEnum::GENERIC_ERROR());
                }
    
                $structure_name = $structure->getName();
                $structure_name = str_replace(',', ' ', $structure_name);
                $structure_name = str_replace('|', ' ', $structure_name);
    
                $structure->delete();
    
                $history = new AdminHistory();
                $history->setSessionId($this->session->getIntId());
                $history->setAdminId($this->agent->getIntId());
                $history->setAction(1024);
                $history->setAffected('structure|'.$this->params->internalId.'|'.$structure_name);
                $history->save();
                
                $this->json_response(ErrorEnum::SUCCESS, ["StructureId"=>$structure_id]);
            }
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}