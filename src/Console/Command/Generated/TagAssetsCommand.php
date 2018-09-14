<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class TagAssetsCommand extends Command
{
    /**
     * Configure loco:tag:assets command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:tag:assets')
            ->setMethod('tagAssets')
            ->setDescription('Add multiple assets to an existing tag')
            ->addOption('data', '', InputOption::VALUE_REQUIRED, 'Comma separated list of unique asset IDs', null)
            ->addArgument('tag', InputArgument::REQUIRED, 'Name of a single asset tag.', null)
        ;
        parent::configure();
    }
}
