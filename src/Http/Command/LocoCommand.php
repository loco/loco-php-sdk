<?php

namespace Loco\Http\Command;

use Guzzle\Service\Command\OperationCommand;

/**
 * Override base operation command for Loco API methods
 */
class LocoCommand extends OperationCommand {
    
    
    
    /**
     * Get the overrridden request serializer for handling Loco authentication
     * @override
     * @return RequestSerializerInterface
     */
    public function getRequestSerializer(){
        if( ! $this->requestSerializer ){
            // Use the default request serializer if none was found
            $this->requestSerializer = LocoRequestSerializer::getInstance();
        }
        return $this->requestSerializer;
    }

    
}