<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ExportAllCommand extends Command {
    
    /**
     * Configure loco:export:all command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:export:all' )
            ->setMethod( 'exportAll' )
            ->setDescription( 'Export your whole project to a multi-locale language pack' )
            ->addArgument('ext',InputArgument::OPTIONAL,'Target file type specified as a file extension','yml')
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addOption('filter','',InputOption::VALUE_OPTIONAL,'Comma-separated list of tags to filter subset of assets.',null)
            ->addOption('index','',InputOption::VALUE_OPTIONAL,'Override default lookup key in language pack. Leave blank for auto.',null)
        ;
    }
    
}
