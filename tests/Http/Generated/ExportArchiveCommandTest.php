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
class ExportArchiveCommandTest extends ApiClientTestCase
{

    /**
     * Export all locales to a zip archive
     */
    public function testExportArchiveCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('exportArchive', $service);
        $model = new MockResponse('exportArchive', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->exportArchive($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "exportArchive" model');
    }
}
