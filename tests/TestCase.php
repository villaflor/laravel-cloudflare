<?php


namespace Villaflor\Cloudflare\Tests;


use Illuminate\Foundation\Application;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Override application aliases.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders(Application $app): array
    {
        return [];
    }
}