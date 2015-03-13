<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Http\Message\Response;

/**
 * Mock ApiClient tests.
 * @group client
 */
class ApiClientTest extends GuzzleTestCase {
    
    
    /**
     * Get api client via config applied in bootstrap.php
     * @return ApiClient
     */
    protected function getClient(){
        return $this->getServiceBuilder()->get('loco');
    }    
    
    
    
    /**
     * @covers Loco\Http\ApiClient::factory
     * @return ApiClient
     */
    public function testFactoryInitializesClient(){
        $client = ApiClient::factory( array(
            'key' => 'dummy',
            'base_url' => 'https://example.com/api',
        ) );
        $this->assertEquals( 'https://example.com/api', $client->getBaseUrl() );
        $this->assertEquals('dummy', $client->getConfig('key') );
        return $client;
    }
    
    
    /**
     * @expectedException Guzzle\Common\Exception\InvalidArgumentException
     */ 
    public function testClientRejectsInvalidAuthType(){
        $client = ApiClient::factory( array( 'auth' => 'Foo' ) );
    }
    


    /**
     * Fake ping over Guzzle Node test server
     * @group node
     */
    public function testNodePing(){
        $client = ApiClient::factory( array( 'base_url' => 'https://example.com/api' ) );
        $this->enqueueJson( $client, array( 'version' => '1.1' ) );
        $version = $client->ping()->get('version');
        $this->assertEquals( '1.1', $version );
    }



    /**
     * Fake an invalid ping
     * @group node
     * @group strict
     * @expectedException \Guzzle\Service\Exception\ValidationException
     */
    public function testMockInvalidPing(){
        $client = ApiClient::factory( array( 'base_url' => 'https://example.com/api' ) );
        $this->enqueueJson( $client, array( 'fail' => 'woops' ) );
        $client->ping();
    }



    /**
     * Queue up o a fake JSON response via node test server
     */    
    private function enqueueJson( ApiClient $client, array $data ){
        $json = json_encode( $data );
        $http = sprintf("HTTP/1.1 200 OK\r\nContent-Length: %u\r\n\r\n%s", strlen($json), $json );
        $this->getServer()->enqueue( $http );
        $client->setBaseUrl( $this->getServer()->getUrl() );
    }    

}

