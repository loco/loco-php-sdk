<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class CreateAssetCommand extends Command
{
    /**
     * Configure loco:create:asset command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:create:asset')
            ->setMethod('createAsset')
            ->setDescription('Add a new translatable asset')
            ->addOption('id', '', InputOption::VALUE_REQUIRED, 'Unique asset ID up to 999 bytes (leave blank to auto-generate)', null)
            ->addOption('text', '', InputOption::VALUE_REQUIRED, 'Initial source language translation (required if <code>{id}</code> is empty)', null)
            ->addOption('type', '', InputOption::VALUE_REQUIRED, 'Content type for all translations of the new asset', 'text')
            ->addOption('context', '', InputOption::VALUE_REQUIRED, 'Optional context descriptor', null)
            ->addOption('notes', '', InputOption::VALUE_REQUIRED, 'Optional notes for translators', null)
            ->addOption('default', '', InputOption::VALUE_REQUIRED, 'Status of the source language translation specified in <code>{text}</code>', 'translated')
        ;
        parent::configure();
    }
}
