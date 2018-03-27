<?php

namespace Loco\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * Loco REST API Client.
 *
 * @usage $client = ApiClient::factory( array( 'key' => 'my-api-key' ) );
 */
class ApiClient extends GuzzleClient
{
    const SDK_VERSION = '2.0.0';
    const API_VERSION = '1.0.19';

    /**
     * Factory method to create a new Loco API client.
     *
     * @param array $config User defined configuration options
     *
     * @return ApiClient
     *
     * @throws \InvalidArgumentException
     */
    public static function factory(array $config = [])
    {
        // Validate passed in configuraton options
        $config = static::processFactoryConfig($config);

        // Describe service from included config file.
        $serviceConfig = json_decode(file_get_contents(__DIR__.'/Resources/service.json'), true);
        // Allow base_uri override for local testing and mocking purposes
        if (isset($config['base_uri']) === true) {
            $serviceConfig['baseUri'] = $config['base_uri'];
        }
        // TODO: Add null values handling to Guzzle's formatter and submit a PR to upstream.
        // Remove NullableSchemaFormatter if they accept PR.
        $description = new Description(
            $serviceConfig,
            ['formatter' => new NullableSchemaFormatter()]
        );

        // Define Guzzle client configuration
        $clientConfig['base_uri'] = $serviceConfig['baseUri'];
        // Prefix Loco identifier to user agent string
        $clientConfig['headers']['User-Agent'] = 'Loco/'.self::SDK_VERSION.' '.\GuzzleHttp\default_user_agent();
        // Handlers may be defined in config for listing on requests and responses.
        // See Guzzle docs: http://docs.guzzlephp.org/en/stable/handlers-and-middleware.html
        if (isset($config['httpHandlerStack']) === true) {
            $clientConfig['handler'] = $config['httpHandlerStack'];
        }
        // always pass preferred API version as header. not currently in service description
        $clientConfig['headers']['X-Api-Version'] = $config['version'];
        // Create a new HTTP Client
        $client = new Client($clientConfig);

        // Bind other parameters via the service description
        $serviceClientConfig['defaults'] = [
            'key' => $config['key'],
            'auth' => $config['auth'],
        ];

        // Response validation is OFF by default. Request validation is always ON
        $validateResponse = isset($config['validate_response']) ? (bool)$config['validate_response'] : false;

        return new self(
            $client,
            $description,
            new Serializer($description, []),
            new Deserializer($description, true, [], $validateResponse),
            null,
            $serviceClientConfig
        );
    }

    /**
     * @param array $config
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    protected static function processFactoryConfig(array $config)
    {
        // Provide an array of default client configuration options.
        // Specifying version 1.0 ensures latest compatible response
        $config += [
            'key' => '',
            'auth' => 'loco',
            'version' => '1.0',
            'validate_response' => true,
        ];

        // Validate authentication type
        if (!in_array($config['auth'], ['loco', 'basic', 'query'], true)) {
            throw new \InvalidArgumentException('No such authentication mode, '.json_encode($config['auth']));
        }

        return $config;
    }
}
