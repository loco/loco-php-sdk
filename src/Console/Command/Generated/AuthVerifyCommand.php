<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class AuthVerifyCommand extends Command
{
    /**
     * Configure loco:auth:verify command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:auth:verify')
            ->setMethod('authVerify')
            ->setDescription('Verify an API project key')
        ;
        parent::configure();
    }
}
