<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class CreatePluralCommand extends Command
{
    /**
     * Configure loco:create:plural command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:create:plural')
            ->setMethod('createPlural')
            ->setDescription('Add a new plural form of an existing asset')
            ->addOption('text', '', InputOption::VALUE_REQUIRED, 'Initial source language translation of new asset (ignored when linking existing asset)', null)
            ->addOption('pid', '', InputOption::VALUE_REQUIRED, 'Unique asset ID for new or existing plural form (up to 999 bytes)', null)
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
        ;
        parent::configure();
    }
}
