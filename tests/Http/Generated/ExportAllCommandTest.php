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
class ExportAllCommandTest extends ApiClientTestCase
{

    /**
     * Export your whole project to a multi-locale language pack
     */
    public function testExportAllCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('exportAll', $service);
        $model = new MockResponse('exportAll', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->exportAll($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "exportAll" model');
    }
}
