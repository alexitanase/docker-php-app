<?php

namespace App\Controllers\BackofficeController;

use App\Controllers\BackofficeController\Agents\AgentsListRequest;
use App\Controllers\BackofficeController\Agents\AddAgentRequest;
use App\Controllers\BackofficeController\Agents\DeleteAgentRequest;
use App\Controllers\BackofficeController\Agents\EditAgentRequest;
use App\Controllers\BackofficeController\Agents\EditStatusAgentRequest;
use App\Controllers\BackofficeController\Agents\SessionDetailsRequest;
use App\Controllers\BackofficeController\Agents\SessionsAgentListRequest;
use App\Controllers\BackofficeController\Events\EventsListRequest;
use App\Controllers\BackofficeController\Events\SaveEventDetailsRequest;
use App\Controllers\BackofficeController\Partners\AddPartnerRequest;
use App\Controllers\BackofficeController\Partners\DeletePartnerRequest;
use App\Controllers\BackofficeController\Partners\EditPartnerRequest;
use App\Controllers\BackofficeController\Partners\EditStatusPartnerRequest;
use App\Controllers\BackofficeController\Partners\InstallAppRequest;
use App\Controllers\BackofficeController\Partners\PartnersListRequest;
use App\Controllers\BackofficeController\Partners\UninstallAppRequest;
use App\Controllers\BackofficeController\Events\SaveEventNameRequest;
use App\Controllers\BackofficeController\Reports\PerformanceRequest;
use App\Controllers\BackofficeController\Reports\TopSportsRequest;
use App\Controllers\BackofficeController\Sports\AddCategoryRequest;
use App\Controllers\BackofficeController\Sports\AddGroupRequest;
use App\Controllers\BackofficeController\Sports\AddSportRequest;
use App\Controllers\BackofficeController\Sports\CategoriesListRequest;
use App\Controllers\BackofficeController\Sports\DeleteCategoryRequest;
use App\Controllers\BackofficeController\Sports\DeleteSportRequest;
use App\Controllers\BackofficeController\Sports\EditCategoryRequest;
use App\Controllers\BackofficeController\Sports\EditGroupRequest;
use App\Controllers\BackofficeController\Sports\EditSportRequest;
use App\Controllers\BackofficeController\Sports\EditStatusGroupRequest;
use App\Controllers\BackofficeController\Sports\EditStatusSportRequest;
use App\Controllers\BackofficeController\Sports\GroupsListRequest;
use App\Controllers\BackofficeController\Sports\SportsListRequest;
use App\Controllers\BackofficeController\Structures\AddStructureRequest;
use App\Controllers\BackofficeController\Structures\DeleteStructureRequest;
use App\Controllers\BackofficeController\Structures\EditStatusStructureRequest;
use App\Controllers\BackofficeController\Structures\EditStructureRequest;
use App\Controllers\BackofficeController\Structures\StructuresListRequest;
use App\Controllers\BackofficeController\Agents\EditSecurityRequest;
use CodeIgniter\HTTP\RequestInterface;

class RequestFactory
{
    /**
     * @param string $json_str
     * @return mixed
     */
    public static function factory(string $json_str, RequestInterface $request)
    {
        $json = json_decode($json_str);
        if(empty($json->opType)){
            return new UndefinedRequest($json);
        }
        $request_type = new RequestTypeEnum($json->opType);
        switch ($request_type) {
            case $request_type::LOGIN():
                return new LoginRequest($json, $request);
                break;
            case $request_type::LOGOUT():
                return new LogoutRequest($json, $request);
                break;
            case $request_type::ME():
                return new MeRequest($json, $request);
                break;
            case $request_type::SESSIONS():
                return new SessionsAgentListRequest($json, $request);
                break;
            case $request_type::SESSION_DETAILS():
                return new SessionDetailsRequest($json, $request);
                break;
            case $request_type::AGENTS_LIST():
                return new AgentsListRequest($json, $request);
                break;
            case $request_type::ADD_AGENT():
                return new AddAgentRequest($json, $request);
                break;
            case $request_type::EDIT_AGENT():
                return new EditAgentRequest($json, $request);
                break;
            case $request_type::STATUS_AGENT():
                return new EditStatusAgentRequest($json, $request);
                break;
            case $request_type::DELETE_AGENT():
                return new DeleteAgentRequest($json, $request);
                break;
            case $request_type::STRUCTURES_LIST():
                return new StructuresListRequest($json, $request);
                break;
            case $request_type::ADD_STRUCTURE():
                return new AddStructureRequest($json, $request);
                break;
            case $request_type::EDIT_STRUCTURE():
                return new EditStructureRequest($json, $request);
                break;
            case $request_type::STATUS_STRUCTURE():
                return new EditStatusStructureRequest($json, $request);
                break;
            case $request_type::DELETE_STRUCTURE():
                return new DeleteStructureRequest($json, $request);
                break;
            case $request_type::PARTNERS_LIST():
                return new PartnersListRequest($json, $request);
                break;
            case $request_type::ADD_PARTNER():
                return new AddPartnerRequest($json, $request);
                break;
            case $request_type::EDIT_PARTNER():
                return new EditPartnerRequest($json, $request);
                break;
            case $request_type::DELETE_PARTNER():
                return new DeletePartnerRequest($json, $request);
                break;
            case $request_type::STATUS_PARTNER():
                return new EditStatusPartnerRequest($json, $request);
                break;
            case $request_type::APPS_LIST():
                return new AppsListRequest($json, $request);
                break;
            case $request_type::INSTALL_APP():
                return new InstallAppRequest($json, $request);
                break;
            case $request_type::UNINSTALL_APP():
                return new UninstallAppRequest($json, $request);
                break;
            case $request_type::EDIT_SECURITY():
                return new EditSecurityRequest($json, $request);
                break;
            default:
                return new UndefinedRequest($json);
                break;
        }
    }
}