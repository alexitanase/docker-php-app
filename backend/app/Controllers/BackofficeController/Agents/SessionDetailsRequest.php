<?php

namespace App\Controllers\BackofficeController\Agents;

use App\Controllers\BackofficeController\AbstractLoggedRequest;
use App\Controllers\BackofficeController\RequestTypeDetails;
use App\Enum\ErrorEnum;
use App\Enum\Exception\SecurityException;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminHistoryQuery;

class SessionDetailsRequest extends AbstractLoggedRequest
{
    
    public function run(){
        try{
            
            if(empty($this->params->sessionId)){
                throw new SecurityException("Session id required.", ErrorEnum::GENERIC_ERROR());
            }
            
            $detailsActions = new RequestTypeDetails();
            
            $histories = AdminHistoryQuery::create()->filterBySessionId($this->params->sessionId)->find();
            
            $array = [];
            foreach ($histories as $history){
                $detailsAction =$detailsActions->getActionDetails(intval($history->getAction()));
                array_push($array, [
                    "IntId"         => $history->getIntId(),
                    "AdminId"       => $history->getAdminId(),
                    "Action"        => $history->getAction(),
                    "ActionTitle"   => $detailsAction['title'],
                    "ActionDesc"    => $detailsAction['description'],
                    "SessionId"     => $history->getSessionId(),
                    "Affected"      => $history->getAffected(),
                    "CreatedAt"     => $history->getCreatedAt()->getTimestamp(),
                    "UpdatedAt"     => $history->getUpdatedAt()->getTimestamp()
                ]);
            }
            
            $this->json_response(ErrorEnum::SUCCESS, $array);
            
        }catch (SecurityException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (PropelException $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
}