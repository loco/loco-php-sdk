<?php
/**
 * PHPUnit bootstrap for Loco tests.
 */

if ( ! file_exists(dirname(__DIR__).'/vendor') ) {
    die("\nDependencies must be installed using composer:\nSee http://getcomposer.org\n\n");
}

$loader = require_once dirname(__DIR__).'/vendor/autoload.php';
$loader->add('Loco\\Test', __DIR__ );


// Set up API test case with Loco service 
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;
GuzzleTestCase::setServiceBuilder( ServiceBuilder::factory( __DIR__.'/../config.json' ) );