<?php
/**
 * Export a single language file via exportLocale
 * https://localise.biz/api/docs/export/exportlocale
 */
$basedir = \dirname(__DIR__);

require_once $basedir.'/vendor/autoload.php';

$config = json_decode(file_get_contents($basedir.'/config.json'), true);
$client = Loco\Http\ApiClient::factory($config);

/* @var Loco\Http\Result\RawResult */
$result = $client->exportLocale([
    'ext' => 'xlf',
    'index' => 'id',
    'locale' => 'en',
    'format' => 'symfony'
]);

// raw response is literal file data
echo (string) $result;
