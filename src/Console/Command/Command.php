<?php

namespace Loco\Console\Command;

use GuzzleHttp\Command\Result;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Loco\Console\Application;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
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
     * @param string $method
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
        $verbosity = $output->getVerbosity();

        $config = [];
        if (empty($args['key']) === false) {
            $config['key'] = trim($args['key']);
        } else {
            unset($args['key']);
        }

        // print request/response if -vv or higher
        if (OutputInterface::VERBOSITY_VERBOSE < $verbosity) {
            $stack = HandlerStack::create();

            // inspect request before sending
            $stack->push(
                Middleware::mapRequest(
                    function (RequestInterface $request) use ($output) {
                        $output->writeln(sprintf('Requesting <comment>%s</comment>', $request->getRequestTarget()));
                        $lines = explode("\n", trim($this->requestToString($request)));
                        $output->writeln(' > '.implode("\n > ", $lines));

                        return $request;
                    }
                )
            );

            //inspect response after receiving
            $stack->push(
                Middleware::mapResponse(
                    function (ResponseInterface $response) use ($output) {
                        $output->writeln(sprintf('Responded <comment>%u</comment>', $response->getStatusCode()));
                        $lines = explode("\n", trim($this->responseToString($response)));
                        $output->writeln(' < '.implode("\n < ", $lines));

                        return $response;
                    }
                )
            );

            $config['httpHandlerStack'] = $stack;
        }

        $client = $this->getApplication()->getRestClient($config);

        // noisy output if -v or higher
        $verbosity = $output->getVerbosity();
        if (OutputInterface::VERBOSITY_NORMAL < $verbosity) {
            $output->writeln(sprintf('Calling <comment>%s</comment>', $this->method));
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
            $output->writeln(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            $output->writeln((string)$result);
        }
    }

    /**
     * Reproduce old Request class' __toString behaviour from Guzzle 3. Necessary just for nice console output.
     *
     * @param RequestInterface $request
     *
     * @return string
     */
    protected function requestToString(RequestInterface $request)
    {
        $protocolVersion = $request->getProtocolVersion() ?: '1.1';

        return trim($request->getMethod().' '.$request->getRequestTarget()).' '
            .strtoupper(str_replace('https', 'http', $request->getUri()->getScheme()))
            .'/'.$protocolVersion."\r\n".implode("\r\n", $this->getHeaderLines($request->getHeaders()));
    }

    /**
     * Reproduce old Response class' __toString behaviour from Guzzle 3. Necessary just for nice console output.
     *
     * @param ResponseInterface $response
     *
     * @return string
     */
    protected function responseToString(ResponseInterface $response)
    {
        $message = '';

        $headers = 'HTTP/1.1 '.$response->getStatusCode().' '.$response->getReasonPhrase()."\r\n";
        $lines = $this->getHeaderLines($response->getHeaders());
        if (!empty($lines)) {
            $headers .= implode("\r\n", $lines)."\r\n";
        }

        $message .= $headers."\r\n";

        // Only include the body in the message if the size is < 2MB
        if ($response->getBody()->getSize() < 2097152) {
            $message .= (string)$response->getBody();
        }

        return $message;
    }

    /**
     * Get the the raw message headers as a string
     *
     * @param string[][] $headers
     *
     * @return array
     */
    private function getHeaderLines(array $headers)
    {
        $result = [];
        foreach ($headers as $name => $values) {
            foreach ($values as $value) {
                $result[] = $name.': '.$value;
            }
        }

        return $result;
    }

}
