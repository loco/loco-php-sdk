<?php

namespace Loco\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Guzzle\Service\Resource\Model;


/**
 * 
 */
class AuthVerifyCommand extends Base\BaseApiCommand {
    
    /**
     * Configure loco:auth:verify command
     * @internal
     */
    protected function configure(){
        $this
            ->setName('loco:auth:verify')
            ->setDescription('Verify creds')
        ;
    }
    
    
    /**
     * Execute loco:auth:verify
     */
    protected function execute( InputInterface $input, OutputInterface $output ){
        
        $client = $this->getApplication()->getRestClient( $input->getOption('key') );
        
        /* @var $model Model */
        $model = $client->authVerify();
        
        $user = $model->get('user');
        $proj = $model->get('project');
        
        $output->writeln('<bg=green;fg=black> ** OK ** </bg=green;fg=black>');
        $output->writeln('Authenticated as <comment>'.$user['name'].'</comment> in <comment>'.$proj['name'].'</comment>');
        
    }    
    
    
    
    
}