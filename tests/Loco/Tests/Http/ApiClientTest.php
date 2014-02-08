<?php

namespace Loco\Tests\Api;

use Loco\Http\ApiClient;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;

/**
 * Test the API client works.
 * Skip tests requiring internet connection with --exclude-group live
 */
class ApiClientTest extends GuzzleTestCase {
    
    /**
     * @covers Loco\Http\ApiClient::factory
     */
    public function testFactoryInitializesClient(){
        $client = ApiClient::factory( array(
            'key' => 'dummy',
        ) );
        $this->assertEquals('https://localise.biz/api', $client->getBaseUrl() );
        $this->assertEquals('dummy', $client->getConfig('key') );
    }


    
    /**
     * Fake ping with Mock response
     * @group mock
     */
    public function testMockPing(){
        $plugin = new MockPlugin();
        $plugin->addResponse( new Response( 200, array(), '{"version":"1.1"}' ) );
        $client = $this->getServiceBuilder()->get('loco');
        $client->addSubscriber( $plugin );
        $version = $client->ping()->get('version');
        $this->assertEquals( '1.1', $version );
    }
    

    
    /**
     * Fake ping over Guzzle Node test server
     * @group node
     */
    public function testNodePing(){
        // set up fake response for ping via node server
        $http = "HTTP/1.1 200 OK\r\nContent-Length: 17\r\n\r\n{\"version\":\"1.1\"}";
        $this->getServer()->enqueue( $http );
        // call Ping()
        $client = clone $this->getServiceBuilder()->get('loco');
        $client->setBaseUrl( $this->getServer()->getUrl() );
        $version = $client->ping()->get('version');
        $this->assertEquals( '1.1', $version );
    }



    /**
     * Live ping test via overloaded service method
     * @group live
     */
    public function testLivePing(){
        $client = $this->getServiceBuilder()->get('loco');
        $sdk_version = $client->getVersion();
        $this->assertEquals( '1.0.1', $sdk_version, 'Service description is not expected version' );
        $api_version = $client->ping()->get('version');
        $this->assertEquals( $sdk_version, $api_version, 'Live API version does not match local SDK version' );
    }



    /**
     * Live 404 test via custom endpoint
     * @expectedException \Guzzle\Http\Exception\BadResponseException
     * @group live
     */    
    public function testLiveFail(){
        $client = $this->getServiceBuilder()->get('loco');
        $client->get('ping/not-found.json')->send();
    }
    
    
    
    
    /**
     * Live file converter test
     * @group live
     */
    public function testLiveConvert(){
        $client = $this->getServiceBuilder()->get('loco');
        $types = array (
            'json' => '{"foo":"bar"}',
            'ios'  => '"foo" = "bar";',
            'yml'  => 'foo: bar',
            'xml'  => '<x><y name="foo">bar</y></x>',
            'php'  => '<?php $foo = "bar";',
        );
        foreach( $types as $ext => $sample ){
            $result = $client->convert( array(
                'from'   => $ext,
                'src'    => $sample,
                'domain' => 'test',
                'locale' => 'fr',
                'ext'    => 'po',
            ) );
            $this->assertInstanceOf('\Loco\Http\Response\RawResponse', $result );
            $this->assertRegExp( '/msgid\s+"foo"\s+msgstr\s+"bar"/', (string) $result );
        }
    }
    
    
    
    /**
     * Live test of configured project key
     * @group live
     */
    public function testLiveAuthVerify(){
        $client = $this->getServiceBuilder()->get('loco');
        $model = $client->authVerify();
        $this->assertInternalType( 'array', $model->get('user') );
        $this->assertInternalType( 'array', $model->get('group') );
        $this->assertInternalType( 'array', $model->get('project') );
    }   

    
    
    /**
     * Live test of single locale export
     * @group live
     */
    public function testLiveExportLocale(){
        $client = $this->getServiceBuilder()->get('loco');
        $result = $client->exportLocale( array(
            'ext' => 'pot',
            'locale' => 'en',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\RawResponse', $result );
        $this->assertRegExp( '/msgid\s+""/', (string) $result );
    }   


    /**
     * Live test of a muilt-locale export in a single file
     * @group live
     */
    public function testLiveExportAll(){
        $client = $this->getServiceBuilder()->get('loco');
        $result = $client->exportAll( array(
            'ext' => 'tmx',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\RawResponse', $result );
        $this->assertContains( '<!DOCTYPE tmx', (string) $result );
    }


    /**
     * Live test of zip archive
     * @group live
     */
    public function testLiveExportArchive(){
        $client = $this->getServiceBuilder()->get('loco');
        $result = $client->exportArchive( array(
            'to' => 'po',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\ZipResponse', $result );
        $zip = $result->getZip();
        $this->assertInstanceOf('\ZipArchive', $zip );
        $this->assertContains( 'Exported', $zip->getArchiveComment() );
        $zip->close();
    }


         
    
}

