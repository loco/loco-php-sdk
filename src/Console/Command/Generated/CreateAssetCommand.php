<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class CreateAssetCommand extends Command {
    
    /**
     * Configure loco:create:asset command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:create:asset' )
            ->setMethod( 'createAsset' )
            ->setDescription( 'Add a new translatable asset' )
            ->addOption('name','',InputOption::VALUE_REQUIRED,'Source text or just a name describing what the asset is',null)
            ->addOption('id','',InputOption::VALUE_OPTIONAL,'Optional machine friendly ID if you want something specific','')
            ->addOption('type','',InputOption::VALUE_REQUIRED,'Media type, defaults to plain old text','text')
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
