<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;

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

}

