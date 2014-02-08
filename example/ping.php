<?php
/**
 * Ping the API, just to check everything is working.
 */
require __DIR__.'/../vendor/autoload.php';

$client = Loco\Http\ApiClient::factory();

/* @var $result \Guzzle\Service\Resource\Model */
$result = $client->ping();

if( $version = $result->get('version') ){
    printf("Ping OK, API version is %s\n", $version );
}
else {
    printf("Ping failed to ping API\n");
}