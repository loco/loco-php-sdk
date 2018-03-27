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
class GetLocalesCommandTest extends ApiClientTestCase
{

    /**
     * List all locales in your project
     */
    public function testGetLocalesCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('getLocales', $service);
        $model = new MockResponse('LocaleList', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->getLocales($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "LocaleList" model');
    }
}
