<?php

namespace App\Controllers\BackofficeController\Structures;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistory;
use PropelService\Structure;
use PropelService\StructureQuery;

class AddStructureRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->structureName)){
                throw new SecurityException("Structure name required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->structureCode)){
                throw new SecurityException("Structure code required.", ErrorEnum::GENERIC_ERROR());
            }
            
            $exists = StructureQuery::create()->findOneByCode($this->params->structureCode);
            
            if($exists!==null){
                throw new SecurityException(sprintf("Structure with the code '%s' already exists.", $this->params->structureCode), ErrorEnum::GENERIC_ERROR());
            }
    
            $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
    
            if(isset($this->params->structureParent)){
                if(in_array($this->params->structureParent, $array_allow_parents)){
                    $filterByParent = ($this->params->structureParent === '' ? 'all' : $this->params->structureParent);
                }
            }
    
            if(empty($filterByParent)) {
                throw new SecurityException("Invalid structure.", ErrorEnum::GENERIC_ERROR());
            }
            
            $structure = new Structure();
            $structure->setName($this->params->structureName);
            $structure->setCode($this->params->structureCode);
            $structure->setParent((empty($this->params->structureParent) ? '' : $this->params->structureParent));
            if(empty($this->params->structureStatus)) $structure->setStatus($this->params->structureStatus);
            $structure->setContent([]);
            $structure->save();
            $structure->reload();
    
            $structure_name = $structure->getName();
            $structure_name = str_replace(',', ' ', $structure_name);
            $structure_name = str_replace('|', ' ', $structure_name);
    
            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1021);
            $history->setAffected('structure|'.$structure->getIntId().'|'.$structure_name);
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, ["StructureId"=>$structure->getIntId()]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}