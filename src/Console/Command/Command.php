<?php

namespace Loco\Console\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Guzzle\Service\Resource\Model;
use Loco\Http\ApiClient;


/**
 * Base command for all loco API calls
 */
abstract class Command extends BaseCommand {
    
    /**
     * @var string
     */    
    private $method;


    /**
     * Set the callable name of the magic service method
     * @return Command
     */
    protected function setMethod( $method ){
        $this->method = $method;
        return $this;
    }



    /**
     * Execute call to endpoint
     * @return Model
     */
    protected function execute( InputInterface $input, OutputInterface $output ){
        $args = $input->getArguments() + $input->getOptions();
        // override key
        if( isset($args['key']) && ( $apiKey = trim($args['key']) ) ){
            $client = $this->getApplication()->getRestClient( $apiKey );
        }
        // else ensure key is unset so default it used
        else {
            $client = $this->getApplication()->getRestClient();
            unset( $args['key'] );
        }
        // call overloaded function dymnamically
        $result = $client->__call( $this->method, array( $args ) );
        $this->showResult( $result, $output );
        return $result;
    }



    /**
     * Overridable default shows result on successful api call
     */    
    protected function showResult( $result, OutputInterface $output ){
        $output->writeln('<info>'.$this->getName().' OK</info>');
        if( $result instanceof Model ){
            if( defined('JSON_PRETTY_PRINT') ){
                echo json_encode( $result->toArray(), JSON_PRETTY_PRINT ),"\n";
            }
            else {
                print_r( $result->toArray() );
            }
        }
        else {
            echo $result;
        }
    }
    
    
}

 