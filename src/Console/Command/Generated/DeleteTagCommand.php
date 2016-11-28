<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class DeleteTagCommand extends Command
{
    /**
     * Configure loco:delete:tag command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:delete:tag')
            ->setMethod('deleteTag')
            ->setDescription('Delete an existing tag')
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
            ->addArgument('tag', InputArgument::REQUIRED, 'Name of a single asset tag.', null)
        ;
    }
}
