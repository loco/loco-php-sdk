<?php
/**
 * Ping the API, just to check everything is working.
 */
require __DIR__.'/../vendor/autoload.php';
use Loco\Api\ApiClient;

$client = ApiClient::factory();
$pong = $client->Ping();
echo $pong, "\n";
