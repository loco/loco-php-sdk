<?php

namespace Loco\Swagger;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * Client for pulling Swagger docs
 */
class DocsClient extends Client {

    
    /**
     * Factory method to create a new Swagger Docs client.
     * @param array|Collection $config Configuration data
     * @return DocsClient
     */
    public static function factory( $config = array() ){
       
        // Provide a hash of default client configuration options
        $default = array (
            'base_url' => 'https://localise.biz/api/docs',
        );

        // No values are currently required when creating the client
        $required = array ();

        // Merge in default settings and validate the config
        $config = Collection::fromConfig( $config, $default, $required );

        // Create a new instance of self
        $client = new self( $config->get('base_url'), $config );

        // describe service from JSON file.
        $service = ServiceDescription::factory( __DIR__.'/Resources/service.json');
        
        // Prefix Loco identifier to user agent string
        $client->setUserAgent( $service->getName().'/'.$service->getApiVersion(), true );

        return $client->setDescription( $service );
                
    }   

}

