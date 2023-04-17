<?php

namespace Apps;

use PropelService\Partner;

class AppResponderFactory
{
    public static function getInstance(Partner $partner, string $service): AppResponderInterface {
    
        $service = str_replace('-', '_', $service);
        $service = strtoupper($service);
        
        $namespace = sprintf('Apps\\%s', $service);
        
        $complete_class = sprintf("%s\\Responder", $namespace);
        
        return new $complete_class($partner);
    }
}