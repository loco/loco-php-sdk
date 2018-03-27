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
class TranslateCommandTest extends ApiClientTestCase
{

    /**
     * Add a new translation in a given locale
     */
    public function testTranslateCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('translate', $service);
        $model = new MockResponse('Translation', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->translate($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Translation" model');
    }
}
