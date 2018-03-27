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
     * @var array
     */
    private $defaultConfig;

    /**
     * @override
     */
    public function __construct($defaultConfig)
    {
        $this->defaultConfig = $defaultConfig;
        parent::__construct('Loco', ApiClient::SDK_VERSION);
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
     * @param array $config client configuration to override current configuration
     * @param bool $appendConfig should passed config be appended to default one? If false, $config argument will
     * override default client config.
     *
     * @return ApiClient
     *
     * @throws \InvalidArgumentException
     */
    public function getRestClient($config = [], $appendConfig = true)
    {
        $this->initRestClient($config, $appendConfig);

        return $this->restClient;
    }

    /**
     * Init instance of the Loco API client
     *
     * @param array $config Client configuration to override current configuration
     * @param bool $appendConfig should passed config be appended to default one? If false, $config argument will
     * override default client config.
     *
     * @throws \InvalidArgumentException
     */
    public function initRestClient(array $config = [], $appendConfig = true)
    {
        if ($this->restClient === null || empty($config) === false || $appendConfig === false) {
            if ($appendConfig === true) {
                $config = array_merge($this->defaultConfig, $config);
            }

            $this->restClient = ApiClient::factory($config);
        }
    }
}
