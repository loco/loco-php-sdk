<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Service\Resource\Model;

/**
 * Test the live /assets API.
 * @group live
 * @group assets
 */
class ApiClientAssetsTest  extends ApiClientTest {
    
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
     * getAssets
     * @group readonly
     */
    public function testAssetsList(){
        // top level is array
        $assets = $this->client->getAssets();
        $this->assertInternalType('array', $assets );
        // items are instances of Asset model, but Guzzle won't validate due to primitive being top level.
        $asset = $assets[0]; 
        $this->assertInternalType('array', $asset );
        $this->assertArrayHasKey('id', $asset );
        return $asset;
    }
    
    
    
    /**
     * getAsset
     * @depends testAssetsList
     * @group readonly
     */
    public function testAssetGet( array $asset ){
        $model = $this->client->getAsset( array( 'id' => $asset['id'] ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $id = $model['id'];
        $this->assertEquals( $asset['id'], $id );
    }    



    /**
     * createAsset
     */
    public function testAssetCreate(){
        $slug = 'test-'.substr( md5( microtime() ), 0, 5 );
        $name = 'Test asset';
        $model = $this->client->createAsset( array( 'id' => $slug, 'name' => $name ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( $slug, $model['id'] );
        $this->assertEquals( $name, $model['name'] );
        $this->assertEquals( 'text', $model['type'] );
        return $slug;
    }

    
    
    /**
     * tagAsset
     * @depends testAssetCreate
     */
    public function testAssetTag( $id ){
        $name = 'Test tag';
        $model = $this->client->tagAsset( compact('id','name') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertInternalType( 'array', $model['tags'] );
        $this->assertContains( $name, $model['tags'] );
    }

    
    
    /**
     * patchAsset
     * @depends testAssetCreate
     */
    public function testAssetPatch( $id ){
        $name = 'Renamed OK';
        $notes = 'Notes field OK';
        $context = 'Context field OK';
        $model = $this->client->patchAsset( compact('id','name','notes','context') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( $id, $model['id'] );
        $this->assertEquals( $name, $model['name'] );
        $this->assertEquals( $notes, $model['notes'] );
        $this->assertEquals( $context, $model['context'] );
        return $id;
    }
    
    
    
    /**
     * patchAsset with failure
     * @depends testAssetCreate
     * @expectedException \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function testAssetPatchRejectsUnpatchable( $slug ){
        $this->client->patchAsset( array( 'id' => $slug, 'translated' => 0 ) );
    }
    
    
    
    /**
     * createPlural
     * @depends testAssetPatch
     */
    public function testCreateNewPlural( $slug ){
        $name = 'Plural of Test Asset';
        $model = $this->client->createPlural( array( 'id' => $slug, 'name' => $name ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( $name, $model['name'] );
        // number translated will depend on whether locales exist that must have this blank (e.g. zero plural langs)
        $this->assertGreaterThan( 0, $model['progress']['translated'] );
        return $model['id'];
    }
    
    
    
    /**
     * createPlural with deliberate failure creating plural of a plural
     * @depends testCreateNewPlural
     * @expectedException \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function testCreatePluralOfPluralFails( $slug ){
        $model = $this->client->createPlural( array( 'id' => $slug, 'name' => '_' ) );
    }

    
    
    /**
     * unlinkPlural
     * @depends testAssetPatch
     * @depends testCreateNewPlural
     */    
    public function testUnlinkPlural( $id, $pid ){
        $model = $this->client->unlinkPlural( compact('id','pid') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( 'Plural form unlinked', $model['message'] );
        return $pid;
    }    
    
    
    
    /**
     * createPlural with existing asset
     * @depends testAssetPatch
     * @depends testUnlinkPlural
     */
    public function testPluralCreateFromExisting( $id, $pid ){
        $name = 'Plural Asset renamed';
        $model = $this->client->createPlural( compact('id','name','pid') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( $pid, $model['id'] );
        $this->assertEquals( $name, $model['name'] );
        return $pid;
    }
    
         
    
    /**
     * deleteAsset
     * @depends testAssetPatch
     * @depends testPluralCreateFromExisting
     */
    public function testAssetDelete( $id1, $id2 ){
        foreach( func_get_args() as $slug ){
            $model = $this->client->deleteAsset( array( 'id' => $slug ) );
            $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
            $this->assertEquals( 200, $model['status'] );
        }
    }   


     
    
}

