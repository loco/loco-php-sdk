<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class DeleteAssetCommand extends Command
{
    /**
     * Configure loco:delete:asset command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:delete:asset')
            ->setMethod('deleteAsset')
            ->setDescription('Delete an asset permanently')
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
        ;
    }
}
