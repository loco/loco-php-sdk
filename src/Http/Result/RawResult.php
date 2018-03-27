<?php

namespace Loco\Http\Result;

use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

/**
 * Response class for endpoints that return raw, unstructured data that will not be unserialized.
 */
class RawResult implements ClassResultInterface
{
    private $source;

    /**
     * Create a response model object from a completed command
     *
     * @param ResponseInterface $response
     *
     * @return RawResult
     *
     * @throws \GuzzleHttp\Exception\BadResponseException
     */
    public static function fromResponse(ResponseInterface $response)
    {
        if (204 === $response->getStatusCode()) {
            throw new BadResponseException('Response contains no data');
        }
        $result = new self;

        return $result->init($response);
    }

    /**
     * Initialize from http response
     *
     * @internal
     *
     * @param ResponseInterface $response
     *
     * @return ClassResultInterface
     */
    protected function init(ResponseInterface $response)
    {
        $this->source = $response->getBody()->__toString();

        return $this;
    }

    /**
     * Get raw data.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->source;
    }
}
