<?php

namespace Loco\Tests\Http\Model;

use GuzzleHttp\Command\Guzzle\DescriptionInterface;

/**
 *
 */
class MockResponse extends MockModel
{

    /**
     * @var string
     */
    private $responseClass;


    public function __construct($modelId, DescriptionInterface $service)
    {
        $models = $service->getModels();
        $model = $models[$modelId];
        if ('class' === $model->getType()) {
            $this->responseClass = $model->toArray()['class'];
        }
        $this->build($model->getProperties());
    }


    /**
     * @return string
     */
    public function getResponseClass()
    {
        return $this->responseClass ?: 'GuzzleHttp\\Command\\Result';
    }
}
