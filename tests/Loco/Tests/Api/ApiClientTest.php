<?php

namespace Loco\Tests\Api;

use Loco\Api\ApiClient;

/**
 * Simple client test
 */
class ApiClientTest extends \PHPUnit_Framework_TestCase {
    
    
    public function testClassExists(){
        $client = new ApiClient('http://example.com/');
        $this->assertInstanceOf('\Loco\Api\ApiClient', $client );
    }
    
    
}