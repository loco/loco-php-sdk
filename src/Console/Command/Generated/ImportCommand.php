<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ImportCommand extends Command
{
    /**
     * Configure loco:import command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:import')
            ->setMethod('import')
            ->setDescription('Import assets and translations from a language pack file')
            ->addArgument('ext', InputArgument::REQUIRED, 'File extension for the type of file data you\'re importing', null)
            ->addOption('data', '', InputOption::VALUE_REQUIRED, 'Raw source of file being imported', '{}')
            ->addOption('index', '', InputOption::VALUE_REQUIRED, 'Specify whether translations in your file are indexed by generic IDs or human-readable source text', null)
            ->addOption('locale', '', InputOption::VALUE_REQUIRED, 'Specify target locale if importing translations', null)
            ->addOption('format', '', InputOption::VALUE_REQUIRED, 'Hint for generic file types (like JSON) that don\'t declare their schema. Reciprocal to the export parameter of the same name', null)
            ->addOption('async', '', InputOption::VALUE_REQUIRED, 'Specify that import should be done asynchronously (recommended for large files)', null)
            ->addOption('path', '', InputOption::VALUE_REQUIRED, 'Specify original file path for source code references (excluding line number)', null)
            ->addOption('ignore-new', '', InputOption::VALUE_REQUIRED, 'Specify that new assets will NOT be added to the project', null)
            ->addOption('ignore-existing', '', InputOption::VALUE_REQUIRED, 'Specify that existing assets encountered in the file will NOT be updated', null)
            ->addOption('ignore-blank', '', InputOption::VALUE_REQUIRED, 'Specify that blank translations should NOT be imported', null)
            ->addOption('tag-new', '', InputOption::VALUE_REQUIRED, 'Tag any NEW assets added during the import with the given tags (comma separated)', null)
            ->addOption('tag-all', '', InputOption::VALUE_REQUIRED, 'Tag ALL assets in the file with the given tags (comma separated)', null)
            ->addOption('untag-all', '', InputOption::VALUE_REQUIRED, 'Remove existing tags from any assets matched in the imported file (comma separated)', null)
            ->addOption('tag-updated', '', InputOption::VALUE_REQUIRED, 'Tag existing assets that are MODIFIED by this import', null)
            ->addOption('untag-updated', '', InputOption::VALUE_REQUIRED, 'Remove existing tags from assets that are MODIFIED during import', null)
            ->addOption('tag-absent', '', InputOption::VALUE_REQUIRED, 'Tag existing assets in the project that are NOT found in the imported file', null)
            ->addOption('untag-absent', '', InputOption::VALUE_REQUIRED, 'Remove existing tags from assets NOT found in the imported file', null)
            ->addOption('delete-absent', '', InputOption::VALUE_REQUIRED, 'Permanently DELETES project assets NOT found in the file (use with extreme caution)', null)
            ->addOption('flag-new', '', InputOption::VALUE_REQUIRED, 'Set this flag on any NEW translations imported into the current locale', null)
            ->addOption('flag-updated', '', InputOption::VALUE_REQUIRED, 'Set this flag on any translations MODIFIED during import to the current locale', null)
        ;
        parent::configure();
    }
}
