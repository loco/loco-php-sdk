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
class {{TemplateCommand}}Test extends ApiClientTestCase
{
    /**
     * {{description}}
     */
    public function test{{TemplateCommand}}Success()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('{{method}}', $service);
        $model = new MockResponse('{{model}}', $service);

        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->{{method}}($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "{{model}}" model');
    }
}
