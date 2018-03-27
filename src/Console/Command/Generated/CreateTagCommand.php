<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class CreateTagCommand extends Command
{
    /**
     * Configure loco:create:tag command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:create:tag')
            ->setMethod('createTag')
            ->setDescription('Create a new tag')
            ->addOption('name', '', InputOption::VALUE_REQUIRED, 'Name of new tag', null)
        ;
        parent::configure();
    }
}
