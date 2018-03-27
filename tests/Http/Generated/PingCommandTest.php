<?php

namespace Loco\Tests\Http\Generated;

use Loco\Tests\Http\ApiClientTestCase;
use Loco\Tests\Http\Model\MockRequest;
use Loco\Tests\Http\Model\MockResponse;

/**
 * Auto-generated Loco API command test.
 *
 * DO NOT EDIT
 *
 * @group built
 */
class PingCommandTest extends ApiClientTestCase
{

    /**
     * Check the API is up
     */
    public function testPingCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('ping', $service);
        $model = new MockResponse('PingResponse', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->ping($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "PingResponse" model');
    }
}
