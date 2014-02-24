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
     * getAssets
     */
    public function testAssetsList(){
        $client = $this->getClient();
        // top level is array
        $assets = $client->getAssets();
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
     */
    public function testAssetGet( array $asset ){
        $client = $this->getClient();
        $model = $client->getAsset( array( 'id' => $asset['id'] ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $id = $model['id'];
        $this->assertEquals( $asset['id'], $id );
    }    



    /**
     * createAsset
     */
    public function testAssetCreate(){
        $slug = 'test-'.md5( microtime() );
        $name = 'Test asset';
        $client = $this->getClient();
        $model = $client->createAsset( array( 'id' => $slug, 'name' => $name ) );
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
    public function testAssetTag( $slug ){
        $name = 'Test tag';
        $client = $this->getClient();
        $model = $client->tagAsset( array( 'id' => $slug, 'name' => $name ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertInternalType( 'array', $model['tags'] );
        $this->assertContains( 'test-tag', $model['tags'] );
    }

    
    
    /**
     * patchAsset
     * @depends testAssetCreate
     */
    public function testAssetPatch( $slug ){
        $name = 'Renamed OK';
        $client = $this->getClient();
        $model = $client->patchAsset( array( 'id' => $slug, 'name' => $name ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( $name, $model['name'] );
        return $slug;
    }
    
    
    
    /**
     * patchAsset with failure
     * @depends testAssetCreate
     * @expectedException \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function testAssetPatchRejectsReadonly( $slug ){
        $client = $this->getClient();
        $client->patchAsset( array( 'id' => $slug, 'translated' => 0 ) );
    }
    
    
    
    /**
     * patchAsset with harmless attempt to set read-only property as same value
     * #depends testAssetCreate
     * @ignore
     * This test is redundant now that models is restricted to AssetPatch subset 
     */
    public function _testAssetPatchPassesThroughReadonly( $slug ){
        $client = $this->getClient();
        $client->patchAsset( array( 'id' => $slug, 'translated' => 1 ) );
    }
         
    
    
    /**
     * deleteAsset
     * @depends testAssetPatch
     */
    public function testAssetDelete( $slug ){
        $client = $this->getClient();
        $model = $client->deleteAsset( array( 'id' => $slug ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( 200, $model['status'] );
    }   


     
    
}

