<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ExportArchiveCommand extends Command
{
    /**
     * Configure loco:export:archive command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:export:archive')
            ->setMethod('exportArchive')
            ->setDescription('Export all locales to a zip archive')
            ->addArgument('ext', InputArgument::OPTIONAL, 'Target file type specified as a file extension', 'json')
            ->addOption('format', '', InputOption::VALUE_REQUIRED, 'More specific format of file type. e.g. <code>symfony</code> applies to <code>php</code>, <code>xlf</code> &amp; <code>yml</code>', null)
            ->addOption('filter', '', InputOption::VALUE_REQUIRED, 'Filter assets by comma-separated tag names. Match any tag with `*` and negate tags by prefixing with `!`', null)
            ->addOption('index', '', InputOption::VALUE_REQUIRED, 'Override default lookup key for the file format: "id", "text" or a custom alias', null)
            ->addOption('source', '', InputOption::VALUE_REQUIRED, 'Specify alternative source locale instead of project default', null)
            ->addOption('namespace', '', InputOption::VALUE_REQUIRED, 'Override the project name for some language packs that use it as a key prefix', null)
            ->addOption('fallback', '', InputOption::VALUE_REQUIRED, 'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`', null)
            ->addOption('order', '', InputOption::VALUE_REQUIRED, 'Export translations according to asset order', null)
            ->addOption('status', '', InputOption::VALUE_REQUIRED, 'Export translations with a specific status or flag. Negate values by prefixing with `!`. e.g. "translated", or "!fuzzy".', null)
            ->addOption('path', '', InputOption::VALUE_REQUIRED, 'Custom pattern for file paths. <a href="https://localise.biz/help/developers/locales/export-paths">See syntax</a>', null)
            ->addOption('printf', '', InputOption::VALUE_REQUIRED, 'Force alternative "printf" style. <a href="https://localise.biz/help/developers/printf">See string formatting</a>', null)
        ;
        parent::configure();
    }
}
