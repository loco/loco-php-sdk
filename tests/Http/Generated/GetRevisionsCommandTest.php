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
class GetRevisionsCommandTest extends ApiClientTestCase
{
    /**
     * Get previous revisions of a translation
     */
    public function testGetRevisionsCommandSuccess()
    {
        $service = $this->getServiceDescription();
        $query = new MockRequest('getRevisions', $service);
        $model = new MockResponse('RevisionList', $service);

        $client = $this->getClientWithMockedResponse(
            [ 'base_uri' => 'https://example.com/api' ],
            $model->toArray()
        );

        $result = $client->getRevisions($query->toArray());
        $this->assertInstanceOf($model->getResponseClass(), $result, 'Bad class for "RevisionList" model');
    }
}
