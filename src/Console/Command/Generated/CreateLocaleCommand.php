<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class CreateLocaleCommand extends Command
{
    /**
     * Configure loco:create:locale command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:create:locale')
            ->setMethod('createLocale')
            ->setDescription('Add a new project locale')
            ->addOption('code', '', InputOption::VALUE_REQUIRED, 'Short code, or language tag for new locale', null)
        ;
        parent::configure();
    }
}
