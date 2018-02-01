<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class GetAssetsCommand extends Command
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
            ->setName( 'loco:get:assets' )
            ->setMethod( 'getAssets' )
            ->setDescription( 'List all translatable assets in your project' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addOption('filter','',InputOption::VALUE_REQUIRED,'Comma-separated list of tags to filter assets. Negate tag names by prefixing with \'!\'.',null)
        ;
    }
    
}
