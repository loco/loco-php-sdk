<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class GetAssetsCommand extends Command
{
    /**
     * Configure loco:get:assets command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:assets')
            ->setMethod('getAssets')
            ->setDescription('List all translatable assets in your project')
            ->addOption('filter', '', InputOption::VALUE_REQUIRED, 'Filter assets by comma-separated tag names. Match any tag with `*` and negate tags by prefixing with `!`', null)
        ;
        parent::configure();
    }
}
