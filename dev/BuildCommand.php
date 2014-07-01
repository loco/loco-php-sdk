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

        $cwd = realpath( __DIR__.'/..' );
        $verbose = 1 < $output->getVerbosity();
        
        if( ! class_exists('\Loco\Utils\Swizzle\Swizzle') ){
            throw new \RuntimeException("Swizzle not found.\nRun composer install --dev\n");
        }
        
        if( ! file_exists( $confpath = $cwd.'/config.json' ) ){
            throw new \RuntimeException('config.json not found, do ~$ cp config.json.dist config.json');
        }
        
        $conf = json_decode( file_get_contents($confpath), true );
        if( ! isset($conf['services']['loco']['params']['base_url']) ){
            throw new \RuntimeException('Invalid config.json, need services.loco.params.base_url');
        }
        
        $builder = new Swizzle( 'Loco', 'Loco REST API' );
        $builder->setDelay( 0 );
        $verbose and $builder->verbose( STDERR );
                
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
        
        $file = $cwd.'/src/Http/Resources/service.php';
        $blen = file_put_contents( $file, $builder->export() );
        $verbose and $output->writeln( sprintf("Wrote PHP service description to %s (%s bytes)", $file, $blen ) );
        
        $file = $cwd.'/src/Http/Resources/service.json';
        $blen = file_put_contents( $file, $builder->toJson() );
        $verbose and $output->writeln( sprintf("Wrote JSON service description to %s (%s bytes)", $file, $blen ) );

        // Service descriptions build for rest client,
        // build console commands from raw service description data
        $output->writeln('<comment>Building Console command classes</comment>');
        $service = $builder->getServiceDescription()->toArray();
        foreach( $service['operations'] as $funcname => $operation ){

            $cmdname = 'loco:'.strtolower(preg_replace('/[A-Z][a-z]/',':\\0',$funcname));
            $classname = strtoupper($funcname{0}).substr($funcname,1).'Command';
            
            $options = array();
            foreach( $operation['parameters'] as $name => $param ){
                if( 'key' === $name ){
                    // special override for key as it's configurable
                    $options[] = "->addOption('key','k',InputOption::VALUE_OPTIONAL,'Override configured API key for this request','')";
                    continue;
                }
                $descr = var_export($param['description'],1);
                $default = isset($param['default']) ? var_export($param['default'],1) : 'null';
                if( 'uri' === $param['location'] ){
                    $required = 'null' === $default ? 'REQUIRED' : 'OPTIONAL';
                    $options[] = '->addArgument('.var_export($name,1).",InputArgument::".$required.','.$descr.','.$default.')';
                }
                else {
                    //$required = ! empty($param['required']); // option values are always required. this does not mean mandatory
                    $options[] = '->addOption('.var_export($name,1).",'',InputOption::VALUE_REQUIRED,".$descr.','.$default.')';
                }
            }
            
            // write base class, containing all api endpoint configuration
            $source = file_get_contents($cwd.'/src/Console/Command/Resources/TemplateCommand.tpl');
            $source = str_replace("%name%", $cmdname, $source );
            $source = str_replace("%method%", $funcname, $source );
            $source = str_replace('TemplateCommand', $classname, $source );
            $source = str_replace("'%description%'", var_export($operation['summary'],1), $source );
            if( $options ){
                $source = str_replace('/* %options% */', implode("\n            ",$options), $source );
            }
           
            $file = $cwd.'/src/Console/Command/Generated/'.$classname.'.php';
            $blen = file_put_contents( $file, $source );
            $verbose and $output->writeln( sprintf("Wrote %s class to %s (%s bytes)", $cmdname, $file, $blen ) );
            
        }

        $output->writeln('<info>OK, all built for '.$domain.'</info>');
        return 0;
    }   
    
    
}
