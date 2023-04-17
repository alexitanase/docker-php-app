<?php

namespace Apps;

use PropelService\Partner;
use CodeIgniter\HTTP\RequestInterface;

interface AppResponderInterface
{
    public function __construct(Partner $partner);
    
    public function getPartner(): Partner;
    
    public function handleRequest(RequestInterface $request);
}