<?php

/**
 * Created by PhpStorm.
 * User: junade
 * Date: 09/06/2017
 * Time: 15:31
 */

namespace Villaflor\Cloudflare\Tests\Feature;


use Cloudflare\API\Adapter\Adapter;
use Cloudflare\API\Endpoints\DNS;
use Villaflor\Cloudflare\Tests\TestCase;

class CloudflareDNSTest extends TestCase
{
    public function testAddRecord()
    {
        $response = $this->getPsr7JsonResponseForFixture('addRecord.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('post')->willReturn($response);

        $mock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo('zones/023e105f4ecef8ad9ca31a8372d0c353/dns_records'),
                $this->equalTo(
                    [
                        'type' => 'A',
                        'name' => 'example.com',
                        'content' => '127.0.0.1',
                        'ttl' => 120,
                        'proxied' => false
                    ]
                )
            );

        $dns = new DNS($mock);
        $dns->addRecord('023e105f4ecef8ad9ca31a8372d0c353', 'A', 'example.com', '127.0.0.1', '120', false);
    }

    public function testAddMXRecordPriority10()
    {
        $response = $this->getPsr7JsonResponseForFixture('addRecord.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('post')->willReturn($response);

        $mock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo('zones/023e105f4ecef8ad9ca31a8372d0c353/dns_records'),
                $this->equalTo(
                    [
                        'type' => 'MX',
                        'name' => 'example.com',
                        'content' => '127.0.0.1',
                        'ttl' => 120,
                        'proxied' => false,
                        'priority' => 10,
                    ]
                )
            );

        $dns = new DNS($mock);
        $dns->addRecord('023e105f4ecef8ad9ca31a8372d0c353', 'MX', 'example.com', '127.0.0.1', '120', false, 10);
    }

    public function testAddMXRecordPriority0()
    {
        $response = $this->getPsr7JsonResponseForFixture('addRecord.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('post')->willReturn($response);

        $mock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo('zones/023e105f4ecef8ad9ca31a8372d0c353/dns_records'),
                $this->equalTo(
                    [
                        'type' => 'MX',
                        'name' => 'example.com',
                        'content' => '127.0.0.1',
                        'ttl' => 120,
                        'proxied' => false,
                        'priority' => 0,
                    ]
                )
            );

        $dns = new DNS($mock);
        $dns->addRecord('023e105f4ecef8ad9ca31a8372d0c353', 'MX', 'example.com', '127.0.0.1', '120', false, 0);
    }


    public function testListRecords()
    {
        $response = $this->getPsr7JsonResponseForFixture('listRecords.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('zones/023e105f4ecef8ad9ca31a8372d0c353/dns_records'),
                $this->equalTo(
                    [
                        'page' => 1,
                        'per_page' => 20,
                        'match' => 'all',
                        'type' => 'A',
                        'name' => 'example.com',
                        'content' => '127.0.0.1',
                        'order' => 'type',
                        'direction' => 'desc',
                    ]
                )
            );

        $zones = new DNS($mock);
        $result = $zones->listRecords(
            '023e105f4ecef8ad9ca31a8372d0c353',
            'A',
            'example.com',
            '127.0.0.1',
            1,
            20,
            'type',
            'desc'
        );

        $this->assertObjectHasAttribute('result', $result);
        $this->assertObjectHasAttribute('result_info', $result);

        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $result->result[0]->id);
        $this->assertEquals(1, $result->result_info->page);
        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $zones->getBody()->result[0]->id);
    }

    public function testGetDNSRecordDetails()
    {
        $response = $this->getPsr7JsonResponseForFixture('getDNSRecordDetails.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('zones/023e105f4ecef8ad9ca31a8372d0c353/dns_records/372e67954025e0ba6aaa6d586b9e0b59')
            );

        $dns = new DNS($mock);
        $result = $dns->getRecordDetails('023e105f4ecef8ad9ca31a8372d0c353', '372e67954025e0ba6aaa6d586b9e0b59');

        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $result->id);
        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $dns->getBody()->result->id);
    }

    public function testGetRecordID()
    {
        $response = $this->getPsr7JsonResponseForFixture('getRecordId.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('zones/023e105f4ecef8ad9ca31a8372d0c353/dns_records')
            );

        $dns = new DNS($mock);
        $result = $dns->getRecordID('023e105f4ecef8ad9ca31a8372d0c353', 'A', 'example.com');

        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $result);
    }

    public function testUpdateDNSRecord()
    {
        $response = $this->getPsr7JsonResponseForFixture('updateDNSRecord.json');

        $mock = $this->getMockBuilder(Adapter::class)->disableOriginalConstructor()->getMock();
        $mock->method('put')->willReturn($response);

        $details = [
            'type' => 'A',
            'name' => 'example.com',
            'content' => '1.2.3.4',
            'ttl' => 120,
            'proxied' => false,
        ];

        $mock->expects($this->once())
            ->method('put')
            ->with(
                $this->equalTo('zones/023e105f4ecef8ad9ca31a8372d0c353/dns_records/372e67954025e0ba6aaa6d586b9e0b59'),
                $this->equalTo($details)
            );

        $dns = new DNS($mock);
        $result = $dns->updateRecordDetails(
            '023e105f4ecef8ad9ca31a8372d0c353',
            '372e67954025e0ba6aaa6d586b9e0b59',
            $details
        );

        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $result->result->id);
        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $dns->getBody()->result->id);

        foreach ($details as $property => $value) {
            $this->assertEquals($result->result->{$property}, $value);
        }
    }
}