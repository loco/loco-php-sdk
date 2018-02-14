<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class CreateTagCommand extends Command
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
            ->setName( 'loco:create:tag' )
            ->setMethod( 'createTag' )
            ->setDescription( 'Create a new tag' )
            ->addOption('name','',InputOption::VALUE_REQUIRED,'Name of new tag',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
