<?php
return array (
  'name' => 'loco',
  'apiVersion' => '1.0.1',
  'description' => 'Loco REST API client',
  'operations' => 
  array (
    'authVerify' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/auth/verify.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => 'Loco API keys authenticate your user account for accessing a specific project.<br />
             This endpoint verifies an API key and returns the authenticated user, account and project.',
      'summary' => 'Verify an API project key',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
    ),
    'convert' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/convert/{from}/{name}.{ext}',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => 'Use this API to convert between language pack file formats without a Loco account.<br /> 
             Precise options depend on the file formats you\'re converting between.
             <a href=\'https://localise.biz/free/converter/api\'>See some examples</a>.',
      'summary' => 'Convert a language pack to another file format',
      'parameters' => 
      array (
        'src' => 
        array (
          'required' => true,
          'description' => 'Raw source of file being converted',
          'type' => 'string',
          'location' => 'body',
          'default' => '{"foo":"bar"}',
        ),
        'from' => 
        array (
          'required' => true,
          'description' => 'Source file format being imported',
          'type' => 'string',
          'location' => 'uri',
          'default' => 'json',
        ),
        'ext' => 
        array (
          'required' => true,
          'description' => 'Target file format being exported, specified as a file extension',
          'type' => 'string',
          'location' => 'uri',
          'default' => 'json',
        ),
        'format' => 
        array (
          'description' => 'Specific target format, required for some file types',
          'type' => 'string',
          'location' => 'query',
        ),
        'name' => 
        array (
          'description' => 'Domain/namespace, applicable to some file formats',
          'type' => 'string',
          'location' => 'uri',
          'default' => 'messages',
        ),
        'locale' => 
        array (
          'description' => 'Locale of target language pack, required for some formats',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
    ),
    'exportLocale' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/export/locale/{locale}.{ext}',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => 'Export translations from your project to a locale-specific language pack.
           Various export file types are supported with format variations for some types.',
      'summary' => 'Export a single locale to a language pack.',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
          'type' => 'string',
          'location' => 'query',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Locale to export, specified as short code. e.g. \'en\' or \'en_GB\'',
          'type' => 'string',
          'location' => 'uri',
        ),
        'ext' => 
        array (
          'required' => true,
          'description' => 'Target file type specified as a file extension',
          'type' => 'string',
          'location' => 'uri',
          'default' => 'json',
        ),
        'format' => 
        array (
          'description' => 'Specific format, applicable to some file types only',
          'type' => 'string',
          'location' => 'query',
        ),
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to export subset of assets.',
          'type' => 'string',
          'location' => 'query',
        ),
        'index' => 
        array (
          'description' => 'Override default lookup key in language pack. Leave blank for auto.',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
    ),
    'exportArchive' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/export/archive/{ext}.zip',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => 'Export all translations from your project to a zip archive of language packs.<br />
           <br />
           If you\'re exporting to a file format that supports multiple locales within the same file, you can use the <code>/export/all</code> method ',
      'summary' => 'Export all locales to a zip archive',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
          'type' => 'string',
          'location' => 'query',
        ),
        'ext' => 
        array (
          'required' => true,
          'description' => 'Target file type specified as a file extension',
          'type' => 'string',
          'location' => 'uri',
          'default' => 'json',
        ),
        'format' => 
        array (
          'description' => 'Specific format, applicable to some file types only',
          'type' => 'string',
          'location' => 'query',
        ),
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to export subset of assets.',
          'type' => 'string',
          'location' => 'query',
        ),
        'index' => 
        array (
          'description' => 'Override default lookup key in language pack. Leave blank for auto.',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
    ),
    'ping' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/ping.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'summary' => 'Check the API is up and check API version number',
      'parameters' => 
      array (
      ),
    ),
    'ping404' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/ping/not-found.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'summary' => 'Get a test 404 response',
      'parameters' => 
      array (
      ),
    ),
  ),
);
