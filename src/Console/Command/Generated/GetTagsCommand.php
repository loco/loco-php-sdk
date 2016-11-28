<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class GetTagsCommand extends Command
{
    /**
     * Configure loco:get:tags command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:get:tags')
            ->setMethod('getTags')
            ->setDescription('Get project tags')
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
        ;
    }
}
