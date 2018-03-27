<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ImportProgressCommand extends Command
{
    /**
     * Configure loco:import:progress command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:import:progress')
            ->setMethod('importProgress')
            ->setDescription('Check the progress of an asynchronous import')
            ->addArgument('id', InputArgument::REQUIRED, 'Job identifier from original import action', null)
        ;
        parent::configure();
    }
}
