<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class ConvertCommand extends Command
{
    /**
     * Configure loco:convert command.
     *
     * @internal
     */
    protected function configure()
    {
        $this
            ->setName('loco:convert')
            ->setMethod('convert')
            ->setDescription('Convert a language pack to another file format')
            ->addOption('src', '', InputOption::VALUE_REQUIRED, 'Raw source of file being converted', '{"foo":"bar"}')
            ->addArgument('from', InputArgument::OPTIONAL, 'Source file format being imported', 'json')
            ->addArgument('ext', InputArgument::OPTIONAL, 'Target file format being exported, specified as a file extension', 'json')
            ->addArgument('name', InputArgument::OPTIONAL, 'Domain/namespace, applicable to some file formats', 'messages')
            ->addOption('format', '', InputOption::VALUE_REQUIRED, 'Specific target format, required for some file types', null)
            ->addOption('locale', '', InputOption::VALUE_REQUIRED, 'Locale of target language pack, required in most cases', null)
            ->addOption('native', '', InputOption::VALUE_REQUIRED, 'Optional source locale, not required in many cases', null)
            ->addOption('index', '', InputOption::VALUE_REQUIRED, 'Override default lookup key in exported file. Leave blank for auto.', null)
        ;
    }
}
