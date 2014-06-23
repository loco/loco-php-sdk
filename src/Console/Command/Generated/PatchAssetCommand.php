<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class PatchAssetCommand extends Command {
    
    /**
     * Configure loco:patch:asset command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:patch:asset' )
            ->setMethod( 'patchAsset' )
            ->setDescription( 'Modify a single asset' )
            ->addOption('id_json','',InputOption::VALUE_OPTIONAL,'Machine friendly name',null)
            ->addOption('type','',InputOption::VALUE_OPTIONAL,'Broad content type, defaults to plain text',null)
            ->addOption('name','',InputOption::VALUE_OPTIONAL,'Human friendly name',null)
            ->addOption('context','',InputOption::VALUE_OPTIONAL,'Optional context descriptor',null)
            ->addOption('notes','',InputOption::VALUE_OPTIONAL,'Optional notes for translators',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addArgument('id',InputArgument::REQUIRED,'Asset ID',null)
        ;
    }
    
}
