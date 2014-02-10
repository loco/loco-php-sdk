#!/usr/bin/env php
<?php
/**
 * Build Guzzle service description from remote Swagger definition.
 * @see https://github.com/loco-app/swizzle
 */

require __DIR__.'/vendor/autoload.php';
if( ! class_exists('Loco\Utils\Swizzle\Swizzle') ){
    fwrite( STDERR, "Swizzle not found.\nRun composer install --dev\n" );
    exit(1);
}

$service = new Loco\Utils\Swizzle\Swizzle( 'loco', 'Loco REST API' );
$service->verbose( STDERR );
$service->setDelay( 0 );

// Register custom Guzzle response classes
$raw = '\Loco\Http\Response\RawResponse';
$zip = '\Loco\Http\Response\ZipResponse';
$service->registerResponseClass('exportArchive', $zip )
        ->registerResponseClass('exportLocale', $raw )
        ->registerResponseClass('exportAll', $raw )
        ->registerResponseClass('convert', $raw );

$service->build('https://localise.biz/api/docs');        

$phps = $service->export();
$file = __DIR__.'/src/Loco/Http/Resources/service.php';
$blen = file_put_contents( $file, $phps );

printf("Wrote service description to %s (%s bytes)\n", $file, $blen );