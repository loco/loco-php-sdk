<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class PatchLocaleCommand extends Command
{
    /**
     * Configure loco:patch:locale command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:patch:locale')
            ->setMethod('patchLocale')
            ->setDescription('Modify a project locale')
            ->addOption('code', '', InputOption::VALUE_REQUIRED, 'Locale short code', null)
            ->addOption('name', '', InputOption::VALUE_REQUIRED, 'Friendly display name', null)
            ->addArgument('locale', InputArgument::REQUIRED, 'Locale short code, or language tag', null)
        ;
        parent::configure();
    }
}
