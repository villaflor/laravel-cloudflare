<?php

declare(strict_types=1);

namespace Villaflor\Cloudflare\Tests\Feature;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\ZoneSettings;
use Villaflor\Cloudflare\Tests\TestCase;

class CloudflareZoneSettingsTest extends TestCase
{
    public function testGetServerSideExcludeSetting()
    {
        $response = $this->getPsr7JsonResponseForFixture('getServerSideExclude.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $zones = new ZoneSettings($mock);
        $result = $zones->getServerSideExcludeSetting('023e105f4ecef8ad9ca31a8372d0c353');

        $this->assertSame('on', $result);
    }

    public function testUpdateServerSideExcludeSetting()
    {
        $response = $this->getPsr7JsonResponseForFixture('updateServerSideExclude.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('patch')->willReturn($response);

        $mock->expects($this->once())->method('patch');

        $zones = new ZoneSettings($mock);
        $result = $zones->updateServerSideExcludeSetting('023e105f4ecef8ad9ca31a8372d0c353', 'on');

        $this->assertSame('on', $result);
    }

    public function testGetBrowserCacheTtlSetting()
    {
        $response = $this->getPsr7JsonResponseForFixture('getBrowserCacheTtlSetting.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $zones = new ZoneSettings($mock);
        $result = $zones->getBrowserCacheTtlSetting('023e105f4ecef8ad9ca31a8372d0c353');

        $this->assertSame(14400, $result);
    }

    public function testUpdateBrowserCacheTtlSetting()
    {
        $response = $this->getPsr7JsonResponseForFixture('updateBrowserCacheTtlSetting.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('patch')->willReturn($response);

        $mock->expects($this->once())->method('patch');

        $zones = new ZoneSettings($mock);
        $result = $zones->updateBrowserCacheTtlSetting('023e105f4ecef8ad9ca31a8372d0c353', 16070400);

        $this->assertTrue($result);
    }
}