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
        
        // top level is list model
        $locales = $client->locales();
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $locales );
        
        // deeper properties are all cast to arrays
        $locale = $locales->get('source');
        $this->assertInternalType('array', $locale );

        $targets = $locales->get('targets');
        $this->assertInternalType('array', $targets );
        
        $locale = $targets[0]; 
        $this->assertInternalType('array', $locale );
        $this->assertArrayHasKey('code', $locale );
    }
    
    
}

