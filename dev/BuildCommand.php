<?php

namespace Loco\Dev;

use Loco\Http\Command\LocoCommand;
use Loco\Http\Command\StrictCommand;
use Loco\Http\Response\RawResponse;
use Loco\Http\Response\ZipResponse;
use Loco\Utils\Swizzle\Swizzle;
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

        if (class_exists(Swizzle::class) === false) {
            throw new \RuntimeException("Swizzle not found.\nRun composer install --dev\n");
        }

        if (file_exists($configPath = $cwd.'/config.json') === false) {
            throw new \RuntimeException('config.json not found, do ~$ cp config.json.dist config.json');
        }

        $conf = json_decode(file_get_contents($configPath), true);
        if (isset($conf['services']['loco']['params']['base_uri']) === false) {
            throw new \RuntimeException('Invalid config.json, need services.loco.params.base_uri');
        }

        $builder = new Swizzle('Loco', 'Loco REST API');
        $builder->setDelay(0);
        if ($verbose === true) {
            $builder->verbose(STDERR);
        }

        // Register custom Guzzle response classes
        $builder->registerResponseClass('exportArchive', ZipResponse::class)
            ->registerResponseClass('exportTemplate', RawResponse::class)
            ->registerResponseClass('exportLocale', RawResponse::class)
            ->registerResponseClass('exportAll', RawResponse::class)
            ->registerResponseClass('convert', RawResponse::class);

        // Enable response validation and locale URL if building for local test
        $base_uri = $conf['services']['loco']['params']['base_uri'];
        $domain = parse_url($base_uri, PHP_URL_HOST);
        if (empty($conf['services']['loco']['strict'])) {
            $builder->registerCommandClass('', LocoCommand::class);
        } else {
            $builder->registerCommandClass('', StrictCommand::class);
        }

        $base_uri .= '/swagger';
        $output->writeln('<comment>Pulling docs from '.$base_uri.'</comment>');
        $builder->build($base_uri);

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
            $usesAvailable = [
                'option' => 'use Symfony\Component\Console\Input\InputOption;',
                'argument' => 'use Symfony\Component\Console\Input\InputArgument;',
            ];
            $usesEnabled = [];

            /* @var $operation array[][] */
            foreach ($operation['parameters'] as $name => $param) {
                if ('key' === $name) {
                    // special override for key as it's configurable
                    $options[] = "->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')";
                    $usesEnabled['option'] = $usesAvailable['option'];
                    continue;
                }
                $description = var_export($param['description'], true);
                $default = isset($param['default']) ? var_export($param['default'], true) : 'null';
                if ('uri' === $param['location']) {
                    $required = 'null' === $default ? 'REQUIRED' : 'OPTIONAL';
                    $options[] = "->addArgument('{$name}',InputArgument::{$required},{$description},{$default})";
                    $usesEnabled['argument'] = $usesAvailable['argument'];
                } else {
                    $options[] = "->addOption('{$name}','',InputOption::VALUE_REQUIRED,{$description},{$default})";
                    $usesEnabled['option'] = $usesAvailable['option'];
                }
            }

            $uses = empty($usesEnabled) === false ? implode("\n", $usesEnabled)."\n" : '';
            $optionsStr = empty($options) === false ? "\n            ".implode("\n            ", $options) : '';
            // write base class, containing all api endpoint configuration
            $source = file_get_contents($cwd.'/src/Console/Command/Resources/TemplateCommand.tpl');
            $source = str_replace(
                ['{{uses}}', '{{name}}', '{{method}}', '{{TemplateCommand}}', '{{description}}', '{{options}}'],
                [$uses, $commandName, $functionName, $className, $operation['summary'], $optionsStr],
                $source
            );

            $file = $cwd.'/src/Console/Command/Generated/'.$className.'.php';
            $byteLength = file_put_contents($file, $source);
            if ($verbose === true) {
                $output->writeln(sprintf('Wrote %s class to %s (%s bytes)', $commandName, $file, $byteLength));
            }
        }

        $output->writeln('<info>OK, all built for '.$domain.'</info>');

        return 0;
    }
}
