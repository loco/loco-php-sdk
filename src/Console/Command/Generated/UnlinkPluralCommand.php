<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class UnlinkPluralCommand extends Command {
    
    /**
     * Configure loco:unlink:plural command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:unlink:plural' )
            ->setMethod( 'unlinkPlural' )
            ->setDescription( 'Unlinks a plural form of an existing asset' )
            ->addArgument('pid',InputArgument::REQUIRED,'ID of asset to unlink',null)
            ->addArgument('id',InputArgument::REQUIRED,'Asset ID',null)
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
        ;
    }
    
}
