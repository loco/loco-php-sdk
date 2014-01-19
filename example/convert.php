<?php
/**
 * Convert an iOS Localizable.strings file to an Android XML file
 */
require __DIR__.'/../vendor/autoload.php';
use Loco\Http\ApiClient;

$client = ApiClient::factory();

$result = $client->Convert( array(
    'src'    => file_get_contents(__DIR__.'/sample.strings'),
    'from'   => 'strings',
    'to'     => 'xml',
    'format' => 'android',
    'locale' => 'fr',
    'domain' => 'test',
) );

$xml = (string) $result;

echo $xml;