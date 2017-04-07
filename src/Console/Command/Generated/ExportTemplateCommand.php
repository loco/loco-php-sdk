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
            ->addOption('format','',InputOption::VALUE_REQUIRED,'Specific format, applicable to some file types only',null)
            ->addOption('filter','',InputOption::VALUE_REQUIRED,'Comma-separated list of tags to filter subset of assets.',null)
            ->addOption('index','',InputOption::VALUE_REQUIRED,'Override default lookup key in language pack. Leave blank for auto.',null)
            ->addOption('namespace','',InputOption::VALUE_REQUIRED,'Override the project name for some language packs that use it as a key prefix',null)
            ->addOption('fallback','',InputOption::VALUE_REQUIRED,'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`',null)
            ->addOption('order','',InputOption::VALUE_REQUIRED,'Export translations according to asset order',null)
            ->addOption('status','',InputOption::VALUE_REQUIRED,'Export only translations with a specific status or flag',null)
            ->addOption('printf','',InputOption::VALUE_REQUIRED,'Force alternative "printf" style. <a href="/help/developers/printf">See string formatting</a>',null)
            ->addArgument('ext',InputArgument::OPTIONAL,'Target file type specified as a file extension','json')
        ;
    }
    
}
