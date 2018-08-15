<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class FlagTranslationCommand extends Command
{
    /**
     * Configure loco:flag:translation command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:flag:translation')
            ->setMethod('flagTranslation')
            ->setDescription('Flag a translation in a given locale')
            ->addOption('flag', '', InputOption::VALUE_REQUIRED, 'Flag or status to set, e.g. "fuzzy"', 'fuzzy')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
            ->addArgument('locale', InputArgument::REQUIRED, 'Locale short code, or language tag', null)
        ;
        parent::configure();
    }
}
