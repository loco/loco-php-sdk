<?php

namespace Loco\Tests\Api;

use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Tests\GuzzleTestCase;

/**
 * Tests Guzzle's internal modelling logic.
 */
class ModelTest extends GuzzleTestCase {

    /**
     * @group mock
     */
    public function testModel(){

        // Define a service with a test() method
        $service = ServiceDescription::factory( array(
          'name' => 'test-service',
          'operations' => array (
            'test' => array (
              'uri' => '/test.json',
              'httpMethod' => 'GET',
              'responseClass' => 'TestModel',
            ),
          ),
          'models' => array (
            'TestModel' => array (
              'type' => 'object',
              'additionalProperties' => false,
              'properties' => array (
                // property that will exist in response
                'foo' => array (
                  'type' => 'integer',
                  'location' => 'json',
                ),
                // property that won't exist in response
                'bar' => array (
                  'type' => 'integer',
                  'location' => 'json',
                ),
              ),
            ),
          ),
        ) );

        $client = new Client;
        $client->setDescription( $service );
        
        // fake a response with valid "foo" and invalid "baz" properties
        $plugin = new MockPlugin();
        $plugin->addResponse( new Response( 200, array(), '{"foo":1,"baz":"nan"}' ) );
        $client->addSubscriber( $plugin );
        $response = $client->test();

        // test value of "foo" key, which will exist
        $this->assertEquals( 1, $response->get('foo') );

        // test value of "bar" key which isn't in response
        // Why doesn't the model complain this is missing in response?
        $this->assertEquals( null, $response->get('bar') );        -

        // test value of "baz" key, which should be absent from the model
        $this->assertNull( $response->get('baz') );

    }
    
}
