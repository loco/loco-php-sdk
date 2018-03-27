<?php
/**
 * Ping the API, just to check everything is working.
 * https://localise.biz/api/docs/ping/ping
 */
require __DIR__.'/../vendor/autoload.php';

$client = Loco\Http\ApiClient::factory([ 'version' => '1' ]);

/* @var \GuzzleHttp\Command\Result $result */
$result = $client->ping();

$latest = $result->offsetGet('version');
$current = Loco\Http\ApiClient::API_VERSION;

if ($current === $latest) {
    printf("Ping OK, API version is %s\n", $latest);
} else {
    printf("Ping OK, but latest API version is %s and this library is built against %s\n", $latest, $current);
}
