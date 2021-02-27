<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\ZoneSettings;

class CloudflareZoneSettings extends ZoneSettings
{
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
    }
}