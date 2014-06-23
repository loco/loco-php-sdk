<?php

namespace Loco\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Loco\Http\ApiClient;


/**
 * Loco CLI application
 */
final class Application extends BaseApplication {
    
    /**
     * @var ApiClient
     */    
    private $restClient;
    
    
    /**
     * @override
     */    
    public function __construct(){
        parent::__construct('Loco','1.0.7');
    }    



    /**
     * @override
     */    
    public function getHelp(){
        return '
     __         ______     ______     ______    
    /\ \       /\  __ \   /\  ___\   /\  __ \   
    \ \ \____  \ \ \/\ \  \ \ \____  \ \ \/\ \  
     \ \_____\  \ \_____\  \ \_____\  \ \_____\ 
      \/_____/   \/_____/   \/_____/   \/_____/ 

        '.parent::getHelp();
    }
    
    

    /**
     * Initialize REST client using Guzzle service builder.
     * @return ApiClient
     */    
    public function initRestService( $config ){
        $builder = \Guzzle\Service\Builder\ServiceBuilder::factory($config);
        return $this->restClient = $builder->get('loco');
    }    



    /**
     * Auto-register all CLI commands analogous to API endpoints.
     * @return Application
     */    
    public function initApiCommands(){     
        $service = $this->getRestClient()->getDescription()->toArray();
        foreach( array_keys($service['operations']) as $funcname ){
            $classname = strtoupper($funcname{0}).substr($funcname,1).'Command';
            // attempt to load overriden base class first
            if( class_exists('\\Loco\\Console\\Command\\'.$classname) ){
                $classname = '\\Loco\\Console\\Command\\'.$classname;
            }
            else if( class_exists('\\Loco\\Console\\Command\\Generated\\'.$classname) ){
                $classname = '\\Loco\\Console\\Command\\Generated\\'.$classname;
            }
            else {
                continue;
            }
            $this->add( new $classname );
        }
        return $this;
    }
         
    
    
    /**
     * Get instance of the Loco API client
     * @param string api key to override any current configuration
     * @return ApiClient
     */
    public function getRestClient( $defaultKey = '' ){
        if( ! $this->restClient || $defaultKey ){
            $this->restClient = ApiClient::factory( array(
                'key' => $defaultKey,
                'base_url' => 'https://localise.biz/api',
            ) );
        }
        return $this->restClient;
    }


    
}
