<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class PatchTagCommand extends Command
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
            ->setName( 'loco:patch:tag' )
            ->setMethod( 'patchTag' )
            ->setDescription( 'Modify a single tag' )
            ->addOption('name','',InputOption::VALUE_REQUIRED,'Display name of tag',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addArgument('tag',InputArgument::REQUIRED,'Name of a single asset tag.',null)
        ;
    }
    
}
