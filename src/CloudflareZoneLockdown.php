<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\ZoneLockdown;

class CloudflareZoneLockdown extends ZoneLockdown
{
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
    }
}