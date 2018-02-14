<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;

/**
 * Auto-generated Loco API console command.
 */
class PingCommand extends Command
{
    /**
     * Configure %name% command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName( 'loco:ping' )
            ->setMethod( 'ping' )
            ->setDescription( 'Check the API is up' )
        ;
    }
    
}
