<?php

namespace Loco\Console;

use Loco\Http\ApiClient;
use Symfony\Component\Console\Application as BaseApplication;

/**
 * Loco CLI application
 */
final class Application extends BaseApplication
{

    /**
     * @var ApiClient
     */
    private $restClient;

    /**
     * @override
     */
    public function __construct()
    {
        parent::__construct('Loco', ApiClient::VERSION);
    }

    /**
     * @override
     */
    public function getHelp()
    {
        return '
     __         ______     ______     ______    
    /\ \       /\  __ \   /\  ___\   /\  __ \   
    \ \ \____  \ \ \/\ \  \ \ \____  \ \ \/\ \  
     \ \_____\  \ \_____\  \ \_____\  \ \_____\ 
      \/_____/   \/_____/   \/_____/   \/_____/ 

        '.parent::getHelp();
    }

    /**
     * Auto-register all CLI commands analogous to API endpoints.
     *
     * @return Application
     * @throws \InvalidArgumentException
     */
    public function initApiCommands()
    {
        $operations = $this->getRestClient()->getDescription()->getOperations();
        foreach ($operations as $name => $operation) {
            $className = ucfirst($name).'Command';
            // attempt to load overriden base class first
            if (class_exists('\\Loco\\Console\\Command\\'.$className)) {
                $className = '\\Loco\\Console\\Command\\'.$className;
            } else {
                if (class_exists('\\Loco\\Console\\Command\\Generated\\'.$className)) {
                    $className = '\\Loco\\Console\\Command\\Generated\\'.$className;
                } else {
                    continue;
                }
            }
            $this->add(new $className);
        }

        return $this;
    }

    /**
     * Get instance of the Loco API client
     *
     * @param string api key to override any current configuration
     *
     * @return ApiClient
     *
     * @throws \InvalidArgumentException
     */
    public function getRestClient($apiKey = null)
    {
        $this->initRestClient($apiKey);

        return $this->restClient;
    }

    /**
     * Init instance of the Loco API client
     *
     * @param string api key to override any current configuration
     *
     * @throws \InvalidArgumentException
     */
    public function initRestClient($apiKey = null)
    {
        if ($this->restClient === null || $apiKey !== null) {
            $this->restClient = ApiClient::factory(
                [
                    'key' => $apiKey,
                    'base_uri' => 'https://localise.biz/api',
                ]
            );
        }
    }

}
