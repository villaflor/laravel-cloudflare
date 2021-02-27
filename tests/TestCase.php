<?php


namespace Villaflor\Cloudflare\Tests;


use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Foundation\Application;
use Psr\Http\Message\StreamInterface;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Override application aliases.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [];
    }

    /**
     * Returns a PSR7 Stream for a given fixture.
     *
     * @param string $testData
     * @return StreamInterface
     */
    protected function getPsr7StreamForFixture(string $testData): StreamInterface
    {
        $path = sprintf('%s/ResponseData/%s', __DIR__, $testData);

        $this->assertFileExists($path);

        $stream = Utils::streamFor(file_get_contents($path));

        $this->assertInstanceOf(Psr7\Stream::class, $stream);

        return $stream;
    }

    /**
     * Returns a PSR7 Response (JSON) for a given fixture.
     *
     * @param $testData
     * @param integer $statusCode A HTTP Status Code for the response.
     * @return Psr7\Response
     */
    protected function getPsr7JsonResponseForFixture($testData, $statusCode = 200): Psr7\Response
    {
        $stream = $this->getPsr7StreamForFixture($testData);

        $this->assertNotNull(json_decode($stream));
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());

        return new Psr7\Response($statusCode, ['Content-Type' => 'application/json'], $stream);
    }
}