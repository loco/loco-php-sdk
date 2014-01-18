<?php
namespace Loco\Api\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

/**
 * responseClass for /api/convert/*
 */
class ConvertResponse implements ResponseClassInterface {

    private $source;

    /**
     * @return ConvertResponse
     */
    public static function fromCommand( OperationCommand $command ) {
        $me = new self;
        $me->source = $command->getResponse()->getBody()->__toString();
        return $me;
    }
    
    /**
     * @return string
     */
    public function __toString(){
        return $this->source;
    }

}