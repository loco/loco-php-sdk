<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Service\Resource\Model;

/**
 * Test the live /translations API.
 * @group live
 * @group translations
 */
class ApiClientTranslationsTest  extends ApiClientTest {
    
    
    /**
     * ensure we have an asset to translate
     */
    public function testAssetCreatedForTranslating(){
        $id = 'test-'.md5( microtime() );
        $name = 'Test translations';
        $client = $this->getClient();
        $model = $client->createAsset( compact('id','name') );
        $this->assertEquals( $id, $model['id'] );
        return $id;
    }    
    
    
    
    /**
     * ensure we have a locale to translate into
     */
    public function testLocaleCreatedForTranslating(){
        $rand = substr( md5( microtime() ), 0, 5 );
        $code = 'en-GB-x-'.$rand;
        $client = $this->getClient();
        $model = $client->createLocale( compact('code') );
        $this->assertEquals( $code, $model['code'] );
        return $code;        
    }    
    
    
    
    /**
     * getTranslations
     * @depends testAssetCreatedForTranslating
     * @group readonly
     */
    public function testAssetInTranslationList( $id ){
        $client = $this->getClient();
        $listing = $client->getTranslations( compact('id') );
        $this->assertInternalType( 'array', $listing );
        $native = $listing[0];
        $this->assertInternalType( 'array', $native, 'Native translation of test asset not found in list' );
        $this->assertTrue( $native['translated'], 'Native locales expected to be translated' );
        return $id;
    }   
    
    
    
    /**
     * getTranslation
     * @depends testAssetInTranslationList
     * @depends testLocaleCreatedForTranslating
     * @group readonly
     */
    public function testAssetUntranslatedInitially( $id, $locale ){
        $client = $this->getClient();
        $model = $client->getTranslation( compact('id','locale') );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( $id, $model['id'] );
        $this->assertEquals( $locale, $model['locale']['code'] );
        $this->assertFalse( $model['translated'] );
        $this->assertFalse( $model['flagged'] );
        $this->assertEquals( 0, $model['revision'] );
        return $model;
    }    
    
    
    
    /**
     * translate
     * @depends testAssetUntranslatedInitially
     */    
    public function testTranslate( Model $translation ){
        $client = $this->getClient();
        $model = $client->translate( array (
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
            'translation' => 'Test OK',
        ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertTrue( $model['translated'] );
        $this->assertFalse( $model['flagged'] );
        $this->assertEquals( 1, $model['revision'] );
        //sleep(1);
        return $model;
    }    
    
    
    
    /**
     * @depends testTranslate
     */
    public function testAssetTranslatedAfterTranslation( Model $translation ){
        $client = $this->getClient();
        $model = $client->getTranslation( array(
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
        ) );
        $this->assertTrue( $model['translated'], 'Asset not translated after translation' );
        $this->assertEquals( 1, $model['revision'], 'Asset revision not incremented after translation' );
        return $translation;
    }    
    
    
    
    /**
     * @depends testAssetTranslatedAfterTranslation
     */
    public function testTranslationDuplicateDoesNothing( Model $translation ){
        $client = $this->getClient();
        $model = $client->translate( array (
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
            'translation' => 'Test OK',
        ) );
        $this->assertEquals( 1, $model['revision'], 'Duplicate translation should not bump revision' );
        // no point checking timestamp without sleeping between tests
        //$this->assertEquals( $translation['modified'], $model['modified'], 'Duplicate translation should not alter timestamp' );
        return $model;
    }       
    
    
    
    /**
     * @depends testTranslationDuplicateDoesNothing
     */    
    public function testTranslationChange( Model $translation ){
        $client = $this->getClient();
        $model = $client->translate( array (
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
            'translation' => 'Test OK Again',
        ) );
        $this->assertEquals( 2, $model['revision'], 'Second translation should bump revision' );
        // no point checking timestamp without sleeping between tests
        //$this->assertFalse( $translation['modified'] === $model['modified'], 'Second translation should alter timestamp' );
        return $model;
    }
    
    

    /**
     * @depends testTranslationChange
     */
    public function testTranslationFlagging( Model $translation ){
        $client = $this->getClient();
        $model = $client->flagTranslation( array(
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
            'flag' => 'fuzzy',
        ) );
        $this->assertInstanceOf('\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( 200, $model['status'] );
        $this->assertEquals( 'Flagged as "Fuzzy"', $model['message'] );
        return $translation;
    }    
    
    
    
    /**
     * @depends testTranslationFlagging
     */
    public function testTranslationIncompleteAfterFlagging( Model $translation ){
        $client = $this->getClient();
        $model = $client->getTranslation( array(
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
        ) );
        $this->assertTrue( $model['flagged'], 'Asset should be flagged after flagging' );
        $this->assertTrue( $model['translated'], 'Asset should still be "translated" when flagged' );
        return $translation;
    }



    /**
     * @depends testTranslationIncompleteAfterFlagging
     */    
    public function testUnflagTranslation( Model $translation ){
        $client = $this->getClient();
        $model = $client->unflagTranslation( array(
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
        ) );
        $this->assertInstanceOf('\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( 200, $model['status'] );
        $this->assertEquals( 'Unflagged', $model['message'] );
        return $translation;
    }    
    
    

    /**
     * @depends testTranslationFlagging
     */
    public function testTranslationCompleteAfterUnflagging( Model $translation ){
        $client = $this->getClient();
        $model = $client->getTranslation( array(
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
        ) );
        $this->assertFalse( $model['flagged'], 'Asset should be unflagged after unflagging' );
        return $translation;
    }    



    /**
     * @depends testTranslationCompleteAfterUnflagging
     */   
    public function testUntranslate( Model $translation ){
        $client = $this->getClient();
        $model = $client->untranslate( array (
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
        ) );
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertEquals( 200, $model['status'] );
        $this->assertStringEndsWith( 'translation deleted', $model['message'] );
        //sleep(1);
        return $translation;
    }       
    
    
    
    /**
     * @depends testUntranslate
     */
    public function testAssetUntranslatedAfterDelete( Model $translation ){
        $client = $this->getClient();
        $model = $client->getTranslation( array(
            'id' => $translation['id'],
            'locale' => $translation['locale']['code'],
        ) );
        $this->assertFalse( $model['translated'], 'Asset not untranslated after delete operation' );
        $this->assertFalse( $model['flagged'], 'Asset should not be flagged when no translation exists' );
        $this->assertEquals( 0, $model['revision'], 'Asset revision not zeroed after delete operation' );
        return $model;
    }    
    
    
    
    /**
     * final test deletes asset and locale
     * @depends testAssetUntranslatedAfterDelete
     */
    public function testAssetAndLocaleDeletedFinally( Model $translation ){
        $client = $this->getClient();
        $model = $client->deleteAsset( array('id' => $translation['id']) );
        $this->assertEquals( 200, $model['status'] );
        $model = $client->deleteLocale( array('locale' => $translation['locale']['code']) );
        $this->assertEquals( 200, $model['status'] );
    }    
    
    
}