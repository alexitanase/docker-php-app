<?php

namespace App\Controllers\BackofficeController;

use App\Enum\ErrorEnum;
use Apps\ListAppsEnum;
use Apps\ListTypesAppEnum;

class AppsListRequest extends AbstractLoggedRequest {
    
    public function run(){
        try{
    
            $oClass = new \ReflectionClass(ListAppsEnum::class);
    
            $permissions = array_map(fn($p) => $this->getDetails($p), array_values($oClass->getConstants()));
            
            $this->json_response(ErrorEnum::SUCCESS, $permissions);
            
        }catch (\Exception $e){
            $this->json_response($e->getCode(), $e->getMessage());
        }
    }
    
    private function getDetails(string $code) {
        $permissions = array_values(array_filter($this->details, fn($d) => $d["code"] === $code));
		
		return $permissions[0];
	}
    
    private $details = [
        /*[
            "icon"          => '<i class="fab fa-vuejs"></i>',
            "code"          => ListAppsEnum::TEMPLATE_JVS_VUE,
            "title"         => 'Template for JVS (VUE)',
            "description"   => 'VUEJS based template for betting applications.',
            "type"          => ListTypesAppEnum::APPLICATION
        ],*/
        [
            "icon"          => '<i class="fa fa-location-arrow"></i>',
            "code"          => ListAppsEnum::TRACKER,
            "title"         => 'Tracker',
            "description"   => 'Live-Sports event tracker.',
            "type"          => ListTypesAppEnum::WIDGET
        ],
        [
            "icon"          => '<i class="fas fa-tv"></i>',
            "code"          => ListAppsEnum::STREAMING,
            "title"         => 'Streaming',
            "description"   => 'Live-Sports event streaming.',
            "type"          => ListTypesAppEnum::API
        ]
    ];
    
}