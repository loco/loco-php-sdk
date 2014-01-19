<?php
namespace Loco\Http\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Http\Message\Response;


/**
 * responseClass for /api/convert/*
 */
class ConvertResponse implements ResponseClassInterface {

    private $source;

    /**
     * @return ConvertResponse
     */
    public static function fromCommand( OperationCommand $command ) {
        $response = $command->getResponse();
        /* @var $response Response */
        if( 204 === $response->getStatusCode() ){
            throw new \Exception('No messages extracted from '.$command->get('from').' source');
        }
        $me = new self;
        $me->source = $response->getBody()->__toString();
        return $me;
    }
    
    /**
     * @return string
     */
    public function __toString(){
        return $this->source;
    }

}