<?php
namespace Loco\Http\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Http\Message\Response;


/**
 * responseClass for endpoints that return raw, unstructured data that will not be unserialized
 */
class RawResponse implements ResponseClassInterface {

    private $source;

    /**
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
     * @return 
     */
    protected function init( Response $response ){
        $this->source = $response->getBody()->__toString();
        return $this;
    }  
    
    
    /**
     * @return string
     */
    public function __toString(){
        return $this->source;
    }

}