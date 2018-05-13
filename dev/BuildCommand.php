<?php

namespace Loco\Dev;

use Loco\Http\Command\LocoCommand;
use Loco\Http\Command\StrictCommand;
use Loco\Http\Result\RawResult;
use Loco\Http\Result\ZipResult;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
final class BuildCommand extends Command
{
    /**
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('loco:build')
            ->setDescription('Build Loco API service description and generated commands')
            ->addOption(
                'dev',
                '',
                InputOption::VALUE_NONE,
                'Whether to build local development version for testing'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null
     *
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cwd = \dirname(__DIR__);
        $verbose = $output->getVerbosity() > 1;

        if (! file_exists($configPath = $cwd.'/config.json')) {
            throw new \RuntimeException('config.json not found, do ~$ cp config.json.dist config.json');
        }

        $conf = json_decode(file_get_contents($configPath), true);
        if (! is_array($conf)) {
            throw new \RuntimeException('Malformed config.json, check your JSON syntax');
        }
        if (! isset($conf['base_uri'])) {
            throw new \RuntimeException('Invalid config.json, build operation requires base_uri');
        }
        if (! class_exists('Loco\\Utils\\Swizzle\\Swizzle', true)) {
            $output->writeln("<error>Swizzle not found. Run composer install --dev</error>");
            return 1;
        }

        $builder = new Swizzle('Loco', 'Loco REST API');
        $builder->setDelay(0);
        if ($verbose === true) {
            $builder->verbose(STDERR);
        }

        // Register custom Guzzle response classes
        $builder
            ->registerResponseClass('exportArchive', ZipResult::class)
            ->registerResponseClass('exportTemplate', RawResult::class)
            ->registerResponseClass('exportLocale', RawResult::class)
            ->registerResponseClass('exportAll', RawResult::class)
            ->registerResponseClass('convert', RawResult::class);

        // Enable response validation and locale URL if building for local test
        $base_uri = $conf['base_uri'];
        $domain = parse_url($base_uri, PHP_URL_HOST);

        $base_uri .= '/swagger';
        $output->writeln('<comment>Pulling docs from '.$base_uri.'</comment>');
        $builder->build($base_uri);
        
        // Collect magic methods usable by this client via  GuzzleHttp\Command\ServiceClient::__call()
        $methodTags = [];

        // Write Guzzle service description to locale JSON
        $file = $cwd.'/src/Http/Resources/service.json';
        $byteLength = file_put_contents($file, $builder->toJson());
        if ($verbose === true) {
            $output->writeln(sprintf('Wrote JSON service description to %s (%s bytes)', $file, $byteLength));
        }

        // Service descriptions build for rest client,
        // build console commands from raw service description data
        $output->writeln('<comment>Building Console command classes</comment>');
        $service = $builder->toArray();
        /* @var $service array[][] */
        foreach ($service['operations'] as $functionName => $operation) {
            $commandName = 'loco:'.strtolower(preg_replace('/[A-Z][a-z]/', ':\\0', $functionName));
            $className = ucfirst($functionName).'Command';
            $options = [];
            /* @var $operation array[][] */
            foreach ($operation['parameters'] as $name => $param) {
                // skip common arguments that will be added at runtime to all commands
                if ('key' === $name || 'v' === $name) {
                    continue;
                }
                $description = var_export($param['description'], true);
                $default = isset($param['default']) ? var_export($param['default'], true) : 'null';
                if ('uri' === $param['location']) {
                    $required = 'null' === $default ? 'REQUIRED' : 'OPTIONAL';
                    $options[] = "->addArgument('{$name}', InputArgument::{$required}, {$description}, {$default})";
                } else {
                    $options[] = "->addOption('{$name}', '', InputOption::VALUE_REQUIRED, {$description}, {$default})";
                }
            }
            $optionsStr = empty($options) === false ? "\n            ".implode("\n            ", $options) : '';

            // Write Command base class, containing all api endpoint configuration
            $source = str_replace(
                [ '{{name}}', '{{method}}', '{{TemplateCommand}}', '{{description}}', '{{options}}'],
                [ $commandName, $functionName, $className, $operation['summary'], $optionsStr],
                file_get_contents($cwd.'/src/Console/Command/Resources/TemplateCommand.tpl')
            );
            $file = $cwd.'/src/Console/Command/Generated/'.$className.'.php';
            $byteLength = file_put_contents($file, $source);
            if ($verbose === true) {
                $output->writeln(sprintf('Wrote %s to %s (%s bytes)', $className, $file, $byteLength));
            }
            
            // Write Test case, containing dummy success response and full request
            $source = str_replace(
                [ '{{method}}', '{{TemplateCommand}}', '{{description}}', '{{model}}' ],
                [ $functionName, $className, $operation['summary'], $operation['responseModel'] ],
                file_get_contents($cwd.'/tests/Http/Resources/TemplateTest.tpl')
            );
            $file = $cwd.'/tests/Http/Generated/'.$className.'Test.php';
            $byteLength = file_put_contents($file, $source);
            if ($verbose === true) {
                $output->writeln(sprintf('Wrote %sTest to %s (%s bytes)', $className, $file, $byteLength));
            }
            
            // Collect magic @method definition for PHPDoc tag
            $responseClass = $builder->getResponseClass($functionName);
            $responseClass = 'Loco\\Http\\' === substr($responseClass, 0, 10) ? substr($responseClass, 10) : '\\'.$responseClass;
            // $description = sprintf('%s {@link %s}', $operation['summary'], $operation['documentationUrl'] );
            $methodTags[$functionName] = sprintf(' * @method %s %s(%s) %s', $responseClass, $functionName, $options?'array $params = []':'', $operation['summary']);
        }
            
        // Document ApiClass with magic @method tags
        $ref = new \ReflectionClass('Loco\\Http\\ApiClient');
        $lines = preg_split('/\\R/', $ref->getDocComment());
        array_pop($lines);
        // index existing method signatures
        $index = [];
        foreach ($lines as $line => $text) {
            if (preg_match('/^ \\* @method [\\\\a-z]+ ([a-z0-9]+).+/i', $text, $match)) {
                $index[ $match[1] ] = [ 'line' => $line, 'text' => $text ];
            }
        }
        // update docblock if any methods have been added or changed
        $updateDoc = false;
        foreach ($methodTags as $name => $text) {
            if (! isset($index[$name])) {
                $lines[] = $text;
                $updateDoc = true;
                $output->writeln(sprintf('+ %s definition is new', $name));
            } elseif ($index[$name]['text'] !== $text) {
                $lines[ $index[$name]['line'] ] = $text;
                $updateDoc = true;
                $output->writeln(sprintf('! %s definition has changed', $name));
            }
        }
        if ($updateDoc) {
            $output->writeln(sprintf('Updating %u @magic methods...', count($methodTags)));
            // reconstruct doc comment and spice into file
            $lines[] = ' */';
            $file = $ref->getFileName();
            $source = file_get_contents($file);
            $source = str_replace($ref->getDocComment(), implode("\n", $lines), $source);
            $bytes = file_put_contents($file, $source);
            $output->writeln(sprintf('Wrote %u bytes to %s', $bytes, $file));
        }

        $output->writeln('<info>OK, all built for '.$domain.'</info>');

        return 0;
    }
}
