<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class {{TemplateCommand}} extends Command
{
    /**
     * Configure {{name}} command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('{{name}}')
            ->setMethod('{{method}}')
            ->setDescription('{{description}}'){{options}}
        ;
        parent::configure();
    }
}
