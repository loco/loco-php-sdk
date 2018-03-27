<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class GetTranslationsCommand extends Command
{
    /**
     * Configure loco:get:translations command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:translations')
            ->setMethod('getTranslations')
            ->setDescription('Get all translations of an asset')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
        ;
        parent::configure();
    }
}
