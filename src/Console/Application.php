<?php

namespace Loco\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Loco\Http\ApiClient;


/**
 * Loco CLI application
 */
final class Application extends BaseApplication {
    
    
    private $restClient;
    
    
    public function __construct(){
        parent::__construct('Loco','1.0.7');
    }    
    
    
    
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
     * Initialize REST client using Guzzle service builder
     */    
    public function initRestService( $config ){
        $builder = \Guzzle\Service\Builder\ServiceBuilder::factory($config);
        $this->restClient = $builder->get('loco');
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