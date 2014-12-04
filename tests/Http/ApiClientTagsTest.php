<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Service\Resource\Model;

/**
 * Test the live /tags API.
 * @group live
 * @group tags
 */
class ApiClientTagsTest  extends ApiClientTest {
    
    /**
     * @var ApiClient
     */
    private $client;
    
    
    /**
     * Instantiate client for each test.
     */
    public function setUp(){
        $this->client = $this->getClient();
    }
        
    
    /**
     * getTags
     */
    public function testTagsList(){
        $tags = $this->client->getTags();
        $this->assertInternalType('array', $tags );
        $tag = current( $tags );
        $this->assertInternalType('string', $tag );
        return $tag;
    }


    /**
     * patchTag
     * @depends testTagsList
     */
    public function testPatchTag( $tag ){
        $name = $tag.' renamed';
        $model = $this->client->patchTag( compact('tag','name') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( 'Tag renamed', $model['message'] );
    }    
     
    
}

