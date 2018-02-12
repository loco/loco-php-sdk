<?php

namespace Loco\Http;

use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\Guzzle\Serializer;
use Psr\Http\Message\RequestInterface;

/**
 * Override Request serializer to modify authentication mechanism
 */
class LocoRequestSerializer extends Serializer
{
    /**
     * Authorization header is Loco's preferred authorization method.
     * Add Authorization header to request if API key is set, unless query is explicitly configured as auth method.
     * Unset key from command to avoid sending it as a query param.
     *
     * @override
     *
     * @param CommandInterface $command
     * @param RequestInterface $request
     *
     * @return RequestInterface
     *
     * @throws \InvalidArgumentException
     */
    protected function prepareRequest(
        CommandInterface $command,
        RequestInterface $request
    ) {
        if ($command->offsetExists('key') === true) {

            $mode = empty($command->offsetGet('auth')) === false
                    ? $command->offsetGet('auth')
                    : 'loco';

            if ($mode !== 'query') {
                // else use Authorization header of various types
                if ($mode === 'loco') {
                    $value = 'Loco '.$command->offsetGet('key');
                    $request = $request->withHeader('Authorization', $value);
                } elseif ($mode === 'basic') {
                    $value = 'Basic '.base64_encode($command->offsetGet('key').':');
                    $request = $request->withHeader('Authorization', $value);
                } else {
                    throw new \InvalidArgumentException("Invalid auth type: {$mode}");
                }
                // avoid request sending key parameter in query string
                $command->offsetUnset('key');
            }
        }

        return parent::prepareRequest($command, $request);
    }

}
