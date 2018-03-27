<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;

/**
 * Test the live /ping API.
 * @group live
 * @group ping
 * @group readonly
 */
class ApiClientPingTest  extends ApiClientTest {
    
    
    /**
     * Live ping test via overloaded service method
     */
    public function testLivePing(){
        $client = $this->getClient();
        $sdk_version = $client->getVersion();
        $api_version = $client->getApiVersion();
        $this->assertSame( $sdk_version, $api_version, 'API version does not match SDK version' );
        $api_version = $client->ping()->get('version');
        // legacy SDK no longer built to latest API version, so live version should be greater
        $this->assertTrue(  version_compare($api_version,$sdk_version,'>'), 'Live version expected to be ahead of sdk build' );
    }


    /**
     * Live 404 test via custom endpoint
     * @expectedException \Guzzle\Http\Exception\BadResponseException
     */    
    public function testLiveFail(){
        $client = $this->getClient();
        $client->get('ping/not-found.json')->send();
    }
    
    
}

