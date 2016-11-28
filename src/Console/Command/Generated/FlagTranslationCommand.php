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
     * Configure loco:flag:translation command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:flag:translation')
            ->setMethod('flagTranslation')
            ->setDescription('Flag a translation as incomplete')
            ->addOption('flag', '', InputOption::VALUE_REQUIRED, 'Flag to set', 'fuzzy')
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
            ->addArgument('locale', InputArgument::REQUIRED, 'Short code of project locale, e.g. `fr` or `fr_CH`', null)
        ;
    }
}
