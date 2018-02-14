<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class ImportProgressCommand extends Command
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
            ->setName( 'loco:import:progress' )
            ->setMethod( 'importProgress' )
            ->setDescription( 'Check the progress of an asynchronous import' )
            ->addArgument('id',InputArgument::REQUIRED,'Job identifier from original import action',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
