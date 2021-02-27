<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Auth\Auth;

class APIKey implements Auth
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey
        ];
    }
}