<?php

namespace Loco\Console\Command\Base;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;


/**
 * Loco CLI base command to be extended by all commands analogous to a REST API endpoint
 */
abstract class BaseApiCommand extends Command {
    
    
    public function __construct( $name = null ){
        parent::__construct( $name );
        
        // default options for all api commands
        $this->addOption( 
            'key', 'k', 
            InputOption::VALUE_OPTIONAL,
            'Use this API key to use, if not already configured via some other means',
            null
        );
    }
    
    
}