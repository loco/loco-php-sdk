<?php

namespace Loco\Console\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Guzzle\Common\Event;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Message\EntityEnclosingRequest;
use Guzzle\Service\Resource\Model;
use Guzzle\Service\Description\Parameter;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Service\Command\ResponseClassInterface;

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
     */
    protected function execute( InputInterface $input, OutputInterface $output ){
        $args = $input->getArguments() + $input->getOptions();

        // override API key
        if( isset($args['key']) && ( $apiKey = trim($args['key']) ) ){
            $client = $this->getApplication()->getRestClient( $apiKey );
        }
        // else ensure key is unset so default it used
        else {
            $client = $this->getApplication()->getRestClient();
            unset( $args['key'] );
        }
        // noisy output if -v or higher
        $verbosity = $output->getVerbosity();
        if( OutputInterface::VERBOSITY_NORMAL < $verbosity ){
            $output->writeln( sprintf('Calling <comment>%s</comment>', $this->method) );
            // print request/response if -vv or higher
            if( OutputInterface::VERBOSITY_VERBOSE < $verbosity ){
                // inspect request before sending
                $dispatcher = $client->getEventDispatcher();
                $dispatcher->addListener('request.before_send', function( Event $e )use( $output ){
                    $request = $e['request'];
                    /* @var $request EntityEnclosingRequest */
                    $output->writeln( sprintf('Requesting <comment>%s</comment>', $request->getPath() ) );
                    $lines = explode( "\n", trim( $request->__toString() ) );
                    echo ' > ',implode("\n > ", $lines ),"\n";
                } );
                // inspect response after receiving
                $dispatcher->addListener('request.sent', function( Event $e )use( $output ){
                    $response = $e['response'];
                    /* @var $response Response */
                    $output->writeln( sprintf('Responded <comment>%u</comment>', $response->getStatusCode() ) );
                    $lines = explode( "\n", trim( $response->__toString() ) );
                    echo ' < ',implode("\n < ", $lines ),"\n";
                } );
            }
        }        
        // call overloaded function and show body on error
        try {
            $result = $client->__call( $this->method, array( $args ) );
            // print result unless -q
            if( OutputInterface::VERBOSITY_QUIET < $output->getVerbosity() ){
                $this->showResult( $result, $output );
            }
        }
        catch( BadResponseException $e ){
            $output->writeln('<comment>Bad response:</comment>');
            $output->writeln( (string) $e->getResponse()->getBody() );
            throw $e;
        }
    }



    /**
     * Overridable default shows result on successful api call
     * @param Guzzle\Service\Resource\Model | array
     * @return void
     */    
    protected function showResult( $result, OutputInterface $output ){
        if( OutputInterface::VERBOSITY_NORMAL < $output->getVerbosity() ){
            $output->writeln('<info>'.$this->getName().' OK</info>');
        }
        if( $result instanceof Model ){
            $result = $result->toArray();
        }
        if( is_array($result) ){
            if( defined('JSON_PRETTY_PRINT') ){
                echo json_encode( $result, JSON_PRETTY_PRINT ),"\n";
            }
            else {
                print_r( $result );
            }
        }
        else {
            echo $result;
        }
    }

}
