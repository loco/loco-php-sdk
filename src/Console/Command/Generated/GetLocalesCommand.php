<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class GetLocalesCommand extends Command
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
            ->setName( 'loco:get:locales' )
            ->setMethod( 'getLocales' )
            ->setDescription( 'List all locales in your project' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
