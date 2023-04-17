<?php

namespace App\Controllers\BackofficeController\Structures;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use PropelService\Map\StructureTableMap;
use PropelService\StructureQuery;

class StructuresListRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
    
            if(isset($this->params->pagination->page)){
                $page = intval($this->params->pagination->page);
            }else{
                $page = 1;
            }
    
            $items_allowed = [10, 20, 30, 50, 100];
            if(isset($this->params->pagination->perpage) && in_array($this->params->pagination->perpage, $items_allowed)){
                $items = intval($this->params->pagination->perpage);
            }else{
                $items = 10;
            }
            
            if(isset($this->params->query)){
                if(isset($this->params->query->generalSearch)){
                    $search = $this->params->query->generalSearch;
                }
            }
            
            $array_allow_parents = StructureQuery::create()->getArrayStructures($this->agent->getStructure(), []);
            
            if(isset($this->params->parent)){
                if(in_array($this->params->parent, $array_allow_parents)){
                    $filterByParent = $this->params->parent;
                }
            }
            
            if(empty($filterByParent)) $filterByParent = $this->agent->getStructure();
            
            $structures = StructureQuery::create()->filterByParent($filterByParent)->orderByIntId(Criteria::ASC)->where(StructureTableMap::COL_NAME.' LIKE ?', '%' . @$search . '%')->paginate($page, $items);
            
            $this->response_table([
                  "data"      => $structures->toArray(),
                  "meta"      => [
                      "field"     => "IntId",
                      "page"      => $page,
                      "pages"     => $structures->getLastPage(),
                      "perpage"   => $items,
                      "sort"      => "asc",
                      "total"     => $structures->getNbResults()
                  ]
            ]);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
    private function response_table($table){
        die(json_encode($table));
    }
    
}