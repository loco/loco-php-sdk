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
class CreateAssetCommandTest extends ApiClientTestCase
{

    /**
     * Add a new translatable asset
     */
    public function testCreateAssetCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('createAsset', $service);
        $model = new MockResponse('Asset', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->createAsset($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Asset" model');
    }
}
