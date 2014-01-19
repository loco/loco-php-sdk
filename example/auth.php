<?php
/**
 * Check your Loco project key with the REST API.
 */
require __DIR__.'/../vendor/autoload.php';

use Loco\Http\ApiClient;
use Guzzle\Service\Resource\Model;
use Guzzle\Service\Builder\ServiceBuilder;

// Our project key is in a config file so we instantiate the client via the Guzzle service builder
$client = ServiceBuilder::factory( __DIR__.'/../config.json' )->get('loco');

/* @var $result Model */
$result = $client->authTest();

echo "Authenticated as ",$result['user']['name'],"\n";
echo "Project name '", $result['project']['name'],"'\n";
