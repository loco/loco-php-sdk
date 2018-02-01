<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class UnlinkPluralCommand extends Command
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
            ->setName( 'loco:unlink:plural' )
            ->setMethod( 'unlinkPlural' )
            ->setDescription( 'Unlinks a plural form of an existing asset' )
            ->addArgument('pid',InputArgument::REQUIRED,'ID of asset to unlink',null)
            ->addArgument('id',InputArgument::REQUIRED,'Asset ID',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
