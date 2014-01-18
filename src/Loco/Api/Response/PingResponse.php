<?php
namespace Loco\Api\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

class PingResponse implements ResponseClassInterface {

    public static function fromCommand( OperationCommand $command ) {
        $response = $command->getResponse();
        return new self;
    }

}