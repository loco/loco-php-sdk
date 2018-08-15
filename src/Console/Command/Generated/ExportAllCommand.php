<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ExportAllCommand extends Command
{
    /**
     * Configure loco:export:all command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:export:all')
            ->setMethod('exportAll')
            ->setDescription('Export your whole project to a multi-locale language pack')
            ->addArgument('ext', InputArgument::OPTIONAL, 'Target file type specified as a file extension', 'json')
            ->addOption('filter', '', InputOption::VALUE_REQUIRED, 'Filter assets by comma-separated tag names. Match any tag with `*` and negate tags by prefixing with `!`', null)
            ->addOption('index', '', InputOption::VALUE_REQUIRED, 'Override default lookup key for the file format: "id", "text" or a custom alias', null)
            ->addOption('source', '', InputOption::VALUE_REQUIRED, 'Specify alternative source locale instead of project default', null)
            ->addOption('fallback', '', InputOption::VALUE_REQUIRED, 'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`', null)
            ->addOption('order', '', InputOption::VALUE_REQUIRED, 'Export translations according to asset order', null)
            ->addOption('printf', '', InputOption::VALUE_REQUIRED, 'Force alternative "printf" style. <a href="https://localise.biz/help/developers/printf">See string formatting</a>', null)
        ;
        parent::configure();
    }
}
