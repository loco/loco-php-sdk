<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ExportLocaleCommand extends Command {
    
    /**
     * Configure loco:export:locale command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:export:locale' )
            ->setMethod( 'exportLocale' )
            ->setDescription( 'Export a single locale to a language pack.' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addOption('format','',InputOption::VALUE_REQUIRED,'Specific format, applicable to some file types only',null)
            ->addOption('filter','',InputOption::VALUE_REQUIRED,'Comma-separated list of tags to filter subset of assets.',null)
            ->addOption('index','',InputOption::VALUE_REQUIRED,'Override default lookup key in language pack. Leave blank for auto.',null)
            ->addOption('fallback','',InputOption::VALUE_REQUIRED,'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`',null)
            ->addArgument('locale',InputArgument::REQUIRED,'Locale to export, specified as short code. e.g. `en` or `en_GB`',null)
            ->addArgument('ext',InputArgument::OPTIONAL,'Target file type specified as a file extension','json')
        ;
    }
    
}
