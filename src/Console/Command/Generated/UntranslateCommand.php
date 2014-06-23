<?php

namespace Loco\Console\Command\Generated;

use Loco\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Auto-generated Loco API console command.
 */
class UntranslateCommand extends Command {
    
    /**
     * Configure loco:untranslate command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( 'loco:untranslate' )
            ->setMethod( 'untranslate' )
            ->setDescription( 'Untranslate an asset in a single locale' )
            ->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')
            ->addArgument('id',InputArgument::REQUIRED,'Asset ID',null)
            ->addArgument('locale',InputArgument::REQUIRED,'Short code of project locale, e.g. \'fr\' or \'fr_CH\'',null)
        ;
    }
    
}
