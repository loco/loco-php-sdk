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
class ExportTemplateCommandTest extends ApiClientTestCase
{

    /**
     * Export a template containing only source keys
     */
    public function testExportTemplateCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('exportTemplate', $service);
        $model = new MockResponse('exportTemplate', $service);
    
        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->exportTemplate($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "exportTemplate" model');
    }
}
