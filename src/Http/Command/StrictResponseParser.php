<?php

namespace Loco\Http\Command;

use Guzzle\Service\Command\OperationResponseParser;
use Guzzle\Service\Command\LocationVisitor\VisitorFlyweight;

/**
 * Response parser that enables schema to be injected into response models.
 */
class StrictResponseParser extends OperationResponseParser
{
    /** 
     * Singleton.
     *
     * @var StrictResponseParser
     */
    protected static $instance;

    /**
     * Get singleton.
     *
     * @return StrictResponseParser
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new self(VisitorFlyweight::getInstance(), true);
        }

        return static::$instance;
    }
}
