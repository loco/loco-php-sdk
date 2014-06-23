<?php

namespace Loco\Console\Command\Base;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Loco\Http\ApiClient;


/**
 * Auto-generated Loco API console command
 */
abstract class TemplateCommand extends BaseApiCommand {
    
    /**
     * Configure %name% command
     * @internal
     */
    protected function configure(){
        $this
            ->setName( '%name%' )
            ->setDescription( 'template:description' )
            /* %options% */
        ;
    }



    /**
     * Execute %name%
     * @return \Guzzle\Service\Resource\Model
     */
    protected function execute( InputInterface $input, OutputInterface $output ){
        $client = $this->getApplication()->getRestClient( $input->getOption('key') );
        $model = $client->callTemplate();
        return $model;        
    }    
    
    
}