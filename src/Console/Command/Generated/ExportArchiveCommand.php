<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ExportArchiveCommand extends Command {
    
    /**
     * Configure loco:export:archive command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:export:archive' )
            ->setMethod( 'exportArchive' )
            ->setDescription( 'Export all locales to a zip archive' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addOption('format','',InputOption::VALUE_REQUIRED,'Specific format, applicable to some file types only',null)
            ->addOption('filter','',InputOption::VALUE_REQUIRED,'Comma-separated list of tags to filter assets. Negate tag names by prefixing with \'!\'.',null)
            ->addOption('index','',InputOption::VALUE_REQUIRED,'Override default lookup key in language pack. Leave blank for auto.',null)
            ->addOption('namespace','',InputOption::VALUE_REQUIRED,'Override the project name for some language packs that use it as a key prefix',null)
            ->addOption('fallback','',InputOption::VALUE_REQUIRED,'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`',null)
            ->addOption('order','',InputOption::VALUE_REQUIRED,'Export translations according to asset order',null)
            ->addOption('status','',InputOption::VALUE_REQUIRED,'Export only translations with a specific status or flag',null)
            ->addOption('path','',InputOption::VALUE_REQUIRED,'Custom pattern for file paths. <a href="/help/developers/locales/export-paths">See syntax</a>',null)
            ->addOption('printf','',InputOption::VALUE_REQUIRED,'Force alternative "printf" style. <a href="/help/developers/printf">See string formatting</a>',null)
            ->addArgument('ext',InputArgument::OPTIONAL,'Target file type specified as a file extension','json')
        ;
    }
    
}
