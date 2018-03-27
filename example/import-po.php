<?php
/**
 * Add translations from a PO file via the import method
 * https://localise.biz/api/docs/import/import
 */
$basedir = \dirname(__DIR__);

require_once $basedir.'/vendor/autoload.php';

$config = json_decode(file_get_contents($basedir.'/config.json'), true);
$client = Loco\Http\ApiClient::factory($config);

// Define a very minimal PO file mapping English-to-Spanish
// Note that "es" locale must already exist in your project.
$podata = <<<PODATA
msgid ""
msgstr "Language: es"

#. This is a test message
msgid "Hello World!"
msgstr "Hola Mundo!"
PODATA;

try {
    /* @var \GuzzleHttp\Command\Result $result */
    $result = $client->import([
        'ext' => 'po',
        'src' => $podata,
        'locale' => 'es',
    ]);
    // Response model implements ArrayAccess
    printf("Import completed with message: '%s'\n", $result['message']);
} catch (\Exception $e) {
    echo $e->getMessage(),"\n";
}
