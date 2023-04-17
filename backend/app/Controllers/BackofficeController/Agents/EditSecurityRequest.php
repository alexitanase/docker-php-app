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

class EditSecurityRequest extends AbstractLoggedRequest
{

    public function run(){
        try{

            if(empty($this->params->internalId)){
                throw new SecurityException("Internal id required.", ErrorEnum::GENERIC_ERROR());
            }

            $agent = AdminQuery::create()->findOneByIntId($this->params->internalId);

            if($agent===null){
                throw new SecurityException("Agent not found.", ErrorEnum::GENERIC_ERROR());
            }

            if($this->params->agentCallMeBotApiKey !== '' || $this->params->agentCallMeBotApiKey !== $agent->getCallMeBotApiKey()){
                if(empty($this->params->agentPhoneNumber) || strlen($this->params->agentPhoneNumber) < 6){
                    throw new SecurityException("Phone number of your profile must be set and valid.", ErrorEnum::GENERIC_ERROR());
                }
            }

            if($this->params->agentCallMeBotApiKey !== $agent->getCallMeBotApiKey()){
                function send_whatsapp($phoneNumber, $apiKey, $message="FeedHunt Services Alert"){
                    $phone=$phoneNumber;  // Enter your phone number here
                    $apikey=$apiKey;       // Enter your personal apikey received in step 3 above

                    $url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$phone.'&text='.urlencode($message).'&apikey='.$apikey;

                    if($ch = curl_init($url))
                    {
                        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        $html = curl_exec($ch);
                        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        // echo "Output:".$html;  // you can print the output for troubleshooting
                        curl_close($ch);

                        return (int) $status;
                    }
                    else
                    {
                        return false;
                    }
                }

                $response = send_whatsapp($this->params->agentPhoneNumber, $this->params->agentCallMeBotApiKey, "Feed Hunt Alert program | Service enabled and updated.");

                if($response == "203"){
                    throw new SecurityException("Your api key or phone number are incorrect, please make sure your details are correct.", ErrorEnum::GENERIC_ERROR());
                }
            }

            $agent->setCallMeBotApiKey((isset($this->params->agentCallMeBotApiKey) && $this->params->agentCallMeBotApiKey !== '' ? $this->params->agentCallMeBotApiKey : ''));
            $agent->save();
            $agent->reload();

            $agent_name = $agent->getFullname();
            $agent_name = str_replace(',', ' ', $agent_name);
            $agent_name = str_replace('|', ' ', $agent_name);

            $history = new AdminHistory();
            $history->setSessionId($this->session->getIntId());
            $history->setAdminId($this->agent->getIntId());
            $history->setAction(1115);
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