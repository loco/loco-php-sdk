<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use GuzzleHttp\Command\Result;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

/**
 * Mock ApiClient tests.
 *
 * @group client
 */
abstract class ApiClientTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected static $config = [];
    
    /**
     * @var GuzzleHttp\Command\Guzzle\DescriptionInterface
     */
    private static $service;

    /**
     * @param string $path
     */
    public static function parseJsonConfig($path)
    {
        static::$config = json_decode(file_get_contents($path), true);
    }

    /**
     * Get api client via config applied in bootstrap.php
     *
     * @param array $config
     * @param bool $appendConfig
     *
     * @return ApiClient
     */
    protected static function getClient(array $config = [], $appendConfig = true)
    {
        if ($appendConfig === true) {
            $config = array_merge(static::$config, $config);
        }

        return ApiClient::factory($config);
    }

    /**
     * Create client with mocked fake response
     *
     * @param array $config
     * @param mixed $responseBody
     * @param int $status
     * @param ArrayAccess $container
     *
     * @return ApiClient
     */
    protected function getClientWithMockedResponse(array $config, $responseBody, $status = 200, \ArrayAccess $container = null)
    {
        $response = new Response($status, [], json_encode($responseBody));
        $handlerStack = MockHandler::createWithMiddleware([$response]);
        $config['httpHandlerStack'] = $handlerStack;
        
        if ($container) {
            $handlerStack->push(Middleware::history($container));
        }

        $defaults = [
            'base_uri' => 'https://example.com/api'
        ];
        return static::getClient($config + $defaults);
    }

     
    /**
     * @return GuzzleHttp\Command\Guzzle\DescriptionInterface
     */
    protected function getServiceDescription()
    {
        return self::$service ?: (self::$service = ApiClient::factory()->getDescription());
    }
}
