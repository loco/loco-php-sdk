<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class GetLocaleCommand extends Command
{
    /**
     * Configure loco:get:locale command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:locale')
            ->setMethod('getLocale')
            ->setDescription('Get a project locale')
            ->addArgument('locale', InputArgument::REQUIRED, 'Locale short code, or language tag', null)
        ;
        parent::configure();
    }
}
