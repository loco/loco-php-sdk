<?php

namespace Loco\Console\Command;

use GuzzleHttp\Command\Result;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Middleware;
use Loco\Console\Application;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Base command for all loco API calls
 *
 * @method Application getApplication()
 */
abstract class Command extends BaseCommand
{

    /**
     * @var string
     */
    private $method;

    /**
     * Set the callable name of the magic service method
     *
     * @return Command
     */
    protected function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Execute call to endpoint
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\BadResponseException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $args = $input->getArguments() + $input->getOptions();

        $client = $this->getApplication()->getRestClient();
        $config = $client->getConfig();
        if (empty($args['key']) === false) {
            $config['key'] = $args['key'];
            $client = $this->getApplication()->getRestClient($config);
        }


        // override API key
        if (isset($args['key']) && ($apiKey = trim($args['key']))) {
            $client = $this->getApplication()->getRestClient($apiKey);
        } // else ensure key is unset so default it used
        else {
            $client = $this->getApplication()->getRestClient();
            unset($args['key']);
        }
        // noisy output if -v or higher
        $verbosity = $output->getVerbosity();
        if (OutputInterface::VERBOSITY_NORMAL < $verbosity) {
            $output->writeln(sprintf('Calling <comment>%s</comment>', $this->method));
            // print request/response if -vv or higher
            if (OutputInterface::VERBOSITY_VERBOSE < $verbosity) {

                // inspect request before sending
                $client->getHandlerStack()->push(
                    Middleware::mapRequest(
                        function (RequestInterface $request) use ($output) {
                            $output->writeln(sprintf('Requesting <comment>%s</comment>', $request->getRequestTarget()));
//                            $lines = explode("\n", trim($request->__toString()));
//                            echo ' > ', implode("\n > ", $lines), "\n";
                        }
                    )
                );

//                 inspect response after receiving
                $client->getHandlerStack()->push(
                    Middleware::mapResponse(
                        function (ResponseInterface $response) use ($output) {
                            $output->writeln(sprintf('Responded <comment>%u</comment>', $response->getStatusCode()));
//                            $lines = explode("\n", trim($response->__toString()));
//                            echo ' < ', implode("\n < ", $lines), "\n";
                        }
                    )
                );
            }
        }
        // call overloaded function and show body on error
        try {
            $result = $client->{$this->method}($args);
            // print result unless -q
            if (OutputInterface::VERBOSITY_QUIET < $output->getVerbosity()) {
                $this->showResult($result, $output);
            }
        } catch (BadResponseException $e) {
            $output->writeln('<comment>Bad response:</comment>');
            $output->writeln((string)$e->getResponse()->getBody());
            throw $e;
        }
    }

    /**
     * Overridable default shows result on successful api call
     *
     * @param Result|array $result
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function showResult($result, OutputInterface $output)
    {
        if (OutputInterface::VERBOSITY_NORMAL < $output->getVerbosity()) {
            $output->writeln('<info>'.$this->getName().' OK</info>');
        }
        if ($result instanceof Result) {
            $result = $result->toArray();
        }
        if (is_array($result)) {
            echo json_encode($result, JSON_PRETTY_PRINT), "\n";
        } else {
            echo $result;
        }
    }

}
