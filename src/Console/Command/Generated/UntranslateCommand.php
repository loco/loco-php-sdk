<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class UntranslateCommand extends Command
{
    /**
     * Configure loco:untranslate command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:untranslate')
            ->setMethod('untranslate')
            ->setDescription('Erase translation data in a single locale')
            ->addArgument('id', InputArgument::REQUIRED, 'Asset ID', null)
            ->addArgument('locale', InputArgument::REQUIRED, 'Locale short code, or language tag', null)
        ;
        parent::configure();
    }
}
