<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;

/**
 * Test the live /auth API.
 * @group live
 * @group auth
 */
class ApiClientAuthTest  extends ApiClientTest {
    
    
    /**
     * Live test of configured project key
     */
    public function testLiveAuthVerify(){
        $client = $this->getClient();
        $model = $client->authVerify();
        $this->assertInternalType( 'array', $model->get('user') );
        $this->assertInternalType( 'array', $model->get('group') );
        $this->assertInternalType( 'array', $model->get('project') );
    }   


}