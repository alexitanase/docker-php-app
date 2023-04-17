<?php

namespace App\Controllers\BackofficeController\Structures;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistory;
use PropelService\Map\SportTableMap;
use PropelService\Map\StructureTableMap;
use PropelService\Sport;
use PropelService\SportQuery;
use PropelService\StructureQuery;

class EditStructureRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->structureName)){
                throw new SecurityException("Structure name required.", ErrorEnum::GENERIC_ERROR());
            }
            
            if(empty($this->params->structureCode)){
                throw new SecurityException("Structure code required.", ErrorEnum::GENERIC_ERROR());
            }
            
            $structure = StructureQuery::create()->findOneByIntId($this->params->internalId);
            
            if($structure===null){
                throw new SecurityException("Structure not found.", ErrorEnum::GENERIC_ERROR());
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
            
            $structure->setName($this->params->structureName);
            $structure->setCode($this->params->structureCode);
            if(empty($this->params->structureStatus)){
                $structure->setStatus(StructureTableMap::COL_STATUS_DISABLED);
            }else{
                if($this->params->structureStatus == 'on') $structure->setStatus(StructureTableMap::COL_STATUS_ENABLED);
            }
            $structure->setParent((empty($this->params->structureParent) ? '' : $this->params->structureParent));
            $structure->save();
            $structure->reload();
    
            $structure_name = $structure->getName();
            $structure_name = str_replace(',', ' ', $structure_name);
            $structure_name = str_replace('|', ' ', $structure_name);
            
            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1022);
            $history->setAffected('structure|'.$structure->getIntId().'|'.$structure_name);
            $history->save();
            
            $this->json_response(ErrorEnum::SUCCESS, ["StructureId"=>$structure->getIntId()]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}