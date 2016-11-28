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
     * Configure loco:get:translations command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:translations')
            ->setMethod('getTranslations')
            ->setDescription('Get all translations of an asset')
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
        ;
    }
}
