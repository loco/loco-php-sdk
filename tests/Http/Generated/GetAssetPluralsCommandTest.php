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
class GetAssetPluralsCommandTest extends ApiClientTestCase
{

    /**
     * Get plural forms of an asset
     */
    public function testGetAssetPluralsCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('getAssetPlurals', $service);
        $model = new MockResponse('AssetList', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->getAssetPlurals($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "AssetList" model');
    }
}
