<?php

namespace Loco\Api;


use Guzzle\Common\Collection;
use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;


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

        return $client;
    }    

}
