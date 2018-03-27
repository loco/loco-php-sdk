<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class GetLocalesCommand extends Command
{
    /**
     * Configure loco:get:locales command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:locales')
            ->setMethod('getLocales')
            ->setDescription('List all locales in your project')
        ;
        parent::configure();
    }
}
