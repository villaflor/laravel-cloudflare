<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\DNS;

class CloudflareDNS extends DNS
{
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
    }
}