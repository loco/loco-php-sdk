<?php

namespace Loco\Tests\Http\Command;

use Loco\Tests\Http\ApiClientTestCase;
use GuzzleHttp\Exception\ClientException;

/**
 * Test the live /ping API.
 * This does a live request so we can check the SDK is built against the latest API.
 *
 * @group live
 * @group noauth
 * @group readonly
 */
class LivePingCommandTest extends ApiClientTestCase
{
    /**
     * Live ping test via overloaded service method
     */
    public function testLivePing()
    {
        $client = static::getClient();
        $result = $client->ping();
        $apiVersion = $this->getServiceDescription()->getApiVersion();
        $this->assertSame($result['version'], $apiVersion, 'Live API version does not match service description');
    }

    /**
     * Live 404 test via custom endpoint
     */
    public function testLivePingNotFound()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);
        $this->expectExceptionCode(404);
        $client = static::getClient();
        $client->getHttpClient()->get('ping/not-found.json')->send();
    }
}
