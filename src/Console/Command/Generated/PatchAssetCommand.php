<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class PatchAssetCommand extends Command
{
    /**
     * Configure loco:patch:asset command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:patch:asset')
            ->setMethod('patchAsset')
            ->setDescription('Modify a single asset')
            ->addOption('id_json', '', InputOption::VALUE_REQUIRED, 'Unique asset identifier', null)
            ->addOption('type', '', InputOption::VALUE_REQUIRED, 'Broad content type to set', null)
            ->addOption('context', '', InputOption::VALUE_REQUIRED, 'Optional context descriptor', null)
            ->addOption('notes', '', InputOption::VALUE_REQUIRED, 'Optional notes for translators', null)
            ->addOption('aliases', '', InputOption::VALUE_REQUIRED, 'Generic object', null)
            ->addOption('name', '', InputOption::VALUE_REQUIRED, 'DEPRECATED: patch `aliases.name` instead', null)
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
        ;
        parent::configure();
    }
}
