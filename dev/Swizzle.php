<?php

namespace Loco\Dev;

use Loco\Utils\Swizzle\Swizzle as SwizzleBase;

/**
 * Override Swizzle to modify service description as applicable for this SDK
 */
class Swizzle extends SwizzleBase
{

    /**
     * Override with default response class
     * {@inheritDoc}
     */
    public function getResponseClass($name)
    {
        return parent::getResponseClass($name) ?: 'GuzzleHttp\\Command\\Result';
    }


    /*
     * Override to add documentationUrl
     * {@inheritDoc}
     */
    public function toArray()
    {
        $export = parent::toArray();
        foreach ($export['operations'] as $i => $op) {
            $folder = pathinfo(explode('/', ltrim($op['uri'], '/'), 3)[1], PATHINFO_FILENAME);
            $export['operations'][$i]['documentationUrl'] = $export['baseUri'].'api/docs/'.$folder.'/'.strtolower($op['name']);
        }

        return $export;
    }
}
