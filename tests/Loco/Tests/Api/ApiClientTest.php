<?php

namespace Loco\Tests\Api;

use Loco\Api\ApiClient;
use Guzzle\Service\Builder\ServiceBuilder;


/**
 * Test the API client works.
 */
class ApiClientTest extends \PHPUnit_Framework_TestCase {
    
    
    public function testClassValid(){
        $client = new ApiClient('http://example.com/');
        $this->assertInstanceOf('\Guzzle\Service\Client', $client );
    }
    
    
    public function testServiceBuilder(){
        $jsonfile = __DIR__.'/../../../../services.json';
        $this->assertFileExists( $jsonfile, 'Config not copied from services.json.dist' );
        $builder = ServiceBuilder::factory( $jsonfile );
        $client = $builder->get('loco_test');
        $this->assertInstanceOf('\Loco\Api\ApiClient', $client );
        return $client;
    }
    

    /**
     * @depends testServiceBuilder
     */    
    public function testPing( ApiClient $client ){
        $request = $client->get('ping.json');
        $response = $request->send();
        $this->assertContains( 'pong', $response->json() );
    }
    
    
}