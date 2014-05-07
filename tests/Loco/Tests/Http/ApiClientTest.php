<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Http\Message\Response;

/**
 * Mock ApiClient tests.
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
            'base_url' => 'https://localise.biz/api',
        ) );
        $this->assertEquals( 'https://localise.biz/api', $client->getBaseUrl() );
        $this->assertEquals('dummy', $client->getConfig('key') );
        return $client;
    }


    /**
     * Fake ping over Guzzle Node test server
     * @group node
     * @depends testFactoryInitializesClient
     */
    public function testNodePing( ApiClient $client ){
        $this->enqueueJson( $client, array( 'version' => '1.1' ) );
        $version = $client->ping()->get('version');
        $this->assertEquals( '1.1', $version );
    }



    /**
     * Fake an invalid ping
     * @group node
     * @group strict
     * @depends testFactoryInitializesClient
     * @expectedException \Guzzle\Service\Exception\ValidationException
     */
    public function testMockInvalidPing( ApiClient $client ){
        $this->enqueueJson( $client, array( 'fail' => 'woops' ) );
        $client->ping();
    }



    /**
     * Queue upo a fake JSON response via node test server
     */    
    private function enqueueJson( ApiClient $client, array $data ){
        $json = json_encode( $data );
        $http = sprintf("HTTP/1.1 200 OK\r\nContent-Length: %u\r\n\r\n%s", strlen($json), $json );
        $this->getServer()->enqueue( $http );
        $client->setBaseUrl( $this->getServer()->getUrl() );
    }    

}

