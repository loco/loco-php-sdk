<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ExportTemplateCommand extends Command {
    
    /**
     * Configure loco:export:template command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:export:template' )
            ->setMethod( 'exportTemplate' )
            ->setDescription( 'Export a template containing only source keys' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addOption('format','',InputOption::VALUE_OPTIONAL,'Specific format, applicable to some file types only',null)
            ->addOption('filter','',InputOption::VALUE_OPTIONAL,'Comma-separated list of tags to filter subset of assets.',null)
            ->addOption('index','',InputOption::VALUE_OPTIONAL,'Override default lookup key in language pack. Leave blank for auto.',null)
            ->addArgument('ext',InputArgument::OPTIONAL,'Target file type specified as a file extension','json')
        ;
    }
    
}
