<?php
namespace Loco\Api\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

/**
 * Pointless responseClass for testing /api/ping.json endpoint.
 */
class PingResponse implements ResponseClassInterface {

    private $ping;

    /**
     * @return PingResponse
     */
    public static function fromCommand( OperationCommand $command ) {
        $data = $command->getResponse()->json();
        $me = new self;
        $me->ping = $data['ping'];
        return $me;
    }
    
    /**
     * @return string
     */
    public function ping(){
        return $this->ping;
    }

}