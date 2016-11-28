<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class CreateLocaleCommand extends Command
{
    /**
     * Configure loco:create:locale command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:create:locale')
            ->setMethod('createLocale')
            ->setDescription('Add a new project locale')
            ->addOption('code', '', InputOption::VALUE_REQUIRED, 'Short code of locale to create, e.g. \'fr\' or \'fr_FR\'', null)
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
        ;
    }
}
