#!/usr/bin/env php
<?php

$json = file_get_contents( __DIR__.'/restapi.json' );
$data = json_decode( $json, true );

echo 'return $client->setDescription( ServiceDescription::factory( ',var_export( $data, 1 )," ) );\n";