<?php
/**
 * PHPUnit bootstrap for Loco SDK tests.
 */

$basedir = dirname(__DIR__);

if ( ! is_dir($basedir.'/vendor') ) {
    die("\nDependencies must be installed using composer:\nSee http://getcomposer.org\n\n");
}

$loader = require_once $basedir.'/vendor/autoload.php';
$loader->setPsr4('Loco\\Tests\\', __DIR__ );

// Set up API test case with Loco service 
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;
GuzzleTestCase::setServiceBuilder( ServiceBuilder::factory( __DIR__.'/../config.json' ) );