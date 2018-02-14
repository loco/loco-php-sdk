<?php

namespace Loco\Tests\Http;

use GuzzleHttp\Command\Result;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

/**
 * Test the live /auth API.
 *
 * @group live
 * @group auth
 * @group readonly
 */
class ApiClientAuthTest extends ApiClientTestCase
{

    private function assertAuthed(Result $result)
    {
        $this->assertInternalType('array', $result->offsetGet('user'));
        $this->assertInternalType('array', $result->offsetGet('group'));
        $this->assertInternalType('array', $result->offsetGet('project'));
    }

    public function testDefaultAuthVerifies()
    {
        $stack = HandlerStack::create();
        $key = static::$config['key'];
        // Create handler to check request was properly serialized
        $stack->push(
            Middleware::mapRequest(
                function (RequestInterface $request) use ($key) {
                    // Assert key is set in header
                    $this->assertTrue($request->hasHeader('Authorization'));
                    $this->assertEquals('Loco '.$key, $request->getHeaderLine('Authorization'));
                    // Assert key is not passed as a query param
                    $this->assertEquals('', $request->getUri()->getQuery());

                    return $request;
                }
            )
        );

        $client = static::getClient(
            [
                'httpHandlerStack' => $stack,
                'auth' => 'loco',
            ]
        );

        $this->assertAuthed($client->authVerify());
    }

    public function testBasicAuthVerifies()
    {
        $stack = HandlerStack::create();
        $key = static::$config['key'];
        // Create handler to chech request was properly serialized
        $stack->push(
            Middleware::mapRequest(
                function (RequestInterface $request) use ($key) {
                    // Assert key is set in header
                    $this->assertTrue($request->hasHeader('Authorization'));
                    $this->assertEquals('Basic '.base64_encode($key.':'), $request->getHeaderLine('Authorization'));
                    // Assert key is not passed as a query param
                    $this->assertEquals('', $request->getUri()->getQuery());

                    return $request;
                }
            )
        );

        $client = static::getClient(
            [
                'httpHandlerStack' => $stack,
                'auth' => 'basic',
            ]
        );

        $this->assertAuthed($client->authVerify());
    }


    public function testLegacyAuthVerifies()
    {
        $stack = HandlerStack::create();
        $key = static::$config['key'];
        // Create handler to chech request was properly serialized
        $stack->push(
            Middleware::mapRequest(
                function (RequestInterface $request) use ($key) {
                    // Assert Authorization header isn't set
                    $this->assertFalse($request->hasHeader('Authorization'));
                    // Assert key is passed as a query param
                    $this->assertEquals("key={$key}", $request->getUri()->getQuery());

                    return $request;
                }
            )
        );

        $client = static::getClient(
            [
                'httpHandlerStack' => $stack,
                'auth' => 'query',
            ]
        );

        $this->assertAuthed($client->authVerify());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidAuthTypeFails()
    {
        $client = static::getClient(['auth' => 'fail']);
        $client->authVerify();
    }

}
