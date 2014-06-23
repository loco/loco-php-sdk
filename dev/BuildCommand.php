<?php

namespace Loco\Dev;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Loco\Http\ApiClient;
use Loco\Utils\Swizzle\Swizzle;


/**
 * 
 */
final class BuildCommand extends Command {
    

    protected function configure(){
        $this
            ->setName('loco:build')
            ->setDescription('Build Loco API service description and generated commands')
            ->addOption(
                'dev', '',
                InputOption::VALUE_NONE,
                'Whether to build local development version for testing'
            );
    }
    
    
    protected function execute( InputInterface $input, OutputInterface $output ){
        
        $verbose = $output->getVerbosity();
        
        if( ! class_exists('\Loco\Utils\Swizzle\Swizzle') ){
            throw new \RuntimeException("Swizzle not found.\nRun composer install --dev\n");
        }
        
        if( ! file_exists( $confpath = __DIR__.'/../config.json' ) ){
            throw new \RuntimeException('config.json not found, do ~$ cp config.json.dist config.json');
        }
        
        $conf = json_decode( file_get_contents($confpath), true );
        if( ! isset($conf['services']['loco']['params']['base_url']) ){
            throw new \RuntimeException('Invalid config.json, need services.loco.params.base_url');
        }
        
        $builder = new Swizzle( 'Loco', 'Loco REST API' );
        $builder->setDelay( 0 );
        if( 1 < $output->getVerbosity() ){
            $builder->verbose( STDERR );
        }
                
        // Register custom Guzzle response classes
        $raw = '\Loco\Http\Response\RawResponse';
        $zip = '\Loco\Http\Response\ZipResponse';
        $builder->registerResponseClass('exportArchive', $zip )
                ->registerResponseClass('exportTemplate', $raw )
                ->registerResponseClass('exportLocale', $raw )
                ->registerResponseClass('exportAll', $raw )
                ->registerResponseClass('convert', $raw );

        // Enable response validation and locale URL if building for local test
        $base_url = $conf['services']['loco']['params']['base_url'];
        $domain = parse_url($base_url,PHP_URL_HOST);
        if( ! empty($conf['services']['loco']['strict']) ){ 
            $builder->registerCommandClass( '', '\Loco\Http\Command\StrictCommand');
        }

        $base_url .= '/docs';
        $output->writeln('<comment>Pulling docs from '.$base_url.'</comment>');
        $builder->build( $base_url );
        
        $file = __DIR__.'/../src/Http/Resources/service.php';
        $blen = file_put_contents( $file, $builder->export() );
        $output->writeln( printf("Wrote PHP service description to %s (%s bytes)", $file, $blen ) );
        
        $file = __DIR__.'/../src/Http/Resources/service.json';
        $blen = file_put_contents( $file, $builder->toJson() );
        $output->writeln( printf("Wrote JSON service description to %s (%s bytes)", $file, $blen ) );

        /* Service descriptions build for rest client,
        // build console commands from raw service description data
        // 
        foreach( $builder->getServiceDescription()->toArray() as $callName => $operation ){
            
            $descr = $operation['summary'];
            
            foreach( $operation['parameters'] as $name => $param ){
                $required = ! empty($param['required']);
            }
            
            $source = file_get_contents(__DIR__.'/src/Console/Command/Base/TemplateCommand.php');
            
            $source = str_replace('%%');
            
            
        }
        */   

        $output->writeln('<info>OK, all built</info>');
        return 0;
    }   
    
    
}
