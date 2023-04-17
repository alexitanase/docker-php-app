<?php

namespace App\Controllers\BackofficeController\Agents;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminQuery;
use PropelService\Map\AdminTableMap;
use PropelService\StructureQuery;

class AgentsListRequest extends AbstractLoggedRequest
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
    
            if(isset($this->params->structure)){
                if(in_array($this->params->structure, $array_allow_parents)){
                    $filterByParent = $this->params->structure;
                }
            }
    
            if(empty($filterByParent)) $filterByParent = $this->agent->getStructure();
            
            if(isset($this->params->structure) && $this->params->structure == 'all'){
                $agents = AdminQuery::create()->filterByStructure($array_allow_parents)->orderByIntId(Criteria::ASC)->where(AdminTableMap::COL_EMAIL.' LIKE ?', '%' . @$search . '%')->paginate($page, $items);
            }else{
                $agents = AdminQuery::create()->filterByStructure($filterByParent)->orderByIntId(Criteria::ASC)->where(AdminTableMap::COL_EMAIL.' LIKE ?', '%' . @$search . '%')->paginate($page, $items);
            }
            
            $this->response_table([
                "data" => $agents->toArray(),
                "meta" => [
                    "field"     => "IntId",
                    "page"      => $page,
                    "pages"     => $agents->getLastPage(),
                    "perpage"   => $items,
                    "sort"      => "asc",
                    "total"     => $agents->getNbResults()
                ],
                "structures"    => $array_allow_parents
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