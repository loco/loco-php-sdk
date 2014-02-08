<?php
/**
 * Example XLIFF -> YAML conversion via the Loco REST API.
 * Extracts a single language from a XLIFF file and renders it to a single YAML file.
 */
require __DIR__.'/../vendor/autoload.php';

/* @var $client \Loco\Http\ApiClient */
$client = \Loco\Http\ApiClient::factory();

/* @var $result \Loco\Http\Response\RawResponse */
$result = $client->convert( array(
    'src'    => file_get_contents(__DIR__.'/sample.xlf'),
    'from'   => 'xlf',
    'ext'    => 'yml',
    'locale' => 'es',
    'format' => 'nested',
) );

echo (string) $result;