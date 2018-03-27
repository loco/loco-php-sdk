<?php

namespace Loco\Tests\Http\Model;

use GuzzleHttp\Command\ToArrayInterface;
use GuzzleHttp\Command\Guzzle\Parameter;

/**
 * Base model for faking request and response models
 */
abstract class MockModel implements ToArrayInterface
{
    private $mock = [];

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->mock;
    }


    /**
     * @return void
     */
    protected function build(array $children)
    {
        $this->mock = $this->crawl($children);
    }


    /**
     * Converts a model schema to a dummy structure
     * @return array
     */
    private function crawl(array $children)
    {
        $struct = [];
        /* @var $p Parameter */
        foreach ($children as $key => $p) {
            $struct[$key] = $this->cast($p);
        }
        return $struct;
    }


    /**
     * @return mixed
     */
    private function cast(Parameter $p)
    {
        // use default if there is one
        $value = $p->getDefault();
        if (is_null($value)) {
            $type = $p->getType();
            // pluck from enum if given the choice
            if ($choices = $p->getEnum()) {
                // enum allowed for scalars and arrays
                if ('array' === $type) {
                    $value = $choices;
                } else {
                    $value = $choices[0];
                }
            }
            // create dummy value according to type (recursing for objects)
            else {
                if ('string' === $type) {
                    if ('date-time' === $p->getFormat()) {
                        $value = date('Y-m-d\\TH:i:sO');
                    } else {
                        $value = 'foo';
                    }
                } elseif ('integer' === $type) {
                    $value = $p->getMinimum() ?: 0;
                } elseif ('boolean' === $type) {
                    $value = false;
                } elseif ('array' === $type) {
                    $value = [];
                    if ($items = $p->getItems()) {
                        $value[] = $this->cast($items);
                    }
                    /*if( $items && ( $subtype = $items->getType() ) ){
                        $value[] = $this->cast( new Parameter( [
                            'type' => $subtype,
                        ] ) );
                    }*/
                } elseif ('object' === $type) {
                    $value = $this->crawl($p->getProperties());
                } else {
                    throw new \Exception(sprintf('Cannot cast parameter of type "%s"', $type));
                }
            }
        }
        return $value;
    }
}
