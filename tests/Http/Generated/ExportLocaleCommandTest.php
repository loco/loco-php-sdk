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
class ExportLocaleCommandTest extends ApiClientTestCase
{

    /**
     * Export a single locale to a language pack.
     */
    public function testExportLocaleCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('exportLocale', $service);
        $model = new MockResponse('exportLocale', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->exportLocale($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "exportLocale" model');
    }
}
