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
     * List all tags in project
     */
    public function testGetTags(){
        $tags = $this->client->getTags();
        $this->assertInternalType('array', $tags );
        $tag = current( $tags );
        $this->assertInternalType('string', $tag );
        return $tag;
    }
    
    
    /**
     * createTag
     */
    public function testCreateTag(){
        $name = md5( __CLASS__.__FUNCTION__.microtime() );
        $model = $this->client->createTag( compact('name') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertSame( 201, $model['status'] );
        $this->assertEquals( 'Tag created', $model['message'] );
        return $name;
    }
    


    /**
     * @depends testCreateTag
     */
    public function testPatchTag( $tag ){
        $name = $tag.' renamed';
        $model = $this->client->patchTag( compact('tag','name') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertSame( 200, $model['status'] );
        $this->assertEquals( 'Tag renamed', $model['message'] );
        return $name;
    }    
    
    
    /**
     * @depends testPatchTag
     */    
    public function testDeleteTag( $tag ){
        $model = $this->client->deleteTag( compact('tag') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertSame( 200, $model['status'] );
        $this->assertEquals( 'Tag deleted', $model['message'] );
    }    
    
     
    
}

