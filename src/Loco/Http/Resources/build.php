#!/usr/bin/env php
<?php
/**
 * Compile separate json files into single PHP service definition
 */
 
$path = __DIR__.'/service.json';
$json = file_get_contents( $path );
$root = json_decode( $json, true );

foreach( array('operations','models') as $dir ){
    $root[$dir] = array();
    foreach( glob(__DIR__.'/'.$dir.'/*.json') as $_path){
        $name = pathinfo( $_path, PATHINFO_FILENAME );
        $node = json_decode( file_get_contents($_path), true );
        if( ! is_array($node) ){
            throw new Exception('Bad JSON for "'.$name.'"');
        }
        $root[$dir][$name] = $node;
    }
}

// output PHP array for including
$target = __DIR__.'/service.php';
file_put_contents( $target, "<?php\nreturn ".var_export( $root, 1 ).";\n" );

echo "Ok, PHP service description saved to ",$target,"\n";
