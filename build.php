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

$builder = new Loco\Utils\Swizzle\Swizzle( 'loco', 'Loco REST API' );
$builder->verbose( STDERR );
$builder->setDelay( 0 );

// Register custom Guzzle response classes
$raw = '\Loco\Http\Response\RawResponse';
$zip = '\Loco\Http\Response\ZipResponse';
$builder->registerResponseClass('exportArchive', $zip )
        ->registerResponseClass('exportLocale', $raw )
        ->registerResponseClass('exportAll', $raw )
        ->registerResponseClass('convert', $raw );


// Enable response validation and locale URL if building for local test
if( isset($argv[1]) && 'dev' === $argv[1] ){ 
    $builder->registerCommandClass( '', '\Loco\Http\Command\StrictCommand');
    $base_url = 'https://ssl.loco.192.168.0.7.xip.io/api/docs';
}
// Else pull from live API
else {
    $base_url = 'https://localise.biz/api/docs';
}


$builder->build( $base_url );

$phps = $builder->export();
$file = __DIR__.'/src/Loco/Http/Resources/service.php';
$blen = file_put_contents( $file, $phps );
printf("Wrote PHP service description to %s (%s bytes)\n", $file, $blen );

$json = $builder->toJson();
$file = __DIR__.'/src/Loco/Http/Resources/service.json';
$blen = file_put_contents( $file, $json );
printf("Wrote JSON service description to %s (%s bytes)\n", $file, $blen );

printf("\nBuilt from %s\n", $base_url );

