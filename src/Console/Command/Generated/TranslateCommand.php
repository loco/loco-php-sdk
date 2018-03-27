<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class TranslateCommand extends Command
{
    /**
     * Configure loco:translate command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:translate')
            ->setMethod('translate')
            ->setDescription('Add a new translation in a given locale')
            ->addOption('translation', '', InputOption::VALUE_REQUIRED, 'Raw value of new translation. Leaving empty puts a blank translation.', null)
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
            ->addArgument('locale', InputArgument::REQUIRED, 'Locale short code, or language tag', null)
        ;
        parent::configure();
    }
}
