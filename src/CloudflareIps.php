<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\IPs;

class CloudflareIps extends IPs
{
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
    }

}