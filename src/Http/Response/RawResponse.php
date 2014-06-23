<?php
namespace Loco\Http\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Message\Response;


/**
 * Response class for endpoints that return raw, unstructured data that will not be unserialized.
 */
class RawResponse implements ResponseClassInterface {

    private $source;

    /**
     * Create a response model object from a completed command
     * @param OperationCommand Command that serialized the request
     * @throws BadResponseException 
     * @return RawResponse
     */
    public static function fromCommand( OperationCommand $command ) {
        $response = $command->getResponse();
        if( 204 === $response->getStatusCode() ){
            throw new \Exception('Response contains no data');
        }
        $me = new self;
        return $me->init( $response );
    }
    
    
    /**
     * Initialize from http response
     * @internal
     * @return RawResponse
     */
    protected function init( Response $response ){
        $this->source = $response->getBody()->__toString();
        return $this;
    }  
    
    
    /**
     * Get raw data.
     * @return string
     */
    public function __toString(){
        return $this->source;
    }

}