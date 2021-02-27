<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\DNSAnalytics;

class CloudflareDNSAnalytics extends DNSAnalytics
{
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
    }
}