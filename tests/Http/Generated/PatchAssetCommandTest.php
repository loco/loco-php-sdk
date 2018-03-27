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
class PatchAssetCommandTest extends ApiClientTestCase
{

    /**
     * Modify a single asset
     */
    public function testPatchAssetCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('patchAsset', $service);
        $model = new MockResponse('Asset', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->patchAsset($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Asset" model');
    }
}
