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
class ImportCommandTest extends ApiClientTestCase
{

    /**
     * Import assets and translations from a language pack file
     */
    public function testImportCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('import', $service);
        $model = new MockResponse('ImportResult', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->import($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "ImportResult" model');
    }
}
