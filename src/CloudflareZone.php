<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\Zones;

class CloudflareZone extends Zones
{
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
    }
}