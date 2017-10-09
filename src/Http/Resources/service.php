<?php
/**
 * Auto-generated with Swizzle at 2017-10-09 16:47:58 +0100
 */
return array (
  'name' => 'Loco',
  'apiVersion' => '1.0.18',
  'baseUrl' => 'https://localise.biz/',
  'description' => 'Loco REST API',
  'operations' => 
  array (
    'getTags' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/tags.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => 'Lists all tags in currently authenticated project',
      'summary' => 'Get project tags',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
    'createTag' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/tags.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => 'Adds a new tag to the currently authenticated project',
      'summary' => 'Create a new tag',
      'parameters' => 
      array (
        'name' => 
        array (
          'required' => true,
          'description' => 'Name of new tag',
          'type' => 'string',
          'location' => 'postField',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
    'patchTag' => 
    array (
      'httpMethod' => 'PATCH',
      'uri' => '/api/tags/{tag}.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => 'Renames an existing tag in the currently authenticated project',
      'summary' => 'Modify a single tag',
      'parameters' => 
      array (
        'name' => 
        array (
          'description' => 'Display name of tag',
          'type' => 'string',
          'location' => 'json',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'tag' => 
        array (
          'description' => 'Name of a single asset tag.',
          'type' => 'string',
          'location' => 'uri',
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
          'phrase' => 'Tag not in project',
        ),
      ),
    ),
    'deleteTag' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/tags/{tag}.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => 'Deletes an existing tag in the currently authenticated project',
      'summary' => 'Delete an existing tag',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'tag' => 
        array (
          'description' => 'Name of a single asset tag.',
          'type' => 'string',
          'location' => 'uri',
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
          'phrase' => 'Tag not in project',
        ),
      ),
    ),
    'exportAll' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/export/all.{ext}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => '\\Loco\\Http\\Response\\RawResponse',
      'responseType' => 'class',
      'responseNotes' => '<p>Export all translations from your project to a multi-locale language pack.</p>
           <p>Note that not all formats support multiple locales in the same file. See <code>/export/archive</code> for exporting separate files,
           and <code>/export/locale</code> for exporting one language at a time.</p>',
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
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to filter assets. Negate tag names by prefixing with \'!\'.',
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
        'fallback' => 
        array (
          'description' => 'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`',
          'type' => 'string',
          'location' => 'query',
        ),
        'order' => 
        array (
          'description' => 'Export translations according to asset order',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'created',
            1 => 'id',
          ),
        ),
        'status' => 
        array (
          'description' => 'Export only translations with a specific status or flag',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'translated',
            1 => 'untranslated',
            2 => 'incorrect',
            3 => 'provisional',
            4 => 'unapproved',
            5 => 'fuzzy',
            6 => 'incomplete',
            7 => 'rejected',
            8 => 'all',
          ),
        ),
        'printf' => 
        array (
          'description' => 'Force alternative "printf" style. <a href="/help/developers/printf">See string formatting</a>',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'php',
            1 => 'java',
            2 => 'objc',
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
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => '\\Loco\\Http\\Response\\ZipResponse',
      'responseType' => 'class',
      'responseNotes' => 'Export all translations from your project to an archive of individual locale files. You can also specify .tar instead of .zip.<br />
           If you\'re exporting to a format that supports multiple locales per file, you can use the <code>/export/all</code> method instead.',
      'summary' => 'Export all locales to a zip archive',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
            6 => 'rails',
            7 => 'java',
            8 => 'tizen',
            9 => 'gettext',
            10 => 'ng-gettext',
            11 => 'xcode',
            12 => 'script',
          ),
        ),
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to filter assets. Negate tag names by prefixing with \'!\'.',
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
        'namespace' => 
        array (
          'description' => 'Override the project name for some language packs that use it as a key prefix',
          'type' => 'string',
          'location' => 'query',
        ),
        'fallback' => 
        array (
          'description' => 'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`',
          'type' => 'string',
          'location' => 'query',
        ),
        'order' => 
        array (
          'description' => 'Export translations according to asset order',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'created',
            1 => 'id',
          ),
        ),
        'status' => 
        array (
          'description' => 'Export only translations with a specific status or flag',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'translated',
            1 => 'untranslated',
            2 => 'incorrect',
            3 => 'provisional',
            4 => 'unapproved',
            5 => 'fuzzy',
            6 => 'incomplete',
            7 => 'rejected',
            8 => 'all',
          ),
        ),
        'path' => 
        array (
          'description' => 'Custom pattern for file paths. <a href="/help/developers/locales/export-paths">See syntax</a>',
          'type' => 'string',
          'location' => 'query',
        ),
        'printf' => 
        array (
          'description' => 'Force alternative "printf" style. <a href="/help/developers/printf">See string formatting</a>',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'php',
            1 => 'java',
            2 => 'objc',
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
            2 => 'ini',
            3 => 'js',
            4 => 'json',
            5 => 'mo',
            6 => 'php',
            7 => 'po',
            8 => 'pot',
            9 => 'plist',
            10 => 'bplist',
            11 => 'resx',
            12 => 'sql',
            13 => 'strings',
            14 => 'stringsdict',
            15 => 'tmx',
            16 => 'ts',
            17 => 'xlf',
            18 => 'xliff',
            19 => 'xml',
            20 => 'yml',
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
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => '\\Loco\\Http\\Response\\RawResponse',
      'responseType' => 'class',
      'responseNotes' => '<p>Export translations from your project to a locale-specific language pack.</p>
           <p>Various export file types are supported with format variations for some types.
              <a href="https://localise.biz/api#formats">See the full list of supported export formats</a>.</p>',
      'summary' => 'Export a single locale to a language pack.',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
            6 => 'rails',
            7 => 'java',
            8 => 'tizen',
            9 => 'gettext',
            10 => 'ng-gettext',
            11 => 'xcode',
            12 => 'script',
          ),
        ),
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to filter assets. Negate tag names by prefixing with \'!\'.',
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
        'namespace' => 
        array (
          'description' => 'Override the project name for some language packs that use it as a key prefix',
          'type' => 'string',
          'location' => 'query',
        ),
        'fallback' => 
        array (
          'description' => 'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`',
          'type' => 'string',
          'location' => 'query',
        ),
        'order' => 
        array (
          'description' => 'Export translations according to asset order',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'created',
            1 => 'id',
          ),
        ),
        'status' => 
        array (
          'description' => 'Export only translations with a specific status or flag',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'translated',
            1 => 'untranslated',
            2 => 'incorrect',
            3 => 'provisional',
            4 => 'unapproved',
            5 => 'fuzzy',
            6 => 'incomplete',
            7 => 'rejected',
            8 => 'all',
          ),
        ),
        'printf' => 
        array (
          'description' => 'Force alternative "printf" style. <a href="/help/developers/printf">See string formatting</a>',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'php',
            1 => 'java',
            2 => 'objc',
          ),
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Locale to export, specified as short code. e.g. `en` or `en_GB`',
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
            2 => 'ini',
            3 => 'js',
            4 => 'json',
            5 => 'mo',
            6 => 'php',
            7 => 'po',
            8 => 'pot',
            9 => 'plist',
            10 => 'bplist',
            11 => 'resx',
            12 => 'sql',
            13 => 'strings',
            14 => 'stringsdict',
            15 => 'tmx',
            16 => 'ts',
            17 => 'xlf',
            18 => 'xliff',
            19 => 'xml',
            20 => 'yml',
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
    'exportTemplate' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/export/template.{ext}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => '\\Loco\\Http\\Response\\RawResponse',
      'responseType' => 'class',
      'responseNotes' => '<p>Export only the source keys from your project to a language pack.</p>
           <p>This is different to exporting just your source language translations, because it only exports the left hand side of each mapping.</p>
           <p><a href="https://localise.biz/api#formats">See the full list of supported export formats</a>.</p>',
      'summary' => 'Export a template containing only source keys',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
            6 => 'rails',
            7 => 'java',
            8 => 'tizen',
            9 => 'gettext',
            10 => 'ng-gettext',
            11 => 'xcode',
            12 => 'script',
          ),
        ),
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to filter assets. Negate tag names by prefixing with \'!\'.',
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
        'namespace' => 
        array (
          'description' => 'Override the project name for some language packs that use it as a key prefix',
          'type' => 'string',
          'location' => 'query',
        ),
        'fallback' => 
        array (
          'description' => 'Fallback locale for untranslated assets, specified as short code. e.g. `en` or `en_GB`',
          'type' => 'string',
          'location' => 'query',
        ),
        'order' => 
        array (
          'description' => 'Export translations according to asset order',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'created',
            1 => 'id',
          ),
        ),
        'status' => 
        array (
          'description' => 'Export only translations with a specific status or flag',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'translated',
            1 => 'untranslated',
            2 => 'incorrect',
            3 => 'provisional',
            4 => 'unapproved',
            5 => 'fuzzy',
            6 => 'incomplete',
            7 => 'rejected',
            8 => 'all',
          ),
        ),
        'printf' => 
        array (
          'description' => 'Force alternative "printf" style. <a href="/help/developers/printf">See string formatting</a>',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'php',
            1 => 'java',
            2 => 'objc',
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
            2 => 'ini',
            3 => 'js',
            4 => 'json',
            5 => 'mo',
            6 => 'php',
            7 => 'po',
            8 => 'pot',
            9 => 'plist',
            10 => 'bplist',
            11 => 'resx',
            12 => 'sql',
            13 => 'strings',
            14 => 'stringsdict',
            15 => 'tmx',
            16 => 'ts',
            17 => 'xlf',
            18 => 'xliff',
            19 => 'xml',
            20 => 'yml',
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
    'importProgress' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/import/progress/{id}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'AsyncProgress',
      'responseType' => 'model',
      'responseNotes' => '<p>
             If you specified <code>async=1</code> in your original import API request, you can check on its progress with this endpoint.
           </p>
           <p>
             The full URL including job identifier will have been provided in the Location header of your original import response
           </p>',
      'summary' => 'Check the progress of an asynchronous import',
      'parameters' => 
      array (
        'id' => 
        array (
          'required' => true,
          'description' => 'Job identifier from original import action',
          'type' => 'string',
          'location' => 'uri',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 422,
          'phrase' => 'Empty job id',
        ),
        1 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
        2 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
        ),
      ),
    ),
    'import' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/import/{ext}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Imported',
      'responseType' => 'model',
      'responseNotes' => '<p>The import API loads translations from various language pack formats into the currently authenticated project.</p>
           <p>Take note of how the <code>index</code> and <code>locale</code> parameters are used to describe how your file will be imported. 
              By leaving these fields empty Loco will try to guess your intentions, but it\'s advisable to specify all parameters if in any doubt.
              <a href="https://localise.biz/api#imports">See examples</a>.</p>
           <p>It\'s recommended that you set <code>async=1</code> for large files. This will cause the import to run in the background.
              Note that the response will differ from that given below. Instead you will receive a 201 message with a Location header 
              pointing to a progress checking endpoint.
           </p>',
      'summary' => 'Import assets and translations from a language pack file',
      'parameters' => 
      array (
        'ext' => 
        array (
          'required' => true,
          'description' => 'Import file type specified as a file extension',
          'type' => 'string',
          'location' => 'uri',
          'enum' => 
          array (
            0 => 'ini',
            1 => 'json',
            2 => 'mo',
            3 => 'php',
            4 => 'po',
            5 => 'pot',
            6 => 'plist',
            7 => 'bplist',
            8 => 'properties',
            9 => 'resx',
            10 => 'strings',
            11 => 'tmx',
            12 => 'ts',
            13 => 'xlf',
            14 => 'xml',
            15 => 'yml',
          ),
          'default' => 'json',
        ),
        'src' => 
        array (
          'required' => true,
          'description' => 'Raw source of file being imported',
          'type' => 'string',
          'location' => 'body',
          'default' => '{}',
        ),
        'index' => 
        array (
          'description' => 'Specify whether file indexes translations by asset ID or source texts',
          'type' => 'string',
          'location' => 'query',
          'enum' => 
          array (
            0 => 'id',
            1 => 'text',
          ),
        ),
        'locale' => 
        array (
          'description' => 'Specify target locale if importing translations',
          'type' => 'string',
          'location' => 'query',
        ),
        'ignore-new' => 
        array (
          'description' => 'Specify that new assets are NOT added to the project',
          'type' => 'boolean',
          'location' => 'query',
        ),
        'ignore-existing' => 
        array (
          'description' => 'Specify that existing assets encountered in the file are NOT updated',
          'type' => 'boolean',
          'location' => 'query',
        ),
        'delete-absent' => 
        array (
          'description' => 'Specify that project assets not found in the file are DELETED from the project',
          'type' => 'boolean',
          'location' => 'query',
        ),
        'tag-new' => 
        array (
          'description' => 'Tag any NEW assets added during the import with the given tags (comma separated)',
          'type' => 'string',
          'location' => 'query',
        ),
        'tag-all' => 
        array (
          'description' => 'Tag ALL assets in the file with the given tags (comma separated)',
          'type' => 'string',
          'location' => 'query',
        ),
        'untag-all' => 
        array (
          'description' => 'Remove existing tags from any assets matched in the imported file (comma separated)',
          'type' => 'string',
          'location' => 'query',
        ),
        'tag-updated' => 
        array (
          'description' => 'Tag existing assets that are MODIFIED by this import',
          'type' => 'string',
          'location' => 'query',
        ),
        'untag-updated' => 
        array (
          'description' => 'Remove existing tags from assets that are MODIFIED during import',
          'type' => 'string',
          'location' => 'query',
        ),
        'tag-absent' => 
        array (
          'description' => 'Tag existing assets in the project that are NOT found in the imported file',
          'type' => 'string',
          'location' => 'query',
        ),
        'untag-absent' => 
        array (
          'description' => 'Remove existing tags from assets NOT found in the imported file',
          'type' => 'string',
          'location' => 'query',
        ),
        'async' => 
        array (
          'description' => 'Specify that import should be done asynchronously',
          'type' => 'boolean',
          'location' => 'query',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 422,
          'phrase' => 'Empty or invalid source data',
        ),
        1 => 
        array (
          'code' => 201,
          'phrase' => 'Asynchronous import job created',
        ),
        2 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
        3 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
        ),
      ),
    ),
    'authVerify' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/auth/verify',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Creds',
      'responseType' => 'model',
      'responseNotes' => '<p>Loco API keys authenticate your user account for accessing a specific project.<br />
                This endpoint verifies an API key and returns the authenticated user, account and project.</p>
             <p>If you want to verify whether the key has write access, just send this endpoint a POST request instead. A read-only key will give 403 for any POST request.</p>',
      'summary' => 'Verify an API project key',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
    'getAssets' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/assets',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'summary' => 'List all translatable assets in your project',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'filter' => 
        array (
          'description' => 'Comma-separated list of tags to filter assets. Negate tag names by prefixing with \'!\'.',
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
      'uri' => '/api/assets',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => '<p>Adds a new asset to the currently authenticated project.</p>
           <p>If the asset is created successfully the response will be 201 (created).</p>
           <p>If you specify the asset ID and it clashes with an existing asset the response will be 409 (conflict).</p>
           <p>If another asset exists with the same name and you <strong>haven\'t specified the ID</strong>, a new asset will be created with a unique id.</p>
           <p>Creating a new asset also creates a translation in your source language with the value of the \'name\' parameter. Use the \'default\' parameter to control this behaviour.</p>',
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
          'default' => '',
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
          ),
          'default' => 'text',
        ),
        'context' => 
        array (
          'description' => 'Optional context descriptor',
          'type' => 'string',
          'location' => 'postField',
        ),
        'notes' => 
        array (
          'description' => 'Optional notes for translators',
          'type' => 'string',
          'location' => 'postField',
        ),
        'default' => 
        array (
          'description' => 'Status of the default source language translation. Specify \'untranslated\' to avoid creation',
          'type' => 'string',
          'location' => 'postField',
          'enum' => 
          array (
            0 => 'translated',
            1 => 'untranslated',
            2 => 'incorrect',
            3 => 'provisional',
            4 => 'unapproved',
            5 => 'fuzzy',
            6 => 'incomplete',
          ),
          'default' => 'translated',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 201,
          'phrase' => 'Asset created',
        ),
        1 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
        2 => 
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
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => 'Gets a single asset in currently authenticated project',
      'summary' => 'Get a project asset',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
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
    'patchAsset' => 
    array (
      'httpMethod' => 'PATCH',
      'uri' => '/api/assets/{id}.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => '<p>Modifies the properties of an asset in the currently authenticated project.</p>
           <p>The full, modified asset object is returned.</p>',
      'summary' => 'Modify a single asset',
      'parameters' => 
      array (
        'id_json' => 
        array (
          'description' => 'Machine friendly name',
          'type' => 'string',
          'location' => 'json',
          'sentAs' => 'id',
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
            3 => 'bin',
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
        'notes' => 
        array (
          'description' => 'Optional notes for translators',
          'type' => 'string',
          'location' => 'json',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
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
          'phrase' => 'Asset not in project',
        ),
      ),
    ),
    'deleteAsset' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/assets/{id}.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Deletes an asset from the currently authenticated project.</p>
           <p><strong>Warning</strong>: This will permanently delete all translations made of this asset across all locales</p>',
      'summary' => 'Delete an asset permanently',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
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
    'getAssetPlurals' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/assets/{id}/plurals',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => '<p>Lists all assets that are a plural form of the current asset.</p>
           <p>This list does <strong>not</strong> include the singular form itself.</p>',
      'summary' => 'Get plural forms of an asset',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
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
    'createPlural' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/assets/{id}/plurals',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => '<p>Creates a translatable asset that\'s a plural form of an existing asset.</p>
           <p>The singular form asset specified as <code>{id}</code> must already exist, but the plural form will created as a new asset.</p>
           <p>You can bind an existing asset as the new plural by specifying <code>{pid}</code>. In this case if <code>{name}</code> differs the asset will be renamed.</p>',
      'summary' => 'Add a new plural form of an existing asset',
      'parameters' => 
      array (
        'name' => 
        array (
          'required' => true,
          'description' => 'Source text for the plural form or just a name describing it',
          'type' => 'string',
          'location' => 'postField',
        ),
        'pid' => 
        array (
          'description' => 'Optional machine friendly ID if you want something specific, or converting an existing asset to a plural',
          'type' => 'string',
          'location' => 'postField',
          'default' => '',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
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
          'phrase' => 'Asset not in project',
        ),
      ),
    ),
    'unlinkPlural' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/assets/{id}/plurals/{pid}.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Reverts an asset from being a plural form to being a singular asset on its own.</p>
           <p>This action does <strong>not</strong> delete any assets.</p>',
      'summary' => 'Unlinks a plural form of an existing asset',
      'parameters' => 
      array (
        'pid' => 
        array (
          'required' => true,
          'description' => 'ID of asset to unlink',
          'type' => 'string',
          'location' => 'uri',
        ),
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
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
          'phrase' => 'Asset not in project',
        ),
      ),
    ),
    'tagAsset' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/assets/{id}/tags',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => '<p>Tags an asset with a new or existing term. If the tag doesn\'t exist it will be created.</p>',
      'summary' => 'Tag an asset',
      'parameters' => 
      array (
        'name' => 
        array (
          'required' => true,
          'description' => 'Name of new or existing tag',
          'type' => 'string',
          'location' => 'postField',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
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
    'untagAsset' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/assets/{id}/tags/{tag}.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Removes a single tag from the given asset.</p>',
      'summary' => 'Untag an asset',
      'parameters' => 
      array (
        'tag' => 
        array (
          'required' => true,
          'description' => 'Term to remove from asset\'s tags',
          'type' => 'string',
          'location' => 'uri',
        ),
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
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
    'getLocales' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/locales',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => 'Lists all locales in currently authenticated project. Your native/source language will always be the first in the list',
      'summary' => 'List all locales in your project',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
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
      'uri' => '/api/locales',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Locale',
      'responseType' => 'model',
      'responseNotes' => '<p>Adds a new locale to the currently authenticated project.</p>
           <p>If the locale is created successfully the response will be 201 (created).</p>
           <p>If the locale already exists the response will be 409 (conflict).</p>',
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
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
      ),
      'errorResponses' => 
      array (
        0 => 
        array (
          'code' => 409,
          'phrase' => 'Locale already exists',
        ),
        1 => 
        array (
          'code' => 201,
          'phrase' => 'Locale created',
        ),
        2 => 
        array (
          'code' => 401,
          'phrase' => 'Invalid API key',
        ),
        3 => 
        array (
          'code' => 403,
          'phrase' => 'Insufficient privileges',
        ),
      ),
    ),
    'getLocale' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/locales/{locale}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Locale',
      'responseType' => 'model',
      'responseNotes' => 'Gets a single locale in currently authenticated project',
      'summary' => 'Get a project locale',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
      'uri' => '/api/locales/{locale}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
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
        'name' => 
        array (
          'description' => 'Friendly display name',
          'type' => 'string',
          'location' => 'json',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
      'uri' => '/api/locales/{locale}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Delete a locale from currently authenticated project.</p>
           <p><strong>Warning</strong>: This will permanently delete any translations made in the specified locale across your project</p>
           <p>Note that you cannot delete your native/source locale.</p>',
      'summary' => 'Delete a project locale',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
    'getTranslations' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/translations/{id}.json',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'responseNotes' => '<p>Gets all translations of an asset across the currently authenticated project\'s locales.</p>
           <p>Locales not yet translated are included, but their <code>translated</code> field will be set to <code>false</code>.</p>',
      'summary' => 'Get all translations of an asset',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
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
    'getTranslation' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/translations/{id}/{locale}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Translation',
      'responseType' => 'model',
      'responseNotes' => '<p>Gets a single translation in currently authenticated project.</p>
           <p>Translations implicitly exist as long as the asset and locale are in your project.</p>
           <p>Translations marked as complete have the <code>translated</code> field set to <code>true</code>.</p>',
      'summary' => 'Get a single translation',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
          'code' => 404,
          'phrase' => 'Locale not in project',
        ),
      ),
    ),
    'translate' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/translations/{id}/{locale}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Translation',
      'responseType' => 'model',
      'responseNotes' => '<p>Translates a single asset in a single locale in the currently authenticated project.</p>
           <p>If the asset is already translated, a new revision will be added and the <code>revision</code> field incremented.</p>
           <p>If the asset is untranslated the locale must have already been added to the project.</p>',
      'summary' => 'Add a new translation in a given locale',
      'parameters' => 
      array (
        'translation' => 
        array (
          'description' => 'Raw value of new translation. Leaving empty puts a blank translation.',
          'type' => 'string',
          'location' => 'body',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
    'untranslate' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/translations/{id}/{locale}',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Erases translation data of a localised asset in the currently authenticated project.</p>
           <p><strong>Warning</strong>: Erasing is not the same as setting an empty translation. 
              This operation clears the asset\'s translation history and user comments for the given locale.</p>',
      'summary' => 'Erase translation data in a single locale',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
          'code' => 404,
          'phrase' => 'Asset not translated in this locale',
        ),
      ),
    ),
    'flagTranslation' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/translations/{id}/{locale}/flag',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Flag a single translation as being incomplete or in error for the given locale.</p>
           <p>Flagged translations reduce your project completeness.</p>',
      'summary' => 'Flag a translation as incomplete',
      'parameters' => 
      array (
        'flag' => 
        array (
          'required' => true,
          'description' => 'Flag to set',
          'type' => 'string',
          'location' => 'postField',
          'enum' => 
          array (
            0 => 'incorrect',
            1 => 'provisional',
            2 => 'unapproved',
            3 => 'fuzzy',
            4 => 'incomplete',
          ),
          'default' => 'fuzzy',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
    'unflagTranslation' => 
    array (
      'httpMethod' => 'DELETE',
      'uri' => '/api/translations/{id}/{locale}/flag',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Removes current flag from a translation marked as incomplete or in error.</p>
           <p>It\'s not necessary to specify which flag to remove, because there can be only one.</p>',
      'summary' => 'Clear flag from a translation',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key - preferably sent in request header as `Authorization: Loco <key>`',
          'type' => 'string',
          'location' => 'query',
        ),
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'uri',
        ),
        'locale' => 
        array (
          'required' => true,
          'description' => 'Short code of project locale, e.g. `fr` or `fr_CH`',
          'type' => 'string',
          'location' => 'uri',
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
    'ping' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/ping',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
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
      'uri' => '/api/ping/not-found',
      'class' => '\\Loco\\Http\\Command\\LocoCommand',
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
    'TagPatch' => 
    array (
      'description' => 'Patch structure for modifying tags',
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'name' => 
        array (
          'description' => 'Display name of tag',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'AssetProgress' => 
    array (
      'description' => 'Statistical summary of translation progress for an individual locale',
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'translated' => 
        array (
          'required' => true,
          'description' => 'Number of locales for which a translation exists (including those flagged)',
          'type' => 'integer',
          'location' => 'json',
        ),
        'untranslated' => 
        array (
          'required' => true,
          'description' => 'Number of locales that do not yet have a translation of this asset',
          'type' => 'integer',
          'location' => 'json',
        ),
        'flagged' => 
        array (
          'required' => true,
          'description' => 'Number of locales whose translations are flagged as requiring attention',
          'type' => 'integer',
          'location' => 'json',
        ),
      ),
    ),
    'anon_type_string' => 
    array (
      'type' => 'string',
    ),
    'PluralRules' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'length' => 
        array (
          'required' => true,
          'description' => 'Number of forms including singular',
          'type' => 'integer',
          'location' => 'json',
          'minimum' => 1,
          'maximum' => 6,
        ),
        'equation' => 
        array (
          'required' => true,
          'description' => 'Equation for calculating offset in forms. The formula takes a multiplier <code>(n)</code> to yield a plural form offset. <code>( 0 <= offset < length )</code>.',
          'type' => 'string',
          'location' => 'json',
        ),
        'forms' => 
        array (
          'required' => true,
          'description' => 'Plural form names. See <a href="http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules">Unicode tr35</a>.',
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
      ),
    ),
    'LocaleProgress' => 
    array (
      'description' => 'Statistical summary of translation progress for an individual locale',
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'translated' => 
        array (
          'required' => true,
          'description' => 'Number of assets for which a translation exists (including those flagged)',
          'type' => 'integer',
          'location' => 'json',
        ),
        'untranslated' => 
        array (
          'required' => true,
          'description' => 'Number of assets that are not yet translated to this language',
          'type' => 'integer',
          'location' => 'json',
        ),
        'flagged' => 
        array (
          'required' => true,
          'description' => 'Number of translations that are flagged as requiring attention',
          'type' => 'integer',
          'location' => 'json',
        ),
      ),
    ),
    'AsyncProgress' => 
    array (
      'description' => 'Job progress for checking asynchronous operations',
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'progress' => 
        array (
          'required' => true,
          'description' => 'Percentage progress through asynchronous operation',
          'type' => 'integer',
          'location' => 'json',
        ),
        'error' => 
        array (
          'description' => 'Description of any error that prevented job from finishing',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'Asset' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'id' => 
        array (
          'required' => true,
          'description' => 'Machine friendly name',
          'type' => 'string',
          'location' => 'json',
        ),
        'type' => 
        array (
          'required' => true,
          'description' => 'Broad content type, defaults to plain text',
          'type' => 'string',
          'location' => 'json',
          'enum' => 
          array (
            0 => 'text',
            1 => 'html',
            2 => 'image',
            3 => 'bin',
          ),
        ),
        'name' => 
        array (
          'required' => true,
          'description' => 'Human friendly description',
          'type' => 'string',
          'location' => 'json',
        ),
        'context' => 
        array (
          'required' => true,
          'description' => 'Optional context descriptor',
          'type' => 'string',
          'location' => 'json',
        ),
        'notes' => 
        array (
          'required' => true,
          'description' => 'Optional notes for translators',
          'type' => 'string',
          'location' => 'json',
        ),
        'modified' => 
        array (
          'required' => true,
          'description' => 'Time last modified in UTC',
          'type' => 'string',
          'format' => 'date-time',
          'location' => 'json',
        ),
        'plurals' => 
        array (
          'required' => true,
          'description' => 'Number of associated plural forms',
          'type' => 'integer',
          'location' => 'json',
        ),
        'tags' => 
        array (
          'required' => true,
          'description' => 'List of terms asset is tagged with',
          'type' => 'array',
          'location' => 'json',
          'items' => 
          array (
            'type' => 'string',
          ),
        ),
        'progress' => 
        array (
          'description' => 'Statistical summary of translation progress for an individual locale',
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'translated' => 
            array (
              'required' => true,
              'description' => 'Number of locales for which a translation exists (including those flagged)',
              'type' => 'integer',
              'location' => 'json',
            ),
            'untranslated' => 
            array (
              'required' => true,
              'description' => 'Number of locales that do not yet have a translation of this asset',
              'type' => 'integer',
              'location' => 'json',
            ),
            'flagged' => 
            array (
              'required' => true,
              'description' => 'Number of locales whose translations are flagged as requiring attention',
              'type' => 'integer',
              'location' => 'json',
            ),
          ),
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
          'required' => true,
          'description' => 'Locale short code, or language tag',
          'type' => 'string',
          'location' => 'json',
        ),
        'name' => 
        array (
          'required' => true,
          'description' => 'Friendly display name',
          'type' => 'string',
          'location' => 'json',
        ),
        'native' => 
        array (
          'required' => true,
          'description' => 'Whether the source locale of project',
          'type' => 'boolean',
          'location' => 'json',
        ),
        'plurals' => 
        array (
          'required' => true,
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'length' => 
            array (
              'required' => true,
              'description' => 'Number of forms including singular',
              'type' => 'integer',
              'location' => 'json',
              'minimum' => 1,
              'maximum' => 6,
            ),
            'equation' => 
            array (
              'required' => true,
              'description' => 'Equation for calculating offset in forms. The formula takes a multiplier <code>(n)</code> to yield a plural form offset. <code>( 0 <= offset < length )</code>.',
              'type' => 'string',
              'location' => 'json',
            ),
            'forms' => 
            array (
              'required' => true,
              'description' => 'Plural form names. See <a href="http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules">Unicode tr35</a>.',
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
          ),
        ),
        'progress' => 
        array (
          'required' => true,
          'description' => 'Statistical summary of translation progress for an individual locale',
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'translated' => 
            array (
              'required' => true,
              'description' => 'Number of assets for which a translation exists (including those flagged)',
              'type' => 'integer',
              'location' => 'json',
            ),
            'untranslated' => 
            array (
              'required' => true,
              'description' => 'Number of assets that are not yet translated to this language',
              'type' => 'integer',
              'location' => 'json',
            ),
            'flagged' => 
            array (
              'required' => true,
              'description' => 'Number of translations that are flagged as requiring attention',
              'type' => 'integer',
              'location' => 'json',
            ),
          ),
        ),
      ),
    ),
    'Imported' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'assets' => 
        array (
          'description' => 'Assets present in imported data',
          'type' => 'array',
          'location' => 'json',
          'items' => 
          array (
            'type' => 'object',
            'additionalProperties' => false,
            'properties' => 
            array (
              'id' => 
              array (
                'required' => true,
                'description' => 'Machine friendly name',
                'type' => 'string',
                'location' => 'json',
              ),
              'type' => 
              array (
                'required' => true,
                'description' => 'Broad content type, defaults to plain text',
                'type' => 'string',
                'location' => 'json',
                'enum' => 
                array (
                  0 => 'text',
                  1 => 'html',
                  2 => 'image',
                  3 => 'bin',
                ),
              ),
              'name' => 
              array (
                'required' => true,
                'description' => 'Human friendly description',
                'type' => 'string',
                'location' => 'json',
              ),
              'context' => 
              array (
                'required' => true,
                'description' => 'Optional context descriptor',
                'type' => 'string',
                'location' => 'json',
              ),
              'notes' => 
              array (
                'required' => true,
                'description' => 'Optional notes for translators',
                'type' => 'string',
                'location' => 'json',
              ),
              'modified' => 
              array (
                'required' => true,
                'description' => 'Time last modified in UTC',
                'type' => 'string',
                'format' => 'date-time',
                'location' => 'json',
              ),
              'plurals' => 
              array (
                'required' => true,
                'description' => 'Number of associated plural forms',
                'type' => 'integer',
                'location' => 'json',
              ),
              'tags' => 
              array (
                'required' => true,
                'description' => 'List of terms asset is tagged with',
                'type' => 'array',
                'location' => 'json',
                'items' => 
                array (
                  'type' => 'string',
                ),
              ),
              'progress' => 
              array (
                'description' => 'Statistical summary of translation progress for an individual locale',
                'type' => 'object',
                'location' => 'json',
                'additionalProperties' => false,
                'properties' => 
                array (
                  'translated' => 
                  array (
                    'required' => true,
                    'description' => 'Number of locales for which a translation exists (including those flagged)',
                    'type' => 'integer',
                    'location' => 'json',
                  ),
                  'untranslated' => 
                  array (
                    'required' => true,
                    'description' => 'Number of locales that do not yet have a translation of this asset',
                    'type' => 'integer',
                    'location' => 'json',
                  ),
                  'flagged' => 
                  array (
                    'required' => true,
                    'description' => 'Number of locales whose translations are flagged as requiring attention',
                    'type' => 'integer',
                    'location' => 'json',
                  ),
                ),
              ),
            ),
          ),
        ),
        'locales' => 
        array (
          'description' => 'Locales present in imported data',
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
                'required' => true,
                'description' => 'Locale short code, or language tag',
                'type' => 'string',
                'location' => 'json',
              ),
              'name' => 
              array (
                'required' => true,
                'description' => 'Friendly display name',
                'type' => 'string',
                'location' => 'json',
              ),
              'native' => 
              array (
                'required' => true,
                'description' => 'Whether the source locale of project',
                'type' => 'boolean',
                'location' => 'json',
              ),
              'plurals' => 
              array (
                'required' => true,
                'type' => 'object',
                'location' => 'json',
                'additionalProperties' => false,
                'properties' => 
                array (
                  'length' => 
                  array (
                    'required' => true,
                    'description' => 'Number of forms including singular',
                    'type' => 'integer',
                    'location' => 'json',
                    'minimum' => 1,
                    'maximum' => 6,
                  ),
                  'equation' => 
                  array (
                    'required' => true,
                    'description' => 'Equation for calculating offset in forms. The formula takes a multiplier <code>(n)</code> to yield a plural form offset. <code>( 0 <= offset < length )</code>.',
                    'type' => 'string',
                    'location' => 'json',
                  ),
                  'forms' => 
                  array (
                    'required' => true,
                    'description' => 'Plural form names. See <a href="http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules">Unicode tr35</a>.',
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
                ),
              ),
              'progress' => 
              array (
                'required' => true,
                'description' => 'Statistical summary of translation progress for an individual locale',
                'type' => 'object',
                'location' => 'json',
                'additionalProperties' => false,
                'properties' => 
                array (
                  'translated' => 
                  array (
                    'required' => true,
                    'description' => 'Number of assets for which a translation exists (including those flagged)',
                    'type' => 'integer',
                    'location' => 'json',
                  ),
                  'untranslated' => 
                  array (
                    'required' => true,
                    'description' => 'Number of assets that are not yet translated to this language',
                    'type' => 'integer',
                    'location' => 'json',
                  ),
                  'flagged' => 
                  array (
                    'required' => true,
                    'description' => 'Number of translations that are flagged as requiring attention',
                    'type' => 'integer',
                    'location' => 'json',
                  ),
                ),
              ),
            ),
          ),
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
          'required' => true,
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
          'description' => 'Contact email address if you have permission to see it',
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
              'required' => true,
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
              'description' => 'Contact email address if you have permission to see it',
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
    'AssetPatch' => 
    array (
      'description' => 'Patch structure for modifying assets',
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
            3 => 'bin',
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
        'notes' => 
        array (
          'description' => 'Optional notes for translators',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'LocalePatch' => 
    array (
      'description' => 'Patch structure for modifying locales',
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
        'name' => 
        array (
          'description' => 'Friendly display name',
          'type' => 'string',
          'location' => 'json',
        ),
      ),
    ),
    'PluralTranslation' => 
    array (
      'description' => 'Base class containing subset of the fields of LocoApiTranslationModel Doesn\'t need $plurals or $locale',
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'json',
        ),
        'type' => 
        array (
          'required' => true,
          'description' => 'Specific media type, e.g. text/plain, image/jpeg',
          'type' => 'string',
          'location' => 'json',
        ),
        'translated' => 
        array (
          'required' => true,
          'description' => 'Whether asset is translated and contributing to project completion',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
        ),
        'flagged' => 
        array (
          'required' => true,
          'description' => 'Whether translation is flagged by user action',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
        ),
        'status' => 
        array (
          'description' => 'Status of translation as string compatible with export status parameter',
          'type' => 'string',
          'location' => 'json',
        ),
        'translation' => 
        array (
          'required' => true,
          'description' => 'Translated text in specified locale',
          'type' => 'string',
          'location' => 'json',
        ),
        'revision' => 
        array (
          'required' => true,
          'description' => 'Number of edits made, zero if never translated',
          'type' => 'integer',
          'location' => 'json',
          'default' => 0,
        ),
        'comments' => 
        array (
          'required' => true,
          'description' => 'Number of comments available',
          'type' => 'integer',
          'location' => 'json',
        ),
        'modified' => 
        array (
          'description' => 'Time last modified in UTC, null if translation doesn\'t exist',
          'type' => 'string',
          'format' => 'date-time',
          'location' => 'json',
        ),
        'author' => 
        array (
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'id' => 
            array (
              'required' => true,
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
              'description' => 'Contact email address if you have permission to see it',
              'type' => 'string',
              'location' => 'json',
            ),
          ),
        ),
        'flagger' => 
        array (
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'id' => 
            array (
              'required' => true,
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
              'description' => 'Contact email address if you have permission to see it',
              'type' => 'string',
              'location' => 'json',
            ),
          ),
        ),
      ),
    ),
    'Translation' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'id' => 
        array (
          'required' => true,
          'description' => 'Asset ID',
          'type' => 'string',
          'location' => 'json',
        ),
        'type' => 
        array (
          'required' => true,
          'description' => 'Specific media type, e.g. text/plain, image/jpeg',
          'type' => 'string',
          'location' => 'json',
        ),
        'translated' => 
        array (
          'required' => true,
          'description' => 'Whether the translation exists (even if flagged)',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
        ),
        'flagged' => 
        array (
          'required' => true,
          'description' => 'Whether translation is flagged by user action',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
        ),
        'status' => 
        array (
          'description' => 'Status of translation as string compatible with export status parameter',
          'type' => 'string',
          'location' => 'json',
        ),
        'translation' => 
        array (
          'required' => true,
          'description' => 'Translated text in specified locale',
          'type' => 'string',
          'location' => 'json',
        ),
        'revision' => 
        array (
          'required' => true,
          'description' => 'Number of edits made, zero if never translated',
          'type' => 'integer',
          'location' => 'json',
          'default' => 0,
        ),
        'comments' => 
        array (
          'required' => true,
          'description' => 'Number of comments available',
          'type' => 'integer',
          'location' => 'json',
        ),
        'modified' => 
        array (
          'description' => 'Time last modified in UTC, null if translation doesn\'t exist',
          'type' => 'string',
          'format' => 'date-time',
          'location' => 'json',
        ),
        'author' => 
        array (
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'id' => 
            array (
              'required' => true,
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
              'description' => 'Contact email address if you have permission to see it',
              'type' => 'string',
              'location' => 'json',
            ),
          ),
        ),
        'flagger' => 
        array (
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'id' => 
            array (
              'required' => true,
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
              'description' => 'Contact email address if you have permission to see it',
              'type' => 'string',
              'location' => 'json',
            ),
          ),
        ),
        'locale' => 
        array (
          'required' => true,
          'type' => 'object',
          'location' => 'json',
          'additionalProperties' => false,
          'properties' => 
          array (
            'code' => 
            array (
              'required' => true,
              'description' => 'Locale short code, or language tag',
              'type' => 'string',
              'location' => 'json',
            ),
            'name' => 
            array (
              'required' => true,
              'description' => 'Friendly display name',
              'type' => 'string',
              'location' => 'json',
            ),
            'native' => 
            array (
              'required' => true,
              'description' => 'Whether the source locale of project',
              'type' => 'boolean',
              'location' => 'json',
            ),
            'plurals' => 
            array (
              'required' => true,
              'type' => 'object',
              'location' => 'json',
              'additionalProperties' => false,
              'properties' => 
              array (
                'length' => 
                array (
                  'required' => true,
                  'description' => 'Number of forms including singular',
                  'type' => 'integer',
                  'location' => 'json',
                  'minimum' => 1,
                  'maximum' => 6,
                ),
                'equation' => 
                array (
                  'required' => true,
                  'description' => 'Equation for calculating offset in forms. The formula takes a multiplier <code>(n)</code> to yield a plural form offset. <code>( 0 <= offset < length )</code>.',
                  'type' => 'string',
                  'location' => 'json',
                ),
                'forms' => 
                array (
                  'required' => true,
                  'description' => 'Plural form names. See <a href="http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules">Unicode tr35</a>.',
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
              ),
            ),
            'progress' => 
            array (
              'required' => true,
              'description' => 'Statistical summary of translation progress for an individual locale',
              'type' => 'object',
              'location' => 'json',
              'additionalProperties' => false,
              'properties' => 
              array (
                'translated' => 
                array (
                  'required' => true,
                  'description' => 'Number of assets for which a translation exists (including those flagged)',
                  'type' => 'integer',
                  'location' => 'json',
                ),
                'untranslated' => 
                array (
                  'required' => true,
                  'description' => 'Number of assets that are not yet translated to this language',
                  'type' => 'integer',
                  'location' => 'json',
                ),
                'flagged' => 
                array (
                  'required' => true,
                  'description' => 'Number of translations that are flagged as requiring attention',
                  'type' => 'integer',
                  'location' => 'json',
                ),
              ),
            ),
          ),
        ),
        'plurals' => 
        array (
          'required' => true,
          'description' => 'Plural forms of this translation',
          'type' => 'array',
          'location' => 'json',
          'items' => 
          array (
            'description' => 'Base class containing subset of the fields of LocoApiTranslationModel Doesn\'t need $plurals or $locale',
            'type' => 'object',
            'additionalProperties' => false,
            'properties' => 
            array (
              'id' => 
              array (
                'required' => true,
                'description' => 'Asset ID',
                'type' => 'string',
                'location' => 'json',
              ),
              'type' => 
              array (
                'required' => true,
                'description' => 'Specific media type, e.g. text/plain, image/jpeg',
                'type' => 'string',
                'location' => 'json',
              ),
              'translated' => 
              array (
                'required' => true,
                'description' => 'Whether asset is translated and contributing to project completion',
                'type' => 'boolean',
                'location' => 'json',
                'default' => false,
              ),
              'flagged' => 
              array (
                'required' => true,
                'description' => 'Whether translation is flagged by user action',
                'type' => 'boolean',
                'location' => 'json',
                'default' => false,
              ),
              'status' => 
              array (
                'description' => 'Status of translation as string compatible with export status parameter',
                'type' => 'string',
                'location' => 'json',
              ),
              'translation' => 
              array (
                'required' => true,
                'description' => 'Translated text in specified locale',
                'type' => 'string',
                'location' => 'json',
              ),
              'revision' => 
              array (
                'required' => true,
                'description' => 'Number of edits made, zero if never translated',
                'type' => 'integer',
                'location' => 'json',
                'default' => 0,
              ),
              'comments' => 
              array (
                'required' => true,
                'description' => 'Number of comments available',
                'type' => 'integer',
                'location' => 'json',
              ),
              'modified' => 
              array (
                'description' => 'Time last modified in UTC, null if translation doesn\'t exist',
                'type' => 'string',
                'format' => 'date-time',
                'location' => 'json',
              ),
              'author' => 
              array (
                'type' => 'object',
                'location' => 'json',
                'additionalProperties' => false,
                'properties' => 
                array (
                  'id' => 
                  array (
                    'required' => true,
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
                    'description' => 'Contact email address if you have permission to see it',
                    'type' => 'string',
                    'location' => 'json',
                  ),
                ),
              ),
              'flagger' => 
              array (
                'type' => 'object',
                'location' => 'json',
                'additionalProperties' => false,
                'properties' => 
                array (
                  'id' => 
                  array (
                    'required' => true,
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
                    'description' => 'Contact email address if you have permission to see it',
                    'type' => 'string',
                    'location' => 'json',
                  ),
                ),
              ),
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
        'build' => 
        array (
          'description' => 'Current build',
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
