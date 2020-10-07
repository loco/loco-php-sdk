<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class GetRevisionsCommand extends Command
{
    /**
     * Configure loco:get:revisions command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:revisions')
            ->setMethod('getRevisions')
            ->setDescription('Get previous revisions of a translation')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
            ->addArgument('locale', InputArgument::REQUIRED, 'Locale short code, or language tag', null)
        ;
        parent::configure();
    }
}
