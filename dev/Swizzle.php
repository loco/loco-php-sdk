<?php

namespace Loco\Dev;

use Loco\Utils\Swizzle\Swizzle as SwizzleBase;

/**
 * Override Swizzle to modify service description as its built.
 * Would prefer to modify operations on the fly, but they're locked into construction of entire API description.
 */
class Swizzle extends SwizzleBase
{

    /**
     * {@inheritdoc}
     *
    public function addApi(array $api, $baseUri = null)
    {
        $v = [
            'name' => 'v',
            'type' => 'string',
            'required' => false,
            'defaultValue' => '',
            'paramType' => 'query',
            'description' => '',
        ];
        foreach ($api['operations'] as $i => $operation) {
            $api['operations'][$i]['parameters'][] = $v;
        }

        return parent::addApi($api, $baseUri);
    }*/
}
