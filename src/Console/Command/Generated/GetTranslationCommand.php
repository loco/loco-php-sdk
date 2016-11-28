<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class GetTranslationCommand extends Command
{
    /**
     * Configure loco:get:translation command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:translation')
            ->setMethod('getTranslation')
            ->setDescription('Get a single translation')
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
            ->addArgument('locale', InputArgument::REQUIRED, 'Short code of project locale, e.g. `fr` or `fr_CH`', null)
        ;
    }
}
