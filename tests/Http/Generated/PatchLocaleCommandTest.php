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
class PatchLocaleCommandTest extends ApiClientTestCase
{

    /**
     * Modify a project locale
     */
    public function testPatchLocaleCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('patchLocale', $service);
        $model = new MockResponse('Locale', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->patchLocale($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Locale" model');
    }
}
