<?php
/**
 * Auto-generated with Swizzle at 2014-09-13 16:25:18 +0100
 */
return array (
  'name' => 'Loco',
  'apiVersion' => '1.0.8',
  'baseUrl' => 'https://localise.biz/',
  'description' => 'Loco REST API',
  'operations' => 
  array (
    'import' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/import/{ext}',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Imported',
      'responseType' => 'model',
      'responseNotes' => '<p>The import API loads translations from various language pack formats into the currently authenticated project.</p>
           <p>Take note of how the <code>index</code> and <code>locale</code> parameters are used to describe how your file will be imported. 
              By leaving these fields empty Loco will try to guess your intentions, but it\'s advisable to specify all parameters if in any doubt.
              <a href="https://localise.biz/api#imports">See examples</a>.</p>',
      'summary' => 'Import from language pack files',
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
          'code' => 422,
          'phrase' => 'Empty or invalid source data',
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
    'exportAll' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/export/all.{ext}',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
            6 => 'rails',
            7 => 'java',
            8 => 'tizen',
            9 => 'gettext',
            10 => 'ng-gettext',
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
            14 => 'tmx',
            15 => 'ts',
            16 => 'xlf',
            17 => 'xml',
            18 => 'yml',
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
      'responseNotes' => '<p>Export translations from your project to a locale-specific language pack.</p>
           <p>Various export file types are supported with format variations for some types.
              <a href="https://localise.biz/api#formats">See the full list of supported export formats</a>.</p>',
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
            6 => 'rails',
            7 => 'java',
            8 => 'tizen',
            9 => 'gettext',
            10 => 'ng-gettext',
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
            14 => 'tmx',
            15 => 'ts',
            16 => 'xlf',
            17 => 'xml',
            18 => 'yml',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
            6 => 'rails',
            7 => 'java',
            8 => 'tizen',
            9 => 'gettext',
            10 => 'ng-gettext',
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
            14 => 'tmx',
            15 => 'ts',
            16 => 'xlf',
            17 => 'xml',
            18 => 'yml',
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
    'authVerify' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/auth/verify',
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
    'getAssets' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/assets',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'array',
      'responseType' => 'primitive',
      'summary' => 'List all translatable assets in your project',
      'parameters' => 
      array (
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => '<p>Adds a new asset to the currently authenticated project.</p>
           <p>If the asset is created successfully the response will be 201 (created).</p>
           <p>If you specify the asset ID and it clashes with an existing asset the response will be 409 (conflict).</p>
           <p>If another asset exists with the same name and you <strong>haven\'t specified the ID</strong>, a new asset will be created with a unique id.</p>',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Asset',
      'responseType' => 'model',
      'responseNotes' => 'Gets a single asset in currently authenticated project',
      'summary' => 'Get a project asset',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
        'notes' => 
        array (
          'description' => 'Optional notes for translators',
          'type' => 'string',
          'location' => 'json',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'phrase' => 'Asset not in project',
        ),
      ),
    ),
    'tagAsset' => 
    array (
      'httpMethod' => 'POST',
      'uri' => '/api/assets/{id}/tags',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
    'getLocales' => 
    array (
      'httpMethod' => 'GET',
      'uri' => '/api/locales',
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
      'uri' => '/api/locales',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Locale',
      'responseType' => 'model',
      'responseNotes' => 'Gets a single locale in currently authenticated project',
      'summary' => 'Get a project locale',
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
        'name' => 
        array (
          'description' => 'Friendly display name',
          'type' => 'string',
          'location' => 'json',
        ),
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Translation',
      'responseType' => 'model',
      'responseNotes' => '<p>Translates a single asset in a single locale in the currently authenticated project.</p>
           <p>If the asset is already translated, a new revision will be added and the <code>revision</code> field incremented.</p>
           <p>If the asset is untranslated the locale must have already been added to the project.</p>
           <p>Binary file uploads are not yet supported, but will be soon.</p>',
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
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Success',
      'responseType' => 'model',
      'responseNotes' => '<p>Deletes a single translation of an asset in currently authenticated project.</p>
           <p><strong>Warning</strong>: Untranslating is not the same as setting an empty translation. 
              This operation clears the asset\'s translation history and user comments for the given locale.</p>',
      'summary' => 'Untranslate an asset in a single locale',
      'parameters' => 
      array (
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
            0 => 'fuzzy',
            1 => 'error',
            2 => 'review',
            3 => 'pending',
          ),
          'default' => 'fuzzy',
        ),
        'key' => 
        array (
          'required' => true,
          'description' => 'Project API key',
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
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
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
          'description' => 'Project API key',
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
      'uri' => '/api/ping/not-found',
      'class' => 'Guzzle\\Service\\Command\\OperationCommand',
      'responseClass' => 'Error',
      'responseType' => 'model',
      'summary' => 'Get a test 404 response',
      'parameters' => 
      array (
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
            2 => 'ini',
            3 => 'js',
            4 => 'json',
            5 => 'mo',
            6 => 'php',
            7 => 'po',
            8 => 'pot',
            9 => 'properties',
            10 => 'resx',
            11 => 'sql',
            12 => 'strings',
            13 => 'tmx',
            14 => 'ts',
            15 => 'xlf',
            16 => 'xml',
            17 => 'yml',
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
            7 => 'rails',
            8 => 'java',
            9 => 'tizen',
            10 => 'gettext',
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
        'index' => 
        array (
          'description' => 'Override default lookup key in exported file. Leave blank for auto.',
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
  ),
  'models' => 
  array (
    'anon_type_string' => 
    array (
      'type' => 'string',
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
            3 => 'audio',
            4 => 'video',
            5 => 'bin',
          ),
        ),
        'name' => 
        array (
          'required' => true,
          'description' => 'Human friendly name',
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
        'translated' => 
        array (
          'required' => true,
          'description' => 'Number of locales asset is translated into',
          'type' => 'integer',
          'location' => 'json',
        ),
        'untranslated' => 
        array (
          'required' => true,
          'description' => 'Number of locales left to translate',
          'type' => 'integer',
          'location' => 'json',
        ),
        'incomplete' => 
        array (
          'description' => 'Number of translations that are flagged as incomplete',
          'type' => 'integer',
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
      ),
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
    'Locale' => 
    array (
      'type' => 'object',
      'additionalProperties' => false,
      'properties' => 
      array (
        'code' => 
        array (
          'required' => true,
          'description' => 'Locale short code',
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
                  3 => 'audio',
                  4 => 'video',
                  5 => 'bin',
                ),
              ),
              'name' => 
              array (
                'required' => true,
                'description' => 'Human friendly name',
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
              'translated' => 
              array (
                'required' => true,
                'description' => 'Number of locales asset is translated into',
                'type' => 'integer',
                'location' => 'json',
              ),
              'untranslated' => 
              array (
                'required' => true,
                'description' => 'Number of locales left to translate',
                'type' => 'integer',
                'location' => 'json',
              ),
              'incomplete' => 
              array (
                'description' => 'Number of translations that are flagged as incomplete',
                'type' => 'integer',
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
                'description' => 'Locale short code',
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
        'notes' => 
        array (
          'description' => 'Optional notes for translators',
          'type' => 'string',
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
          'description' => 'Whether plural translation exists, even if marked intentionally blank',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
        ),
        'flagged' => 
        array (
          'required' => true,
          'description' => 'Whether translation is incomplete due to an issue requiring attention',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
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
          'description' => 'Number of edits made, zero if not translated',
          'type' => 'integer',
          'location' => 'json',
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
          'description' => 'Time last modified in UTC, null if not translated',
          'type' => 'string',
          'format' => 'date-time',
          'location' => 'json',
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
          'description' => 'Whether this translation exists, even if marked intentionally blank',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
        ),
        'flagged' => 
        array (
          'required' => true,
          'description' => 'Whether translation is incomplete due to an issue requiring attention',
          'type' => 'boolean',
          'location' => 'json',
          'default' => false,
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
          'description' => 'Number of edits made, zero if not translated',
          'type' => 'integer',
          'location' => 'json',
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
              'description' => 'Locale short code',
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
                'description' => 'Whether plural translation exists, even if marked intentionally blank',
                'type' => 'boolean',
                'location' => 'json',
                'default' => false,
              ),
              'flagged' => 
              array (
                'required' => true,
                'description' => 'Whether translation is incomplete due to an issue requiring attention',
                'type' => 'boolean',
                'location' => 'json',
                'default' => false,
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
                'description' => 'Number of edits made, zero if not translated',
                'type' => 'integer',
                'location' => 'json',
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
                'description' => 'Time last modified in UTC, null if not translated',
                'type' => 'string',
                'format' => 'date-time',
                'location' => 'json',
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
