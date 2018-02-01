<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class TagAssetCommand extends Command
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
            ->setName( 'loco:tag:asset' )
            ->setMethod( 'tagAsset' )
            ->setDescription( 'Tag an asset' )
            ->addOption('name','',InputOption::VALUE_REQUIRED,'Name of new or existing tag',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addArgument('id',InputArgument::REQUIRED,'Asset ID',null)
        ;
    }
    
}
