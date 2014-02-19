<?php
/**
 * Auto-generated with Swizzle at 2014-02-19 11:49:57 +0000
 */
return array (
  'name' => 'Loco',
  'apiVersion' => '1.0.3',
  'baseUrl' => 'https://localise.biz/',
  'description' => 'Loco REST API',
  'operations' => 
  array (
    'getAssets' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/assets.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'summary' => 'List all translatable assets in your project',
      'parameters' => 
      array (
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to filter subset of assets.',
          'type' => 'string',
          'location' => 'query',
        ),
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
    'createAsset' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/assets.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => '<p>Adds a new asset to the currently authenticated project.</p>',
      'summary' => 'Add a new translatable asset',
      'parameters' => 
      array (
        'name' => 
        array (
          'required' => true,
          'description' => 'Source text or just a name describing what the asset is',
          'type' => 'string',
          'location' => 'postField',
        ),
        'id' => 
        array (
          'description' => 'Optional machine friendly ID if you want something specific',
          'type' => 'string',
          'location' => 'postField',
        ),
        'type' => 
        array (
          'required' => true,
          'description' => 'Media type, defaults to plain old text',
          'type' => 'string',
          'location' => 'postField',
          'enum' => 
          array (
            0 => 'text',
            1 => 'html',
            2 => 'image',
            3 => 'audio',
            4 => 'video',
            5 => 'bin',
          ),
          'default' => 'text',
        ),
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
        1 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
        ),
      ),
    ),
    'getAsset' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/assets/{id}.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => 'Gets a single asset in currently authenticated project',
      'summary' => 'Get a project asset',
      'parameters' => 
      array (
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
        ),
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
        1 => 
        array (
          'code' => 404,
          'phrase' => 'Asset not in project',
        ),
      ),
    ),
    'deleteAsset' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/assets/{id}.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Deletes an asset from the currently authenticated project.</p>
           <p><strong>Warning</strong>: This will permanently delete all translations made of this asset across all locales</p>',
      'summary' => 'Delete an asset permanently',
      'parameters' => 
      array (
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
        ),
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
        1 => 
        array (
          'code' => 404,
          'phrase' => 'Asset not in project',
        ),
        2 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
        ),
      ),
    ),
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
        'name' => 
        array (
          'description' => 'Domain/namespace, applicable to some file formats',
          'type' => 'string',
          'location' => 'uri',
          'default' => 'messages',
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
          'description' => 'Comma-separated list of tags to filter subset of assets.',
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
          'description' => 'Comma-separated list of tags to filter subset of assets.',
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
          'description' => 'Comma-separated list of tags to filter subset of assets.',
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
    'getLocales' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/locales.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => 'Lists all locales in currently authenticated project. Your native/source language will always be the first in the list',
      'summary' => 'List all locales in your project',
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
    'createLocale' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/locales.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Locale',
      'responseType' => 'model',
      'responseNotes' => '<p>Adds a new locale to the currently authenticated project.</p>
           <p>Note that if the locale already exists in the project, it will just be returned and not duplicated.</p>',
      'summary' => 'Add a new project locale',
      'parameters' => 
      array (
        'code' => 
        array (
          'required' => true,
          'description' => 'Short code of locale to create, e.g. \'fr\' or \'fr_FR\'',
          'type' => 'string',
          'location' => 'postField',
        ),
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
        1 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
        ),
      ),
    ),
    'getLocale' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/locales/{locale}.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Locale',
      'responseType' => 'model',
      'responseNotes' => 'Gets a single locale in currently authenticated project',
      'summary' => 'Get a project locale',
      'parameters' => 
      array (
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. \'fr\' or \'fr_CH\'',
          'type' => 'string',
          'location' => 'uri',
        ),
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
        1 => 
        array (
          'code' => 404,
          'phrase' => 'Locale not in project',
        ),
      ),
    ),
    'patchLocale' => 
    array (
      'httpMethod' => 'PATCH',
      'uri' => '/api/locales/{locale}.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Locale',
      'responseType' => 'model',
      'responseNotes' => '<p>Modifies the properties of a locale in the currently authenticated project.</p>
           <p>The full, modified locale object is returned.</p>',
      'summary' => 'Modify a project locale',
      'parameters' => 
      array (
        'code' => 
        array (
          'description' => 'Locale short code',
          'type' => 'string',
          'location' => 'json',
        ),
        'native' => 
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
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'forms' => 
            array (
              'description' => 'Read only plural form names, see <a href="http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules">Unicode tr35</a>.',
              'type' => 'array',
              'location' => 'json',
              'enum' => 
              array (
                0 => 'zero',
                1 => 'one',
                2 => 'two',
                3 => 'few',
                4 => 'many',
                5 => 'other',
              ),
              'items' => 
              array (
                'type' => 'string',
              ),
            ),
            'length' => 
            array (
              'description' => 'Number of plural forms',
              'type' => 'integer',
              'location' => 'json',
              'minimum' => 1,
              'maximum' => 6,
            ),
            'equation' => 
            array (
              'description' => 'Gettext-style plural form equation taking multiplier <code>n</code> to yield plural form offset <code>0 - length-1</code>.',
              'type' => 'string',
              'location' => 'json',
            ),
          ),
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. \'fr\' or \'fr_CH\'',
          'type' => 'string',
          'location' => 'uri',
        ),
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
        1 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
        ),
        2 => 
        array (
          'code' => 404,
          'phrase' => 'Locale not in project',
        ),
      ),
    ),
    'deleteLocale' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/locales/{locale}.json',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Delete a locale from currently authenticated project.</p>
           <p><strong>Warning</strong>: This will permanently delete any translations made in the specified locale across your project</p>
           <p>Note that you cannot delete your native/source locale.</p>',
      'summary' => 'Delete a project locale',
      'parameters' => 
      array (
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. \'fr\' or \'fr_CH\'',
          'type' => 'string',
          'location' => 'uri',
        ),
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
        1 => 
        array (
          'code' => 404,
          'phrase' => 'Locale not in project',
        ),
        2 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
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
      'responseNotes' => 'Checks the API is up and returns the API version number',
      'summary' => 'Check the API is up',
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
    'Asset' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'id' => 
        array (
          'description' => 'Machine friendly name',
          'type' => 'string',
          'location' => 'json',
        ),
        'type' => 
        array (
          'description' => 'Broad content type, defaults to plain text',
          'type' => 'string',
          'location' => 'json',
          'enum' => 
          array (
            0 => 'text',
            1 => 'html',
            2 => 'image',
            3 => 'audio',
            4 => 'video',
            5 => 'bin',
          ),
        ),
        'name' => 
        array (
          'description' => 'Human friendly name',
          'type' => 'string',
          'location' => 'json',
        ),
        'context' => 
        array (
          'description' => 'Optional context descriptor',
          'type' => 'string',
          'location' => 'json',
        ),
        'modified' => 
        array (
          'description' => 'Time last modified in UTC',
          'type' => 'string',
          'format' => 'date-time',
          'location' => 'json',
        ),
        'translated' => 
        array (
          'description' => 'Number of completed translations',
          'type' => 'integer',
          'location' => 'json',
        ),
        'untranslated' => 
        array (
          'description' => 'Number of incomplete translations',
          'type' => 'integer',
          'location' => 'json',
        ),
      ),
    ),
    'Success' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'status' => 
        array (
          'required' => true,
          'description' => 'HTTP status 2xx code',
          'type' => 'integer',
          'location' => 'json',
        ),
        'message' => 
        array (
          'required' => true,
          'description' => 'Descriptive success message',
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
    'Creds' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'user' => 
        array (
          'required' => true,
          'type' => 'object',
          'location' => 'json',
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
        'group' => 
        array (
          'required' => true,
          'type' => 'object',
          'location' => 'json',
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
        'project' => 
        array (
          'required' => true,
          'type' => 'object',
          'location' => 'json',
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
      ),
    ),
    'anon_type_string' => 
    array (
      'type' => 'string',
    ),
    'Plurals' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'forms' => 
        array (
          'description' => 'Read only plural form names, see <a href="http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules">Unicode tr35</a>.',
          'type' => 'array',
          'location' => 'json',
          'enum' => 
          array (
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'few',
            4 => 'many',
            5 => 'other',
          ),
          'items' => 
          array (
            'type' => 'string',
          ),
        ),
        'length' => 
        array (
          'description' => 'Number of plural forms',
          'type' => 'integer',
          'location' => 'json',
          'minimum' => 1,
          'maximum' => 6,
        ),
        'equation' => 
        array (
          'description' => 'Gettext-style plural form equation taking multiplier <code>n</code> to yield plural form offset <code>0 - length-1</code>.',
          'type' => 'string',
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
        'native' => 
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
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'forms' => 
            array (
              'description' => 'Read only plural form names, see <a href="http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules">Unicode tr35</a>.',
              'type' => 'array',
              'location' => 'json',
              'enum' => 
              array (
                0 => 'zero',
                1 => 'one',
                2 => 'two',
                3 => 'few',
                4 => 'many',
                5 => 'other',
              ),
              'items' => 
              array (
                'type' => 'string',
              ),
            ),
            'length' => 
            array (
              'description' => 'Number of plural forms',
              'type' => 'integer',
              'location' => 'json',
              'minimum' => 1,
              'maximum' => 6,
            ),
            'equation' => 
            array (
              'description' => 'Gettext-style plural form equation taking multiplier <code>n</code> to yield plural form offset <code>0 - length-1</code>.',
              'type' => 'string',
              'location' => 'json',
            ),
          ),
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
  ),
);
