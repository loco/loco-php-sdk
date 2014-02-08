<?php

namespace Loco\Http;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * Loco REST API Client.
 */
class ApiClient extends Client {

    
    /**
     * Factory method to create a new Loco API client.
     * @param array|Collection $config Configuration data
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
        
        // add common command parameters. They should only be appended when required
        $config->add( Client::COMMAND_PARAMS, array ( 
            'key' => $config->get('key'),
        ) );

        // Create a new instance of self
        $client = new self( $config->get('base_url'), $config );

        // describe service from included php file.
        $service = ServiceDescription::factory( __DIR__.'/Resources/service.php');
        
        // Prefix Loco identifier to user agent string
        $client->setUserAgent( $service->getName().'/'.$service->getApiVersion(), true );

        return $client->setDescription( $service );
                
    }   


    /**
     * Get API version that service was built against.
     * @return string
     */
    public function getVersion(){
        return $this->getDescription()->getApiVersion();
    }

}

