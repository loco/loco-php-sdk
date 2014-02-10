<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;

/**
 * Test the live /locales API.
 * @group live
 * @group locales
 */
class ApiClientLocalesTest  extends ApiClientTest {
    
    
    public function testLocalesList(){
        $client = $this->getClient();
        $list = $client->locales();
        $this->assertInternalType( 'array', $list );
        //$this->assertCount( 9, $list ); // <- samples project
        $locale = $list[0]; 
        // @todo see how Guzzle implements model containers ??
        // https://github.com/wordnik/swagger-core/wiki/Datatypes
        $this->assertArrayHasKey('code', $locale );
    }
    
    
}

