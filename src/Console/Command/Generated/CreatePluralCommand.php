<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class CreatePluralCommand extends Command {
    
    /**
     * Configure loco:create:plural command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:create:plural' )
            ->setMethod( 'createPlural' )
            ->setDescription( 'Add a new plural form of an existing asset' )
            ->addOption('name','',InputOption::VALUE_REQUIRED,'Source text for the plural form or just a name describing it',null)
            ->addOption('pid','',InputOption::VALUE_OPTIONAL,'Optional machine friendly ID if you want something specific, or converting an existing asset to a plural','')
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addArgument('id',InputArgument::REQUIRED,'Asset ID',null)
        ;
    }
    
}
