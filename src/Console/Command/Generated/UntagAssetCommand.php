<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class UntagAssetCommand extends Command
{
    /**
     * Configure loco:untag:asset command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:untag:asset')
            ->setMethod('untagAsset')
            ->setDescription('Untag an asset')
            ->addArgument('tag', InputArgument::REQUIRED, 'Term to remove from asset\'s tags', null)
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
        ;
        parent::configure();
    }
}
