<?php
/**
 * PHPUnit bootstrap for Loco tests.
 */

if ( ! file_exists( dirname(__DIR__) . '/composer.lock') ) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install\n\n"
        . "See http://getcomposer.org for help with installing composer\n");
}

require_once dirname(__DIR__).'/vendor/autoload.php';
