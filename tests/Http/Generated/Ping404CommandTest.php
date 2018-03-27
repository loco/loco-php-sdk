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
class Ping404CommandTest extends ApiClientTestCase
{

    /**
     * Get a test 404 response
     */
    public function testPing404CommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('ping404', $service);
        $model = new MockResponse('Error', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->ping404($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Error" model');
    }
}
