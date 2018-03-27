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
class GetTranslationsCommandTest extends ApiClientTestCase
{

    /**
     * Get all translations of an asset
     */
    public function testGetTranslationsCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('getTranslations', $service);
        $model = new MockResponse('TranslationList', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->getTranslations($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "TranslationList" model');
    }
}
