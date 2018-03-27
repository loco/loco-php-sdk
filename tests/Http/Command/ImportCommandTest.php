<?php

namespace Loco\Tests\Http\Command;

use Loco\Tests\Http\ApiClientTestCase;
use Loco\Tests\Http\Model\MockRequest;
use Loco\Tests\Http\Model\MockResponse;

/**
 * Additional tests for importer
 */
class ImportCommandTest extends ApiClientTestCase
{
    public function testAsyncSwitchReturnsSameModel()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('import', $service);
        $model = new MockResponse('ImportResult', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        // Switch to async import. Mock data will always be false
        // this would only fail if library code was switching respone model based on async param
        $args = $query->toArray();
        $args['async'] = true;

        $result = $client->import($args);
        $this->assertInstanceOf($model->getResponseClass(), $result);

        return $client;
    }


    /**
     * @expectedException GuzzleHttp\Command\Exception\CommandException
     * @expectedExceptionMessage [ext] is a required string
     */
    public function testFileExtensionParameterMandatory()
    {
        $client = $this->getClientWithMockedResponse([], []);
        $client->import([]);
    }


    public function testSourceFieldPostsRawBody()
    {
        $model = new MockResponse('ImportResult', $this->getServiceDescription());
        $mocked = new \ArrayIterator;

        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray(),
            200,
            $mocked
        );
        $client->import([
            'ext' => 'json',
            'index' => 'id',
            'locale' => 'en',
            'src' => '{"foo":"Foo","bar":"Bar","baz":"Baz"}',
        ]);
        $this->assertCount(1, $mocked);
        $request = $mocked[0]['request'];
        $this->assertSame('{"foo":"Foo","bar":"Bar","baz":"Baz"}', (string) $request->getBody());
    }
}
