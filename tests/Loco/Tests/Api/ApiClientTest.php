<?php

namespace Loco\Tests\Api;

use Loco\Api\ApiClient;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;

/**
 * Test the API client works.
 * Skip tests requiring internet connection with --exclude-group live
 */
class ApiClientTest extends GuzzleTestCase {
    
    /**
     * @covers Loco\Api\ApiClient::factory
     */
    public function testFactoryInitializesClient(){
        $client = ApiClient::factory( array(
            'key' => 'dummy',
        ) );
        $this->assertEquals('https://localise.biz/api', $client->getBaseUrl() );
        $this->assertEquals('dummy', $client->getConfig('key') );
    }
    

    /**
     * Live ping test via overloaded service method
     * @group live
     */
    public function testPing(){
        $client = $this->getServiceBuilder()->get('loco');
        $pong = $client->Ping();
        $this->assertContains( 'pong', (string) $pong );
    }



    /**
     * Live 404 test via custom endpoint
     * @expectedException \Guzzle\Http\Exception\BadResponseException
     * @group live
     */    
    public function testNotFound(){
        $client = $this->getServiceBuilder()->get('loco');
        $client->get('ping/not-found.json')->send();
    }
    
    
    /**
     * Live file converter test
     * @group live
     */
    public function testConverter(){
        $client = $this->getServiceBuilder()->get('loco');
        $result = $client->Convert( array(
            'from' => 'json',
            'to' => 'po',
            'src' => '{"foo":"bar"}',
            'domain' => 'test',
            'locale' => 'fr',
        ) );
        $this->assertInstanceOf('\Loco\Api\Response\ConvertResponse', $result );
        $this->assertRegExp( '/msgid\s+"foo"\s+msgstr\s+"bar"/', (string) $result );
    }
    
    
    /**
     * Fake ping over Guzzle test server
     * @group fake
     */
    public function testFakePing(){
        // set up fake response for ping
        $fake = json_encode( array('ping'=>'pong') );
        $http = "HTTP/1.1 200 OK\r\nContent-Length: ".strlen($fake)."\r\n\r\n".$fake;
        $this->getServer()->enqueue( $http );
        // call Ping()
        $client = $this->getServiceBuilder()->get('loco');
        $client->setBaseUrl( $this->getServer()->getUrl() );
        $pong = (string) $client->Ping();
        $this->assertEquals( 'pong', $pong );
    }

    
}

