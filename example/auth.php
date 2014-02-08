<?php
/**
 * Check your Loco project key with the REST API.
 */
require __DIR__.'/../vendor/autoload.php';

// Our project key is in a config file so we instantiate the client via the Guzzle service builder
$client = Guzzle\Service\Builder\ServiceBuilder::factory( __DIR__.'/../config.json' )->get('loco');

/* @var $result \Guzzle\Service\Resource\Model */
$result = $client->authVerify();

printf("Authenticated as '%s'\n", $result['user']['name'] );
printf("Project name is '%s'\n",  $result['project']['name'] );
