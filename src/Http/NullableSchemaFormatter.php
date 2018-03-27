<?php

namespace Loco\Http;

use GuzzleHttp\Command\Guzzle\SchemaFormatter;

class NullableSchemaFormatter extends SchemaFormatter
{

    /**
     * Don't try to format null value. Pass all other values to default Guzzle's formatter.
     */
    public function format($format, $value)
    {
        if ($value !== null) {
            return parent::format($format, $value);
        }

        return null;
    }
}
