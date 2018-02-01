<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Auto-generated Loco API console command.
 */
class CreateAssetCommand extends Command
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
            ->setName( 'loco:create:asset' )
            ->setMethod( 'createAsset' )
            ->setDescription( 'Add a new translatable asset' )
            ->addOption('name','',InputOption::VALUE_REQUIRED,'Source text or just a name describing what the asset is',null)
            ->addOption('id','',InputOption::VALUE_REQUIRED,'Optional machine friendly ID if you want something specific','')
            ->addOption('type','',InputOption::VALUE_REQUIRED,'Media type, defaults to plain "text"','text')
            ->addOption('context','',InputOption::VALUE_REQUIRED,'Optional context descriptor',null)
            ->addOption('notes','',InputOption::VALUE_REQUIRED,'Optional notes for translators',null)
            ->addOption('default','',InputOption::VALUE_REQUIRED,'Status of the default source language translation. Specify \'untranslated\' to avoid creation','translated')
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
