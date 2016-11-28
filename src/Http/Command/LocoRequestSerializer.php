<?php

namespace Loco\Http\Command;

use Guzzle\Service\Description\Parameter;
use Guzzle\Service\Command\CommandInterface;
use Guzzle\Service\Command\DefaultRequestSerializer;
use Guzzle\Common\Exception\InvalidArgumentException;
use Guzzle\Service\Command\LocationVisitor\VisitorFlyweight;

/**
 * Override Request serializer to modify authentication mechanism.
 */
class LocoRequestSerializer extends DefaultRequestSerializer
{
    /** @var LocoRequestSerializer */
    protected static $instance;

    /**
     * @return LocoRequestSerializer
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self(VisitorFlyweight::getInstance());
        }

        return self::$instance;
    }

    /**
     * @override
     */
    public function prepare(CommandInterface $command)
    {
        // remap API key to use Authorization request header
        if ($api_key = $command['key']) {
            $mode = $command->getClient()->getConfig('auth') or $mode = 'loco';
            if ('query' !== $mode) {
                // avoid request sending key parameter in query string
                $command['key'] = null;
                // else use Authorization header of various types
                if ('loco' === $mode) {
                    $value = 'Loco '.$api_key;
                } elseif ('basic' === $mode) {
                    $value = 'Basic '.base64_encode($api_key.':');
                } else {
                    throw new InvalidArgumentException('Invalid auth type, '.json_encode($mode));
                }
                $command->getRequestHeaders()->add('Authorization', $value);
            }
        }

        return parent::prepare($command);
    }
}
