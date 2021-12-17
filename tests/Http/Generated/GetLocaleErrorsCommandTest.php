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
class GetLocaleErrorsCommandTest extends ApiClientTestCase
{
    /**
     * Get validation errors for a project locale
     */
    public function testGetLocaleErrorsCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('getLocaleErrors', $service);
        $model = new MockResponse('TranslationErrorList', $service);

        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->getLocaleErrors($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "TranslationErrorList" model');
    }
}
