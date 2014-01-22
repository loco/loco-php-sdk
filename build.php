#!/usr/bin/env php
<?php
/**
 * Compile separate json files into single Guzzle service definition
 */

$base = __DIR__.'/src/Loco/Http/Resources';  
$path = $base.'/service.json';
$json = file_get_contents( $path );
$root = json_decode( $json, true );

foreach( array('operations','models') as $dir ){
    $root[$dir] = array();
    foreach( glob($base.'/'.$dir.'/*.json') as $_path){
        $name = pathinfo( $_path, PATHINFO_FILENAME );
        $node = json_decode( file_get_contents($_path), true );
        if( ! is_array($node) ){
            throw new Exception('Bad JSON for "'.$name.'"');
        }
        $root[$dir][$name] = $node;
    }
}

// output PHP array for including from Loco\Http\ApiClient
$target = $base.'/service.php';
file_put_contents( $target, "<?php\nreturn ".var_export( $root, 1 ).";\n" );

echo "Service description saved to ",$target,"\n";
