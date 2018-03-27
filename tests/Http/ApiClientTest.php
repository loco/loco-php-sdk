<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Loco\Tests\Http\Model\MockRequest;

/**
 * Mock ApiClient tests.
 *
 * @group client
 */
class ApiClientTest extends ApiClientTestCase
{

    /**
     * @covers \Loco\Http\ApiClient::factory
     * @return ApiClient
     */
    public function testFactoryInitializesClient()
    {
        $client = ApiClient::factory(
            [
                'key' => 'dummy',
                'version' => '1.2.3',
                'base_uri' => 'https://example.com/api',
            ]
        );
        $this->assertEquals('https://example.com/api', $client->getHttpClient()->getConfig('base_uri')->__toString());
        $this->assertEquals('https://example.com/api', $client->getDescription()->getBaseUri()->__toString());
        $this->assertEquals('dummy', $client->getConfig('defaults')['key']);
        // parameters bound to http client, as opposed to service description:
        $headers = $client->getHttpClient()->getConfig('headers');
        $this->assertEquals('1.2.3', $headers['X-Api-Version']);

        return $client;
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testClientRejectsInvalidAuthType()
    {
        ApiClient::factory(['auth' => 'Foo']);
    }

    /**
     * Ensures we've bumped the version constant.
     * Constant is used before a client instance exists to provide the service description.
     */
    public function testApiVersionMatchesServiceDescription()
    {
        $vbuilt = $this->getServiceDescription()->getApiVersion();
        $this->assertSame(ApiClient::API_VERSION, $vbuilt, 'API version mismatch');
    }
}
