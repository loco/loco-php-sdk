<?php

namespace Loco\Dev;

use Loco\Utils\Swizzle\Swizzle as SwizzleBase;

/**
 * Override Swizzle to modify service description as applicable for this SDK
 */
class Swizzle extends SwizzleBase
{

    /**
     * {@inheritDoc}
     */
    public function getResponseClass($name)
    {
        return parent::getResponseClass($name) ?: 'GuzzleHttp\\Command\\Result';
    }
}
