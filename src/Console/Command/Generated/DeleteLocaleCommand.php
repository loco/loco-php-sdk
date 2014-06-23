<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class DeleteLocaleCommand extends Command {
    
    /**
     * Configure loco:delete:locale command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:delete:locale' )
            ->setMethod( 'deleteLocale' )
            ->setDescription( 'Delete a project locale' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addArgument('locale',InputArgument::REQUIRED,'Short code of project locale, e.g. \'fr\' or \'fr_CH\'',null)
        ;
    }
    
}
