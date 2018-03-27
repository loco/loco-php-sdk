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
class UntranslateCommandTest extends ApiClientTestCase
{

    /**
     * Erase translation data in a single locale
     */
    public function testUntranslateCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('untranslate', $service);
        $model = new MockResponse('Success', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->untranslate($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "Success" model');
    }
}
