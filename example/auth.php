<?php
/**
 * Check your Loco project key with the REST API.
 */
$basedir = \dirname(__DIR__);

require_once $basedir.'/vendor/autoload.php';

$client = Loco\Http\ApiClient::factory(json_decode(file_get_contents($basedir.'/config.json'), true));

/** @var \GuzzleHttp\Command\Result $result */
$result = $client->authVerify();

printf("Authenticated as '%s'\n", $result['user']['name']);
printf("Project name is '%s'\n", $result['project']['name']);
