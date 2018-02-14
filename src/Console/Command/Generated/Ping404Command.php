<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;

/**
 * Auto-generated Loco API console command.
 */
class Ping404Command extends Command
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
            ->setName( 'loco:ping404' )
            ->setMethod( 'ping404' )
            ->setDescription( 'Get a test 404 response' )
        ;
    }
    
}
