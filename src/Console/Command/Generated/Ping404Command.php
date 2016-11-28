<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;

/**
 * Auto-generated Loco API console command.
 */
class Ping404Command extends Command
{
    /**
     * Configure loco:ping404 command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:ping404')
            ->setMethod('ping404')
            ->setDescription('Get a test 404 response')
            /* %options% */
        ;
    }
}
