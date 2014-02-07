<?php
namespace Loco\Swagger\Response;

use Guzzle\Service\Command\OperationCommand;


/**
 * Response class for Swagger API declaration
 */
class ApiDeclaration extends BaseResponse {


    /**
     * @internal Create a response model object from a completed command
     * @param OperationCommand Command that serialized the request
     * @throws \Guzzle\Http\Exception\BadResponseException 
     * @return ApiDeclaration
     */
    public static function fromCommand( OperationCommand $command ) {
        return new ApiDeclaration( $command->getResponse() );
    }
    
    
    /**
     * Get resourcePath sepcified outside of api operations
     * @return string
     */
    public function getResourcePath(){
        return $this->get('resourcePath')?:'';
    }
    
}