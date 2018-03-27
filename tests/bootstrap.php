<?php
/**
 * PHPUnit bootstrap for Loco SDK tests.
 */

$basedir = dirname(__DIR__);

if (!is_dir($basedir.'/vendor')) {
    die("\nDependencies must be installed using composer:\nSee http://getcomposer.org\n\n");
}

require_once $basedir.'/vendor/autoload.php';

// Set up API test case with Loco service
use \Loco\Tests\Http\ApiClientTestCase;

ApiClientTestCase::parseJsonConfig(__DIR__.'/../config.json');
