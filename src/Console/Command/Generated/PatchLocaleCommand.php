<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class PatchLocaleCommand extends Command
{
    /**
     * Configure %name% command
     *
     * @internal
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName( 'loco:patch:locale' )
            ->setMethod( 'patchLocale' )
            ->setDescription( 'Modify a project locale' )
            ->addOption('code','',InputOption::VALUE_REQUIRED,'Locale short code',null)
            ->addOption('name','',InputOption::VALUE_REQUIRED,'Friendly display name',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addArgument('locale',InputArgument::REQUIRED,'Short code of project locale, e.g. `fr` or `fr_CH`',null)
        ;
    }
    
}
