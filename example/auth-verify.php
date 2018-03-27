<?php
/**
 * Check your project key with the REST API.
 * https://localise.biz/api/docs/auth/authverify
 */
$basedir = \dirname(__DIR__);

require_once $basedir.'/vendor/autoload.php';

$config = json_decode(file_get_contents($basedir.'/config.json'), true);
$client = Loco\Http\ApiClient::factory($config);

/* @var \GuzzleHttp\Command\Result $result */
$result = $client->authVerify();

printf("Authenticated as '%s'\n", $result['user']['name']);
printf("Project name is '%s'\n", $result['project']['name']);
