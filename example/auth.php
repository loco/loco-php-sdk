<?php
/**
 * Check your Loco project key with the REST API.
 */
require __DIR__.'/../vendor/autoload.php';

$client = Loco\Http\ApiClient::factory(['key' => 'your-api-key']);

/** @var \GuzzleHttp\Command\Result $result */
$result = $client->authVerify();

printf("Authenticated as '%s'\n", $result['user']['name']);
printf("Project name is '%s'\n", $result['project']['name']);
