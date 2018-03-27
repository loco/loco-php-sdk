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
class GetAssetCommandTest extends ApiClientTestCase
{

    /**
     * Get a project asset
     */
    public function testGetAssetCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('getAsset', $service);
        $model = new MockResponse('Asset', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->getAsset($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Asset" model');
    }
}
