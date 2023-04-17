<?php

namespace App\Controllers\BackofficeController\Agents;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminSessionQuery;

class SessionsAgentListRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
    
            if(empty($this->params->agentId)){
                throw new SecurityException("Agent id required.", ErrorEnum::GENERIC_ERROR());
            }
    
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
            
            if(isset($this->params->structure) && $this->params->structure == 'all'){
                $sessions = AdminSessionQuery::create()->filterByAdminId($this->params->agentId)->orderByUpdatedAt(Criteria::DESC)->paginate($page, $items);
            }else{
                $sessions = AdminSessionQuery::create()->filterByAdminId($this->params->agentId)->orderByUpdatedAt(Criteria::DESC)->paginate($page, $items);
            }
            
            $this->response_table([
                "data" => $sessions->toArray(),
                "meta" => [
                    "field"     => "IntId",
                    "page"      => $page,
                    "pages"     => $sessions->getLastPage(),
                    "perpage"   => $items,
                    "sort"      => "asc",
                    "total"     => $sessions->getNbResults()
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