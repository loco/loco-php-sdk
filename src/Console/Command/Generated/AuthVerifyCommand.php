<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class AuthVerifyCommand extends Command
{
    /**
     * Configure loco:auth:verify command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:auth:verify')
            ->setMethod('authVerify')
            ->setDescription('Verify an API project key')
            ->addOption('key', 'k', InputOption::VALUE_OPTIONAL, 'Override configured API key for this request', '')
        ;
    }
}
