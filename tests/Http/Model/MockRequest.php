<?php

namespace Loco\Tests\Http\Model;

use GuzzleHttp\Command\Guzzle\DescriptionInterface;

/**
 *
 */
class MockRequest extends MockModel
{
    public function __construct($methodId, DescriptionInterface $service)
    {
        $operation = $service->getOperation($methodId);
        $this->build($operation->getParams());
    }
}
