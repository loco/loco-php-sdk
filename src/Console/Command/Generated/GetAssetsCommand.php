<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class GetAssetsCommand extends Command {
    
    /**
     * Configure loco:get:assets command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:get:assets' )
            ->setMethod( 'getAssets' )
            ->setDescription( 'List all translatable assets in your project' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addOption('filter','',InputOption::VALUE_OPTIONAL,'Comma-separated list of tags to filter subset of assets.',null)
        ;
    }
    
}
