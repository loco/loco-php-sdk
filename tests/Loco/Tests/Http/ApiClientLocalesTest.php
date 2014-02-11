<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Service\Resource\Model;

/**
 * Test the live /locales API.
 * @group live
 * @group locales
 */
class ApiClientLocalesTest  extends ApiClientTest {
    
    
    public function testLocalesList(){
        $client = $this->getClient();
        $list = $client->locales();
        // model would be a typed array model, except not supported in Guzzle.
        //$this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $list );
        $this->assertInternalType('array', $list );
        
        $locale = $list[0]; 
        $this->assertArrayHasKey('code', $locale );
    }
    
    
}

