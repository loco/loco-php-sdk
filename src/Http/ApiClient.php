<?php

namespace Loco\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Loco\Deserializer;

/**
 * Loco REST API Client.
 * 
 * @usage $client = ApiClient::factory( array( 'key' => 'my-api-key' ) );
 */
class ApiClient extends GuzzleClient
{
    const VERSION = '1.0.18';

    /**
     * Factory method to create a new Loco API client.
     *
     * @param array $config Configuration data
     *
     * @return ApiClient
     *
     * @throws \InvalidArgumentException
     */
    public static function factory(array $config = [])
    {
       
        // Provide an array of default client configuration options
        $defaults = [
            'key' => '',
        ];
        // No values are currently required when creating the client
        $required = [];

        $config += $defaults;
        if ($missing = array_diff($required, array_keys($config))) {
            throw new \InvalidArgumentException('Config is missing the following keys: ' . implode(', ', $missing));
        }

        // Sanitize authentication type now to pre-empty errors
        if (isset($config['auth']) && !in_array($config['auth'], ['loco', 'basic', 'query'], true)) {
            throw new \InvalidArgumentException('No such authentication mode, '.json_encode($config['auth']));
        }

        $serviceConfig = json_decode(file_get_contents(__DIR__.'/Resources/service.json'), true);
        // allow override of base_uri after it's been set by service description
        if (isset($config['base_uri'])) {
            $serviceConfig['baseUri'] = $config['base_uri'];
        }
        // describe service from included config file.
        $description = new Description($serviceConfig);

        // Prefix Loco identifier to user agent string
        $config['headers']['User-Agent'] = $description->getName().'/'.$description->getApiVersion().' '.\GuzzleHttp\default_user_agent();

        // Create a new HTTP Client
        $client = new Client($config);

        // Add configured API key as default command parameter although individual command execution may override
        $serviceClientConfig['defaults'] = [
            'key' => $config['key'],
        ];

        $validateResponse = isset($config['validate_response']) ? (bool)$config['validate_response'] : false;

        return new self(
            $client,
            $description,
            null,
            new Deserializer($description, true, [], $validateResponse),
            null,
            $serviceClientConfig
        );
    }

    /**
     * Get API version that service was built against.
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->getDescription()->getApiVersion();
    }

    /**
     * Get canonical API version that library is expecting to find on the server
     *
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

}

