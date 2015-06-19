<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use Guzzle\Service\Resource\Model;


/**
 * Test the live /auth API.
 * @group live
 * @group auth
 * @group readonly
 */
class ApiClientAuthTest  extends ApiClientTest {
    
    private function switchAuth( $mode ){
        $client = clone $this->getClient();
        $config = clone $client->getConfig();
        $config->set( 'auth', $mode );
        $client->setConfig( $config );
        return $client;
    }
    
    
    private function assertAuthed( Model $model ){
        $this->assertInternalType( 'array', $model->get('user') );
        $this->assertInternalType( 'array', $model->get('group') );
        $this->assertInternalType( 'array', $model->get('project') );
    }
    
    
    public function testDefaultAuthVerifies(){
        $client = $this->switchAuth('loco');
        $this->assertAuthed( $client->authVerify() );
    }


    public function testBasicAuthVerifies(){
        $client = $this->switchAuth('basic');
        $this->assertAuthed( $client->authVerify() );
    }   


    public function testLegacyAuthVerifies(){
        $client = $this->switchAuth('query');
        $this->assertAuthed( $client->authVerify() );
    }   
    
    
    /**
     * @expectedException Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testInvalidAuthTypeFails(){
        $client = $this->switchAuth('fail');
        $model = $client->authVerify();
    }
    


}