<?php

namespace Loco\Api;

use Guzzle\Common\Collection;
use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * @method Ping \Loco\Api\Responses\PingResponse
 */
class ApiClient extends Client {

    
    /**
     * @return ApiClient
     */
    public static function factory( $config = array() ){
       
        // Provide a hash of default client configuration options
        $default = array (
            'base_url' => 'https://localise.biz/api',
            'key' => '',
        );

        // No values are currently required when creating the client
        $required = array ();

        // Merge in default settings and validate the config
        $config = Collection::fromConfig( $config, $default, $required );

        // Create a new instance of self
        $client = new self( $config->get('base_url'), $config );
        
        // Let config override service description for base_url
        $service = self::describe();
        $service->setBaseUrl('');
        
        // Prefix Loco identifier to user agent string
        $client->setUserAgent( $service->getName().'/'.$service->getApiVersion(), true );

        return $client->setDescription( $service );
                
    }   

    
    
    /**
     * Create/Get Loco API service description
     * @return ServiceDescription
     */ 
    private static function describe(){

        // Define Loco service via DSL in JSON during development
        return ServiceDescription::factory(__DIR__.'/Resources/restapi.json');
        
        // Define Loco service via compiled DSL for speed
        // run and copy $ Resources/build.php | pbcopy
    }
}
