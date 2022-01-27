<?php

namespace Loco\Http\Request;

use GuzzleHttp\Command\Guzzle\RequestLocation\AbstractLocation;
use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\Guzzle\Parameter;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Adds a raw/binary body to a request.
 * This is here because: https://github.com/guzzle/guzzle-services/issues/160
 */
class BodyLocation extends AbstractLocation
{
    /**
     * Set the name of the location
     *
     * @param string $locationName
     */
    public function __construct($locationName = 'body')
    {
        parent::__construct($locationName);
    }

    /**
     * @param CommandInterface $command
     * @param RequestInterface $request
     * @param Parameter        $param
     *
     * @return MessageInterface
     * @throws \RuntimeException
     */
    public function visit(
        CommandInterface $command,
        RequestInterface $request,
        Parameter $param
    ) {
        $value = $request->getBody()->getContents();
        if ('' !== $value) {
            throw new \RuntimeException('Only one "body" location may exist per operation');
        }

        // binary string data from bound parameter
        $value = $command[$param->getName()];
        $request = $request->withHeader('Content-Type', 'application/octet-stream');

        // guzzle-services composer.json has guzzlehttp/psr7: ^1.7 || ^2.0
        // https://github.com/loco/loco-php-sdk/issues/12
        $createBody = ['\\GuzzleHttp\\Psr7\\Utils','streamFor'];
        if (! is_callable($createBody)) {
            $createBody = '\\GuzzleHttp\\Psr7\\stream_for';
            if (! function_exists($createBody)) {
                throw new \RuntimeException('Unknown \\GuzzleHttp\\Psr7 version');
            }
        }
        return $request->withBody(call_user_func($createBody, $value));
    }
}
