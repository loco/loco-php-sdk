<?php
namespace Loco\Swagger\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Http\Message\Response;


/**
 * Base response class for Swagger docs resources
 */
abstract class BaseResponse implements ResponseClassInterface {
    
    /**
     * Raw response data
     * @var array
     */
    protected $raw;

    /**
     * @internal Construct from http response
     */
    final protected function __construct( Response $response ) {
        $this->raw = $response->json();
    }

    
    
    /**
     * @internal Get raw data value
     * @return mixed
     */
    protected function get($key){
        return isset($this->raw[$key]) ? $this->raw[$key] : null;
    }    
    

    
    /**
     * Get declared API version number
     * @return string
     */
    public function getApiVersion(){
        return $this->get('apiVersion')?:'';
    }    
    

    
    /**
     * Get all path strings in objects under apis:
     * @return 
     */   
    public function getApiPaths(){
        $paths = array();
        if( $apis = $this->get('apis') ){
            foreach( (array) $apis as $api ){
                if( isset($api['path']) ){
                    $paths[] = $api['path'];
                }
            }
        }
        return $paths;
    }    

    
}


