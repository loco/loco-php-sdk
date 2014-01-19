<?php
/**
 * Ping the API, just to check everything is working.
 */
require __DIR__.'/../vendor/autoload.php';

use Loco\Http\ApiClient;
use Guzzle\Service\Resource\Model;

$client = ApiClient::factory();

/* @var $result Model */
$result = $client->Ping();

echo $result->get('ping'), "\n";
