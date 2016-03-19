<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ImportCommand extends Command {
    
    /**
     * Configure loco:import command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:import' )
            ->setMethod( 'import' )
            ->setDescription( 'Import assets and translations from a language pack file' )
            ->addArgument('ext',InputArgument::OPTIONAL,'Import file type specified as a file extension','json')
            ->addOption('src','',InputOption::VALUE_REQUIRED,'Raw source of file being imported','{}')
            ->addOption('index','',InputOption::VALUE_REQUIRED,'Specify whether file indexes translations by asset ID or source texts',null)
            ->addOption('locale','',InputOption::VALUE_REQUIRED,'Specify target locale if importing translations',null)
            ->addOption('tag','',InputOption::VALUE_REQUIRED,'Override name of default tag applied to new and modified assets',null)
            ->addOption('async','',InputOption::VALUE_REQUIRED,'Specify that import should be done asynchronously',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
