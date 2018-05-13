<?php
/**
 * Add translations from a XLIFF file via the import method
 * https://localise.biz/api/docs/import/import
 */
$basedir = \dirname(__DIR__);

require_once $basedir.'/vendor/autoload.php';

$config = json_decode(file_get_contents($basedir.'/config.json'), true);
$client = Loco\Http\ApiClient::factory($config);

// Define a minimal XLIFF 2.0 document with English source and Spanish target, plus a unique identifier.
$xlfdata = <<<XLIFF
<xliff version="2.0" srcLang="en" trgLang="es">
    <file>
        <unit name="greeting">
            <segment>
                <source>Hello World!</source>
                <target>Hola Mundo!</target>
            </segment>
        </unit>
    </file>
</xliff>
XLIFF;

try {
    /* @var \GuzzleHttp\Command\Result $result */
    $result = $client->import([
        'ext' => 'xlf',
        'src' => $xlfdata,
        'locale' => 'es',
        'index' => 'text',
    ]);
    // Response model implements ArrayAccess
    printf("Import completed with message: '%s'\n", $result['message']);
} catch (\Exception $e) {
    echo $e->getMessage(),"\n";
}
