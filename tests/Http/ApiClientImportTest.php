<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;

/**
 * Test the live /import API.
 * @group live
 * @group importer
 */
class ApiClientImportTest extends ApiClientTest {
    
    
    /**
     * @var ApiClient
     */
    private $client;

    /**
     * IDs of assets imported
     */
    private $assets = array();
    
    /**
     * Expected translations to test for
     */    
    private $expect = array (
        'example'  => 'exemple',
        'examples' => 'exemples',
        'sample'   => 'échantillon',
    );
         
    
    /**
     * Ensure client available to all tests
     */    
    public function setUp(){
        if( ! $this->client ){
            $this->client = $this->getClient();
        }
    }     
    
    
    /**
     * Trash imported assets between each test
     */    
    public function tearDown(){
        while( $id = array_pop( $this->assets ) ){
            $param = compact('id');
            $this->client->deleteAsset( $param );
        }
    }
    
    
    
    /**
     * Do import from file exported by converter tests.
     */
    private function _import( $sourcefile, $index = '', $locale = '' ){
        $sourcefile = __DIR__.'/Fixtures/export/'.$sourcefile;
        $src = file_get_contents( $sourcefile );
        $ext = pathinfo( $sourcefile, PATHINFO_EXTENSION );
        $params = compact('index','locale','src','ext');
        $model = $this->client->import( $params );
        // model response should always have assets and locales keys even if nothing imported
        $this->assertInstanceOf( '\Guzzle\Service\Resource\Model', $model );
        $this->assertInternalType( 'array', $model['assets'] );
        $this->assertInternalType( 'array', $model['locales'] );
        // check presence of all assets known to be in file
        $found = array();
        foreach( $model['assets'] as $asset ){
            $this->assertArrayHasKey( 'id', $asset );
            $found[] = $asset['id'];
        }
        $expect = array_keys( $this->expect );
        $this->assets = array_intersect( $found, $expect );
        sort( $this->assets );
        $this->assertEquals( $expect, $this->assets, 'Expected assets not in response, got '.json_encode($found) );
        // assets all imported, check them on the server too
        // will throw with 404 if asset does not exist
        foreach( $this->assets as $id ){
            $asset = $this->client->getAsset( compact('id') );
        }
        // check locales were used
        if( $locale ){
            // index them first
            $locales = array();
            foreach( $model['locales'] as $l ){
                $locales[ $l['code'] ] = $l;
            }
            // English should always have been used if any locale is set
            $this->assertArrayHasKey( 'en_GB', $locales, 'english not returned in locales' );
            // check all english translations exist and are correct
            foreach( $this->assets as $id ){
                $param = compact('id') + array( 'locale' => 'en' );
                $trans = $this->client->getTranslation( $param );
                // english translation same as slug for simpler testing
                $this->assertEquals( $id, $trans['translation'], 'English not imported correctly' ); 
            }
            // Specifying english only means no translations should exist in non-english locales
            if( 0 === strpos($locale,'en') ){
                $this->assertCount( 1, $locales );
                foreach( $this->assets as $id ){
                    $param = compact('id') + array( 'locale' => 'fr' );
                    $trans = $this->client->getTranslation( $param );
                    $this->assertFalse( $trans['translated'], 'Should not be translated, but is' ); 
                }
            }
            // else check foreign translations as intended to import
            else {
                $this->assertCount( 2, $locales );
                $this->assertArrayHasKey( $locale, $locales, 'foreign locale not returned in locales' );
                // check all foreign translations exist and are correct
                foreach( $this->expect as $id => $foreign ){
                    $param = compact('id','locale');
                    $trans = $this->client->getTranslation( $param );
                    $this->assertEquals( $foreign, $trans['translation'], $locale.' not translated' ); 
                }
            }
        }
        return $model;
    }      

    
    
    /**
     * import YAML with assets only, no translations
     */
    public function testYamlImportAssetsOnly(){
        $this->_import('test-fr_FR.yml', 'id' );
    }

    
    
    /**
     * import YAML with keys as native texts
     */
    public function testYamlImportEnglish(){
        $this->_import('test-fr_FR.yml', 'text', 'en_GB' );
    }


    
    /**
     * import YAML with keys as native texts plus french translations
     */
    public function testYamlImportFrench(){
        $this->_import('test-fr_FR.yml', 'text', 'fr_FR' );
    }

    
}
