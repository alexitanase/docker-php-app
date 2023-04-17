<?php

namespace Apps;

use App\Enum\ErrorEnum;
use Predis\Client;
use PropelService\Partner;
use Predis\Client as RedisClient;

abstract class AbstractAppResponder implements AppResponderInterface
{
    protected Partner $partner;
    protected RedisClient $client;
    public $service_options;
    
    public function __construct(Partner $partner) {
        $this->partner = $partner;
    }
    
    public function getPartner(): Partner {
        return $this->partner;
    }

    protected function connectRedis(){
        if(isset($_ENV['REDIS'])){
            $this->client = new Client(@$_ENV['REDIS']);
        }
    }
    
}