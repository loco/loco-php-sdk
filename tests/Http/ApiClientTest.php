<?php

namespace Loco\Tests\Http;

use GuzzleHttp\Command\Result;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Loco\Http\ApiClient;

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
                'base_uri' => 'https://example.com/api',
            ]
        );
        $this->assertEquals('https://example.com/api', $client->getHttpClient()->getConfig('base_uri')->__toString());
        $this->assertEquals('https://example.com/api', $client->getDescription()->getBaseUri()->__toString());
        $this->assertEquals('dummy', $client->getConfig('defaults')['key']);

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
     * Test ping request with mocked response
     *
     * @group node
     */
    public function testPing()
    {
        $client = $this->getClientWithMockedResponse(
            ['base_uri' => 'https://example.com/api'],
            ['version' => '1.1']
        );
        /** @var Result $result */
        $result = $client->ping();
        $this->assertArrayHasKey('version', $result);
        $this->assertEquals('1.1', $result['version']);
    }

    /**
     * Fake an invalid ping
     *
     * @group node
     * @group strict
     * @expectedException \Loco\Exception\ValidationException
     */
    public function testMockInvalidPing()
    {
        $client = $this->getClientWithMockedResponse(
            ['base_uri' => 'https://example.com/api'],
            ['fail' => 'woops']
        );
        $client->ping();
    }

    /**
     * Create client with mocked fake response
     *
     * @param array $config
     * @param $responseBody
     *
     * @return ApiClient
     */
    private function getClientWithMockedResponse(array $config = [], $responseBody)
    {
        $response = new Response(200, [], json_encode($responseBody));
        $handlerStack = MockHandler::createWithMiddleware([$response]);
        $config['httpHandlerStack'] = $handlerStack;

        $defaults = [
            'base_uri' => 'https://localise.biz/api/docs'
        ];
        return static::getClient($config + $defaults);
    }

}

