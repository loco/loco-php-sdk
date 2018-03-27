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
class PatchTagCommandTest extends ApiClientTestCase
{

    /**
     * Modify a single tag
     */
    public function testPatchTagCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('patchTag', $service);
        $model = new MockResponse('Success', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->patchTag($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Success" model');
    }
}
