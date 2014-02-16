<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;

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
     * Fake ping with mock response
     * @group mock
     * @depends testFactoryInitializesClient
     */
    public function testMockPing( ApiClient $client ){
        $plugin = new MockPlugin();
        $plugin->addResponse( new Response( 200, array(), '{"version":"1.1"}' ) );
        $client->addSubscriber( $plugin );
        $version = $client->ping()->get('version');
        $this->assertEquals( '1.1', $version );
    }


    
    /**
     * Fake an invalid ping
     * @group mock
     * @group strict
     * @depends testFactoryInitializesClient
     * @expectedException \Guzzle\Service\Exception\ValidationException
     */
    public function testMockInvalidPing( ApiClient $client ){
        $plugin = new MockPlugin();
        $plugin->addResponse( new Response( 200, array(), '{"fail":true}' ) );
        $client->addSubscriber( $plugin );
        $client->ping();
    }
    

    
    /**
     * Fake ping over Guzzle Node test server
     * @group node
     * @depends testFactoryInitializesClient
     */
    public function testNodePing( ApiClient $client ){
        // set up fake response for ping via node server
        $http = "HTTP/1.1 200 OK\r\nContent-Length: 17\r\n\r\n{\"version\":\"1.1\"}";
        $this->getServer()->enqueue( $http );
        $client->setBaseUrl( $this->getServer()->getUrl() );
        $version = $client->ping()->get('version');
        $this->assertEquals( '1.1', $version );
    }


}

