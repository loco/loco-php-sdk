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
            ->addOption('ignore-new','',InputOption::VALUE_REQUIRED,'Specify that new assets are NOT added to the project',null)
            ->addOption('ignore-existing','',InputOption::VALUE_REQUIRED,'Specify that existing assets encountered in the file are NOT updated',null)
            ->addOption('delete-absent','',InputOption::VALUE_REQUIRED,'Specify that project assets not found in the file are DELETED from the project',null)
            ->addOption('tag-new','',InputOption::VALUE_REQUIRED,'Tag any NEW assets with a new or existing tag',null)
            ->addOption('tag-updated','',InputOption::VALUE_REQUIRED,'Tag any MODIFIED assets with a new or existing tag',null)
            ->addOption('untag-updated','',InputOption::VALUE_REQUIRED,'Remove existing tag from any assets modified during import',null)
            ->addOption('tag-absent','',InputOption::VALUE_REQUIRED,'Tag any assets in the project that are not found in this file',null)
            ->addOption('untag-absent','',InputOption::VALUE_REQUIRED,'Remove existing tag from any existing assets NOT found in the file',null)
            ->addOption('async','',InputOption::VALUE_REQUIRED,'Specify that import should be done asynchronously',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
