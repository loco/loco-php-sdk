<?php

namespace Loco\Swagger;

use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Description\Operation;

/**
 * Models Swagger API declarations and converts to Guzzle service descriptions.
 */
class DocsModel {
    
    /**
     * @var ServiceDescription
     */
    private $service;    
    
    /**
     * @var array
     */    
    private $responses = array();
    
    /**
     * Construct with minimum mandatory parameters, name and version.
     */
    public function __construct( $name, $description, $apiVersion ){
        $this->service = new ServiceDescription( compact('name','description','apiVersion') );
    }    
    
    
    /**
     * Get compiled Guzzle service description
     * @return ServiceDescription
     */
    public function getDescription(){
        return $this->service;
    }
    
    
    
    /**
     * Apply a bespoke responseClass to a given method
     * @return DocsModel
     */
    public function registerResponseClass( $name, $class ){
        $this->responses[$name] = $class;
        // method may have already been encountered
        if( $op = $this->service->getOperation( $name ) ){
            $op->setResponseClass( $class );
        }
        return $this;
    }    
    
    
    
    /**
     * Add a Swagger Api declaration which may consist of multiple operations
     * @param array consisting of path, description and array of operations
     * @todo how do we handle responseClass mapping?
     * @return DocsModel
     */    
    public function addSwaggerApi( array $api ){
        // path is common to all swagger operations and specified as URI
        $path = $api['path'];
        // operation keys common to both swagger and guzzle
        static $common = array (
            'summary' => '',
        );
        // translate swagger -> guzzle 
        static $trans = array (
            'method' => 'httpMethod',
            'type' => 'responseType',
            'notes' => 'responseNotes',
        );
        foreach( $api['operations'] as $op ){
            $config = $this->transformArray( $op, $common, $trans );
            $config['uri'] = $path;
            // command must have a name, and must be unique across methods
            if( isset($op['nickname']) ){
                $id = $config['name'] = $op['nickname'];
            }
            // generate naff nickname if not specified
            else {
                $method = isset($op['method']) ? $op['method'] : 'GET';
                $id = $config['name'] = $method.'_'.str_replace('/','_',trim($path,'/') );
            }
            // allow response class override
            if( isset($this->responses[$id]) ){
                $config['responseType'] = 'class';
                $config['responseClass'] = $this->responses[$id];
            }
            // handle non-primative response types
            else if( isset($config['responseType']) ){
                $type = $config['responseType'];
                // set to primatives
                static $primatives = array( 'string' => 'string', 'array' => 'array' );
                if( isset($primatives[$type]) ){
                    $config['responseType'] = 'primitive';
                    $config['responseClass'] = $primatives[$type];
                }
                // set to model if model matches
                else if( $this->service->getModel($type) ){
                    $config['responseType'] = 'model';
                    $config['responseClass'] = $type;
                }
            }
            // handle parameters
            if( isset($op['parameters']) ){
                $config['parameters'] = $this->transformParams( $op['parameters'] );
            }
            else {
                $config['parameters'] = array();
            }
            // add operation
            $operation = new Operation( $config, $this->service );
            $this->service->addOperation( $operation );
        }
        return $this;
    }



    /**
     * Map a swagger parameter to a Guzzle one
     */
    private function transformParams( array $params ){
        // param keys common to both swagger and guzzle
        static $common = array (
            'type' => '',
            'required' => '',
            'description' => '',
        );
        // translate swagger -> guzzle 
        static $trans = array (
            'paramType' => 'location',
            'defaultValue' => 'default',
        );
        $target = array();
        foreach( $params as $_param ){
            $name = $_param['name'];
            $param = $this->transformArray( $_param, $common, $trans );
            // location differences 
            if( isset($param['location']) && 'path' === $param['location'] ){
                $param['location'] = 'uri';
                // swagger doesn't allow optional path params
                if( ! isset($param['required']) ){
                    $param['required'] = true;
                }
            }
            $target[$name] = $param;
        }        
        return $target;
    }



    /**
     * Utility transform an array based on similarities and differences between the two formats.
     * @param arrray source format (swagger)
     * @param array keys common to both formats, { key: '', ... }
     * @param array key translation mappings, { keya: keyb, ... }
     * @return array target format (guzzle)
     */
    private function transformArray( array $swagger, array $common, array $trans ){
        // initialize with common array keys
        $guzzle = array_intersect_key( $swagger, $common );
        // translate other naming differences
        foreach( $trans as $source => $target ){
            if( isset($swagger[$source]) ){
                $guzzle[$target] = $swagger[$source];
            }
        }
        return $guzzle;
    }
    
    
    
    /**
     * Export service description to JSON
     * @return string
     */
    public function toJson(){
        $options = 0;
        if( defined('JSON_PRETTY_PRINT') ){
            $options |= JSON_PRETTY_PRINT; // <- PHP>=5.4.0
        }
        return json_encode( $this->service->toArray(), $options );
    }    



    /**
     * Export service description to PHP array
     * @return string
     */
    public function export(){
        return var_export( $this->service->toArray(), 1 ); 
    }    
    
}



