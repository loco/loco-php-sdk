<?php

namespace Loco\Tests\Http;

use GuzzleHttp\Exception\ClientException;

/**
 * Test the live /ping API.
 *
 * @group live
 * @group ping
 * @group readonly
 */
class ApiClientPingTest extends ApiClientTestCase
{

    /**
     * Live ping test via overloaded service method
     */
    public function testLivePing()
    {
        $client = static::getClient();
        $sdkVersion = $client->getVersion();
        $apiVersion = $client->getApiVersion();
        $this->assertEquals($sdkVersion, $apiVersion, 'API version does not match SDK version');
        $result = $client->ping();
        $apiVersion = $result['version'];
        $this->assertEquals($sdkVersion, $apiVersion, 'Live API version does not match local SDK version');
    }

    /**
     * Live 404 test via custom endpoint
     *
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectExceptionCode 404
     */
    public function testLiveFail()
    {
        $client = static::getClient();
        $client->getHttpClient()->get('ping/not-found.json')->send();
    }

}

