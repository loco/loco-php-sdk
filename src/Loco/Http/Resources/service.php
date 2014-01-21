<?php
return array (
  'name' => 'loco-sdk-php',
  'apiVersion' => '1.0',
  'baseUrl' => '',
  'description' => 'Loco REST API client',
  'operations' => 
  array (
    'convert' => 
    array (
      'summary' => 'Convert to and from various file formats',
      'uri' => 'convert/{from}/{domain}{.locale}.{to}{?format}',
      'httpMethod' => 'POST',
      'responseType' => 'class',
      'responseClass' => 'Loco\\Http\\Response\\ConvertResponse',
      'responseNotes' => 'Response format is the raw data specified by the file extension',
      'parameters' => 
      array (
        'src' => 
        array (
          'required' => true,
          'description' => 'Raw source of file being converted',
          'location' => 'body',
        ),
        'from' => 
        array (
          'required' => true,
          'description' => 'Source file format being converted',
          'location' => 'uri',
        ),
        'to' => 
        array (
          'required' => true,
          'description' => 'Target file format being converted to, specified as file extension',
          'location' => 'uri',
        ),
        'format' => 
        array (
          'description' => 'Specific target format for some file types',
          'location' => 'query',
        ),
        'domain' => 
        array (
          'default' => 'messages',
          'description' => 'Domain/namespace applicable to some target formats, defaults to \'messages\'',
          'location' => 'uri',
        ),
        'locale' => 
        array (
          'description' => 'Locale of target language pack',
          'location' => 'uri',
        ),
      ),
    ),
    'ping' => 
    array (
      'summary:' => 'Check the server is up',
      'uri' => 'ping.json',
      'httpMethod' => 'GET',
      'responseClass' => 'PingOutput',
      'responseNotes' => 'Always responds 200 with \'pong\' message',
    ),
    'verify' => 
    array (
      'summary' => 'Check authentication via your Loco API project key',
      'uri' => 'auth/verify.json{?key}',
      'httpMethod' => 'GET',
      'responseClass' => 'VerifyOutput',
      'parameters' => 
      array (
        'key' => 
        array (
          'description' => 'Loco project key',
          'required' => true,
          'location' => 'query',
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 401,
          'phrase' => 'API key is not valid',
        ),
      ),
    ),
  ),
  'models' => 
  array (
    'PingOutput' => 
    array (
      'type' => 'object',
      'properties' => 
      array (
        'ping' => 
        array (
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'VerifyOutput' => 
    array (
      'type' => 'object',
      'properties' => 
      array (
        'user' => 
        array (
          'type' => 'object',
          'location' => 'json',
          'properties' => 
          array (
            'id' => 
            array (
              'type' => 'integer',
            ),
            'name' => 
            array (
              'type' => 'string',
            ),
            'email' => 
            array (
              'type' => 'string',
            ),
          ),
        ),
        'group' => 
        array (
          'type' => 'object',
          'properties' => 
          array (
            'id' => 
            array (
              'type' => 'integer',
            ),
            'name' => 
            array (
              'type' => 'string',
            ),
          ),
        ),
        'project' => 
        array (
          'type' => 'object',
          'properties' => 
          array (
            'id' => 
            array (
              'type' => 'integer',
            ),
            'name' => 
            array (
              'type' => 'string',
            ),
            'url' => 
            array (
              'type' => 'string',
            ),
          ),
        ),
      ),
      'additionalProperties' => false,
    ),
  ),
  'includes' => 
  array (
  ),
);
