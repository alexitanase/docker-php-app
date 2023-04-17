<?php


namespace App\Controllers\BackofficeController;

class RequestTypeDetails {
    
    protected $requestListDetails = [
        1000 => [
            "title"          => "Login to Backoffice",
            "description"    => "Agent logged into Backoffice own account."
        ],
        1001 => [
            "title"          => "Logout from Backoffice",
            "description"    => "Agent logged-out into Backoffice own account."
        ],
        1011 => [
            "title"          => "Add new Agent account",
            "description"    => "Agent has added a new agent account."
        ],
        1012 => [
            "title"          => "Edit old Agent account",
            "description"    => "Agent has edited a old agent account."
        ],
        1013 => [
            "title"          => "Edit status old Agent account",
            "description"    => "Agent has edited a status to old agent account."
        ],
        1014 => [
            "title"          => "Remove old Agent account",
            "description"    => "Agent has removed a old agent account."
        ],
        1016 => [
            "title"          => "Add new Sport",
            "description"    => "Agent has added a new sport."
        ],
        1017 => [
            "title"          => "Edit old Sport",
            "description"    => "Agent has edited a old sport."
        ],
        1018 => [
            "title"          => "Edit status old Sport",
            "description"    => "Agent has edited a status to old sport."
        ],
        1019 => [
            "title"          => "Remove old Sport",
            "description"    => "Agent has removed a old sport."
        ],
        1021 => [
            "title"          => "Add new Structure",
            "description"    => "Agent has added a new structure."
        ],
        1022 => [
            "title"          => "Edit old Structure",
            "description"    => "Agent has edited a old sport."
        ],
        1023 => [
            "title"          => "Edit status old Structure",
            "description"    => "Agent has edited a status to old structure."
        ],
        1024 => [
            "title"          => "Remove old Structure",
            "description"    => "Agent has removed a old structure."
        ],
        1026 => [
            "title"          => "Add new Partner",
            "description"    => "Agent has added a new partner."
        ],
        1027 => [
            "title"          => "Edit old Partner",
            "description"    => "Agent has edited a old partner."
        ],
        1028 => [
            "title"          => "Edit status old Partner",
            "description"    => "Agent has edited a status to old partner."
        ],
        1029 => [
            "title"          => "Remove old Partner",
            "description"    => "Agent has removed a old partner."
        ],
        1030 => [
            "title"          => "Add new Sport Category",
            "description"    => "Agent has added a new sport category."
        ],
        1031 => [
            "title"          => "Remove old Sport Category",
            "description"    => "Agent has removed a old sport category."
        ],
        1032 => [
            "title"          => "Edit old Sport Category",
            "description"    => "Agent has edited a old sport category."
        ],
        1033 => [
            "title"          => "Add new Sport Group",
            "description"    => "Agent has added a new sport group."
        ],
        1115 => [
            "title"          => "Edit admin security options",
            "description"    => "Agent has edited his security options."
        ],
        1034 => [
            "title"          => "Edit old Sport Status",
            "description"    => "Agent has edited a old sport group."
        ],
        1035 => [
            "title"          => "Edit old Sport Group",
            "description"    => "Agent has edited a old sport group."
        ],
    ];
    
    public function getActionDetails($action){
        if(isset($this->requestListDetails[$action])){
            return $this->requestListDetails[$action];
        }else return ["title" => "Action not found", "description" => "Action not found."];
    }
    
}