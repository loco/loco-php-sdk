<?php
/**
 * Export all translatons as Zip file via exportArchive
 * https://localise.biz/api/docs/export/exportarchive
 */
$basedir = \dirname(__DIR__);

require_once $basedir.'/vendor/autoload.php';

$config = json_decode(file_get_contents($basedir.'/config.json'), true);
$client = Loco\Http\ApiClient::factory($config);

/* @var Loco\Http\Result\ZipResult */
$result = $client->exportArchive([
    'ext' => 'xlf',
    'format' => 'symfony'
]);

/* @var $zip \ZipArchive */
$zip = $result->getZip();

// zip file will be unlinked on shutdown unless we move it
$path = $_SERVER['PWD'].'/example.zip';
if (rename($zip->filename, $path)) {
    printf("Zip file downloaded to %s\n", $path);
} else {
    printf("Failed to move downloaded file\n");
}
