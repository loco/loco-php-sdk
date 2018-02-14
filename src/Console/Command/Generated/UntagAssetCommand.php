<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class UntagAssetCommand extends Command
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
            ->setName( 'loco:untag:asset' )
            ->setMethod( 'untagAsset' )
            ->setDescription( 'Untag an asset' )
            ->addArgument('tag',InputArgument::REQUIRED,'Term to remove from asset\'s tags',null)
            ->addArgument('id',InputArgument::REQUIRED,'Asset ID',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
