<?php

namespace Loco\Http;

use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\Guzzle\DescriptionInterface;
use GuzzleHttp\Command\Guzzle\Deserializer as DefaultDeserializer;
use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Command\Guzzle\SchemaValidator;
use GuzzleHttp\Command\Result;
use GuzzleHttp\Command\ResultInterface;
use Loco\Exception\ValidationException;
use Loco\Http\Result\ClassResultInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Deserializer extends DefaultDeserializer
{
    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * @var SchemaValidator
     */
    protected $validator;

    /**
     * @param DescriptionInterface $description
     * @param bool $process
     * @param ResponseLocationInterface[] $responseLocations Extra response locations
     * @param bool $validateResponse optionally specify response validation
     */
    public function __construct(
        DescriptionInterface $description,
        $process,
        array $responseLocations = [],
        $validateResponse = false
    ) {
        if ($validateResponse === true) {
            $this->validator = new SchemaValidator();
        }
        parent::__construct($description, $process, $responseLocations);
    }

    /**
     * Deserialize the response into the specified result representation
     *
     * @param ResponseInterface $response
     * @param RequestInterface|null $request
     * @param CommandInterface $command
     *
     * @return Result|ResultInterface|ResponseInterface|ClassResultInterface
     * @throws \Loco\Exception\ValidationException
     */
    public function __invoke(ResponseInterface $response, RequestInterface $request, CommandInterface $command)
    {
        $this->command = $command;

        return parent::__invoke($response, $request, $command);
    }

    /**
     * Handles visit() and after() methods of the Response locations
     *
     * @param Parameter $model
     * @param ResponseInterface $response
     *
     * @return Result|ResultInterface|ResponseInterface|ClassResultInterface
     *
     * @throws \InvalidArgumentException
     * @throws \Loco\Exception\ValidationException
     */
    protected function visit(Parameter $model, ResponseInterface $response)
    {
        if ($model->getType() === 'class') {
            if (isset($model->toArray()['class'])) {
                $class = $model->toArray()['class'];
                if (is_subclass_of($class, ClassResultInterface::class)) {
                    $result = $class::fromResponse($response);
                } else {
                    throw new \InvalidArgumentException(
                        'Result class should implement '.ClassResultInterface::class
                        ." Unable to deserialize response into {$class}"
                    );
                }
            } else {
                throw new \InvalidArgumentException(
                    "Model type is \"class\", but \"class\" parameter isn't defined for model {$model->getName()}"
                );
            }
        } elseif ($model->getType() === 'response') {
            return $response;
        } else {
            $result = parent::visit($model, $response);
            if (isset($model->toArray()['class'])) {
                $class = $model->toArray()['class'];
                if (is_subclass_of($class, ResultInterface::class)) {
                    $result = new $class($result->toArray());
                } else {
                    throw new \InvalidArgumentException(
                        'Result class should implement '.ResultInterface::class
                        ." Unable to deserialize response into {$class}"
                    );
                }
            }
        }

        if ($this->validator instanceof SchemaValidator && $result instanceof ResultInterface) {
            $res = $result->toArray();
            if ($this->validator->validate($model, $res) === false) {
                throw new ValidationException(
                    'Response failed model validation: '.implode("\n", $this->validator->getErrors()),
                    $this->command
                );
            }
        }

        return $result;
    }
}
