<?php

namespace Loco\Tests\Api;

use Loco\Api\ApiClient;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;

/**
 * Test the API client works.
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
     */
    public function testPing(){
        $client = $this->getServiceBuilder()->get('loco');
        $pong = $client->Ping();
        $this->assertContains( 'pong', (string) $pong );
    }



    /**
     * Live 404 test via custom endpoint
     * @expectedException \Guzzle\Http\Exception\BadResponseException
     */    
    public function testNotFound(){
        $client = $this->getServiceBuilder()->get('loco');
        $client->get('ping/not-found.json')->send();
    }
    
    
    /**
     * Live file converter test
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

    
}

