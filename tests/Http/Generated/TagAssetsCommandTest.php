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
class TagAssetsCommandTest extends ApiClientTestCase
{
    /**
     * Add multiple assets to an existing tag
     */
    public function testTagAssetsCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('tagAssets', $service);
        $model = new MockResponse('Success', $service);

        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->tagAssets($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Success" model');
    }
}
