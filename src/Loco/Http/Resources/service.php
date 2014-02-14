<?php
/**
 * Auto-generated with Swizzle at 2014-02-14 18:57:49 +0000
 */
return array (
  'name' => 'loco',
  'apiVersion' => '1.0.2',
  'baseUrl' => 'https://ssl.loco.192.168.0.7.xip.io/',
  'description' => 'Loco REST API',
  'operations' => 
  array (
    'authVerify' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/auth/verify.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Creds',
      'responseType' => 'model',
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
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
      ),
    ),
    'convert' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/convert/{from}/{name}.{ext}',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => '\\Loco\\Http\\Response\\RawResponse',
      'responseType' => 'class',
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
          'enum' => 
          array (
            0 => 'json',
            1 => 'mo',
            2 => 'php',
            3 => 'po',
            4 => 'properties',
            5 => 'resx',
            6 => 'strings',
            7 => 'symfony',
            8 => 'tmx',
            9 => 'ts',
            10 => 'xlf',
            11 => 'xml',
            12 => 'yml',
          ),
          'default' => 'json',
        ),
        'ext' => 
        array (
          'required' => true,
          'description' => 'Target file format being exported, specified as a file extension',
          'type' => 'string',
          'location' => 'uri',
          'enum' => 
          array (
            0 => 'csv',
            1 => 'html',
            2 => 'js',
            3 => 'json',
            4 => 'mo',
            5 => 'phps',
            6 => 'po',
            7 => 'pot',
            8 => 'properties',
            9 => 'resx',
            10 => 'sql',
            11 => 'strings',
            12 => 'tmx',
            13 => 'ts',
            14 => 'xlf',
            15 => 'xml',
            16 => 'yml',
          ),
          'default' => 'json',
        ),
        'format' => 
        array (
          'description' => 'Specific target format, required for some file types',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => '',
            1 => 'symfony',
            2 => 'zend',
            3 => 'codeigniter',
            4 => 'constants',
            5 => 'chrome',
            6 => 'nested',
            7 => 'java',
            8 => 'tizen',
            9 => 'gettext',
          ),
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
          'description' => 'Locale of target language pack, required in most cases',
          'type' => 'string',
          'location' => 'query',
        ),
        'native' => 
        array (
          'description' => 'Optional source locale, not required in many cases',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 204,
          'phrase' => 'No messages could be extracted from source',
        ),
        1 => 
        array (
          'code' => 422,
          'phrase' => 'Empty or invalid source data',
        ),
      ),
    ),
    'exportAll' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/export/all.{ext}',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => '\\Loco\\Http\\Response\\RawResponse',
      'responseType' => 'class',
      'responseNotes' => 'Export all translations from your project to a multi-locale language pack.<br />
           <br />
           Note that not all formats support multiple locales in the same file. See <code>/export/archive</code> for exporting separate files,
           and <code>/export/locale</code> for exporting one language at a time.',
      'summary' => 'Export your whole project to a multi-locale language pack',
      'parameters' => 
      array (
        'ext' => 
        array (
          'required' => true,
          'description' => 'Target file type specified as a file extension',
          'type' => 'string',
          'location' => 'uri',
          'enum' => 
          array (
            0 => 'csv',
            1 => 'html',
            2 => 'sql',
            3 => 'tmx',
            4 => 'xlf',
            5 => 'yml',
          ),
          'default' => 'yml',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
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
          'enum' => 
          array (
            0 => 'id',
            1 => 'name',
            2 => 'text',
          ),
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
      ),
    ),
    'exportArchive' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/export/archive/{ext}.zip',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => '\\Loco\\Http\\Response\\ZipResponse',
      'responseType' => 'class',
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
          'enum' => 
          array (
            0 => 'csv',
            1 => 'html',
            2 => 'js',
            3 => 'json',
            4 => 'mo',
            5 => 'phps',
            6 => 'po',
            7 => 'pot',
            8 => 'resx',
            9 => 'sql',
            10 => 'strings',
            11 => 'tmx',
            12 => 'ts',
            13 => 'xlf',
            14 => 'xml',
            15 => 'yml',
          ),
          'default' => 'json',
        ),
        'format' => 
        array (
          'description' => 'Specific format, applicable to some file types only',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'symfony',
            1 => 'zend',
            2 => 'codeigniter',
            3 => 'constants',
            4 => 'chrome',
            5 => 'nested',
            6 => 'java',
            7 => 'tizen',
          ),
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
          'enum' => 
          array (
            0 => 'id',
            1 => 'name',
            2 => 'text',
          ),
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
      ),
    ),
    'exportLocale' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/export/locale/{locale}.{ext}',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => '\\Loco\\Http\\Response\\RawResponse',
      'responseType' => 'class',
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
          'enum' => 
          array (
            0 => 'csv',
            1 => 'html',
            2 => 'js',
            3 => 'json',
            4 => 'mo',
            5 => 'phps',
            6 => 'po',
            7 => 'pot',
            8 => 'resx',
            9 => 'sql',
            10 => 'strings',
            11 => 'tmx',
            12 => 'ts',
            13 => 'xlf',
            14 => 'xml',
            15 => 'yml',
          ),
          'default' => 'json',
        ),
        'format' => 
        array (
          'description' => 'Specific format, applicable to some file types only',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'symfony',
            1 => 'zend',
            2 => 'codeigniter',
            3 => 'constants',
            4 => 'chrome',
            5 => 'nested',
            6 => 'java',
            7 => 'tizen',
          ),
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
          'enum' => 
          array (
            0 => 'id',
            1 => 'name',
            2 => 'text',
          ),
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
      ),
    ),
    'locales' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/locales.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'ProjectLocales',
      'responseType' => 'model',
      'summary' => 'List all locales in currently authenticated project',
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
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
      ),
    ),
    'ping' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/ping.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Echo',
      'responseType' => 'model',
      'summary' => 'Check the API is up and check API version number',
      'parameters' => 
      array (
      ),
    ),
    'ping404' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/ping/not-found.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Error',
      'responseType' => 'model',
      'summary' => 'Get a test 404 response',
      'parameters' => 
      array (
      ),
    ),
  ),
  'models' => 
  array (
    'Project' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'id' => 
        array (
          'description' => 'Project id',
          'type' => 'integer',
          'location' => 'json',
        ),
        'name' => 
        array (
          'description' => 'Project name',
          'type' => 'string',
          'location' => 'json',
        ),
        'url' => 
        array (
          'description' => 'Project dashboard URL',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'Group' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'id' => 
        array (
          'description' => 'Loco account id',
          'type' => 'integer',
          'location' => 'json',
        ),
        'name' => 
        array (
          'description' => 'Loco account name',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'User' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'id' => 
        array (
          'description' => 'User id',
          'type' => 'integer',
          'location' => 'json',
        ),
        'name' => 
        array (
          'description' => 'Full user name',
          'type' => 'string',
          'location' => 'json',
        ),
        'email' => 
        array (
          'description' => 'User\'s email address',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'Creds' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'user' => 
        array (
          'required' => true,
          'description' => 'Authenticated user',
          'type' => 'null',
          'location' => 'json',
        ),
        'group' => 
        array (
          'required' => true,
          'description' => 'Authenticated account',
          'type' => 'null',
          'location' => 'json',
        ),
        'project' => 
        array (
          'required' => true,
          'description' => 'Project associated with authentication key',
          'type' => 'null',
          'location' => 'json',
        ),
      ),
    ),
    'Locale' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'code' => 
        array (
          'description' => 'Locale short code',
          'type' => 'string',
          'location' => 'json',
        ),
        'default' => 
        array (
          'description' => 'Whether native/source locale of project',
          'type' => 'boolean',
          'location' => 'json',
        ),
        'name' => 
        array (
          'description' => 'Full locale name',
          'type' => 'string',
          'location' => 'json',
        ),
        'plurals' => 
        array (
          'description' => 'Plural forms',
          'type' => 'null',
          'location' => 'json',
        ),
      ),
    ),
    'ProjectLocales' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'source' => 
        array (
          'description' => 'Source locale',
          'type' => 'null',
          'location' => 'json',
        ),
        'targets' => 
        array (
          'description' => 'Source locale',
          'type' => 'array',
          'location' => 'json',
          'items' => 
          array (
            'type' => 'object',
            'additionalProperties' => false,
            'properties' => 
            array (
              'code' => 
              array (
                'description' => 'Locale short code',
                'type' => 'string',
                'location' => 'json',
              ),
              'default' => 
              array (
                'description' => 'Whether native/source locale of project',
                'type' => 'boolean',
                'location' => 'json',
              ),
              'name' => 
              array (
                'description' => 'Full locale name',
                'type' => 'string',
                'location' => 'json',
              ),
              'plurals' => 
              array (
                'description' => 'Plural forms',
                'type' => 'null',
                'location' => 'json',
              ),
            ),
          ),
        ),
      ),
    ),
    'Error' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'status' => 
        array (
          'required' => true,
          'description' => 'HTTP status code',
          'type' => 'integer',
          'location' => 'json',
        ),
        'error' => 
        array (
          'required' => true,
          'description' => 'Description of error',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'Echo' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'version' => 
        array (
          'required' => true,
          'description' => 'Current API version',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
  ),
);
