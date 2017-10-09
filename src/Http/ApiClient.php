<?php

namespace Loco\Http;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Common\Exception\InvalidArgumentException;

/**
 * Loco REST API Client.
 * 
 * @usage $client = ApiClient::factory( array( 'key' => 'my-api-key' ) );
 */
class ApiClient extends Client {
    
    const VERSION = '1.0.18';
    
    /**
     * Factory method to create a new Loco API client.
     * @param array|Collection $config Configuration data
     * @return ApiClient
     */
    public static function factory( $config = array() ){
       
        // Provide a hash of default client configuration options
        $default = array (
            'key' => '',
        );

        // No values are currently required when creating the client
        $required = array ();

        // Merge in default settings and validate the config
        $config = Collection::fromConfig( $config, $default, $required );

        // Add configured API key as default command parameter although individual command execution may override
        $config->add( Client::COMMAND_PARAMS, array ( 
            'key' => $config->get('key'),
        ) );
        
        // Sanitize authentication type now to pre-empty errors
        if( $mode = $config->get('auth') ){
            if( ! in_array( $mode, array('loco','basic','query'), true ) ){
                throw new InvalidArgumentException('No such authentication mode, '.json_encode($mode) ); 
            }
        }

        // Create a new instance of self
        $client = new self( '', $config );

        // describe service from included php file.
        $service = ServiceDescription::factory( __DIR__.'/Resources/service.php');
        
        // allow override of base_url after it's been set by service description
        if( $baseUrl = $config->get('base_url') ){
            $service->setBaseUrl( $baseUrl );
        }
        
        // Prefix Loco identifier to user agent string
        $client->setUserAgent( $service->getName().'/'.$service->getApiVersion(), true );

        return $client->setDescription( $service );
                
    }   



    /**
     * Get API version that service was built against.
     * @return string
     */
    public function getApiVersion(){
        return $this->getDescription()->getApiVersion();
    }


    /**
     * Get canonical API version that library is expecting to find on the server
     * @return string
     */
    public function getVersion(){
        return self::VERSION;
    }

}

