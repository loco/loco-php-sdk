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
        $plugin->addResponse( new Response( 200, array(), '{"ping":"pang"}' ) );
        $client = $this->getServiceBuilder()->get('loco');
        $client->addSubscriber( $plugin );
        $pong = $client->ping()->get('ping');
        $this->assertEquals( 'pang', $pong );
    }
    

    
    /**
     * Fake ping over Guzzle Node test server
     * @group node
     */
    public function testNodePing(){
        // set up fake response for ping via node server
        $http = "HTTP/1.1 200 OK\r\nContent-Length: 15\r\n\r\n{\"ping\":\"pang\"}";
        $this->getServer()->enqueue( $http );
        // call Ping()
        $client = clone $this->getServiceBuilder()->get('loco');
        $client->setBaseUrl( $this->getServer()->getUrl() );
        $pong = $client->ping()->get('ping');
        $this->assertEquals( 'pang', $pong );
    }



    /**
     * Live ping test via overloaded service method
     * @group live
     */
    public function testLivePing(){
        $client = $this->getServiceBuilder()->get('loco');
        $pong = $client->ping()->get('ping');
        $this->assertContains( 'pong', $pong );
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
                'to'     => 'po',
            ) );
            $this->assertInstanceOf('\Loco\Http\Response\ConvertResponse', $result );
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
            'to' => 'pot',
            'locale' => 'en',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\ConvertResponse', $result );
        $this->assertRegExp( '/msgid\s+""/', (string) $result );
    }   


    /**
     * Live test of a muilt-locale export in a single file
     * @group live
     */
    public function testLiveExportAll(){
        $client = $this->getServiceBuilder()->get('loco');
        $result = $client->exportAll( array(
            'to' => 'tmx',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\ConvertResponse', $result );
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
        $this->assertInstanceOf('\Loco\Http\Response\ConvertResponse', $result );
        $bin = (string) $result;
        // check response is zip file.
        $tmp = tempnam( sys_get_temp_dir(), 'loco_zip_' );
        register_shutdown_function( 'unlink', $tmp );
        file_put_contents( $tmp, $bin );
        $zip = new \ZipArchive;
        $res = $zip->open( $tmp, \ZipArchive::CHECKCONS );
        $this->assertTrue( $res );
    }


         
    
}

