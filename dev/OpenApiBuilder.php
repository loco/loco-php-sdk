<?php

namespace Loco\Dev;

/**
 * Parses an OpenAPI v3 spec and converts it to a Guzzle service description.
 * Replaces the Swagger 1.2-based Swizzle library for Loco API spec parsing.
 */
class OpenApiBuilder
{
    private string $name;
    private ?string $description;
    private string $apiVersion = '';
    private string $baseUri = '';
    private string $pathPrefix = '';
    private array $operations = [];
    private array $models = [];
    private array $responseClasses = [];
    private array $exposedModels = [];
    private $verboseStream = null;
    private array $spec = [];
    private string $specUrl = '';

    public function __construct(string $name, ?string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function verbose($resource): self
    {
        $this->verboseStream = $resource;
        return $this;
    }

    public function registerResponseClass(string $name, string $class): self
    {
        $this->responseClasses[$name] = $class;
        return $this;
    }

    public function getResponseClass(string $name): string
    {
        return $this->responseClasses[$name] ?? 'GuzzleHttp\\Command\\Result';
    }

    /**
     * @param string $specUrl
     * @param bool|string $sslVerify true to use system defaults, false to disable, or a CA bundle path
     */
    public function build(string $specUrl, string|bool $sslVerify = true): self
    {
        $this->specUrl = $specUrl;
        $this->debug('Fetching spec from %s', $specUrl);
        $sslOpts = is_string($sslVerify)
            ? ['cafile' => $sslVerify]
            : ['verify_peer' => (bool)$sslVerify, 'verify_peer_name' => (bool)$sslVerify];
        $ctx = stream_context_create(['ssl' => $sslOpts]);
        $json = file_get_contents($specUrl, false, $ctx);
        if ($json === false) {
            throw new \RuntimeException('Failed to fetch spec from ' . $specUrl);
        }
        $this->spec = json_decode($json, true);
        if (!isset($this->spec['openapi']) || version_compare($this->spec['openapi'], '3.0', '<')) {
            throw new \RuntimeException('Expected OpenAPI 3.x spec, got: ' . ($this->spec['openapi'] ?? 'unknown'));
        }
        $this->processSpec();
        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'apiVersion' => $this->apiVersion,
            'baseUri' => $this->baseUri,
            'description' => $this->description,
            'operations' => $this->operations,
            'models' => array_intersect_key($this->models, $this->exposedModels),
        ]);
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    private function debug(string $message, ...$args): void
    {
        if ($this->verboseStream !== null) {
            if ($args) {
                $message = sprintf($message, ...$args);
            }
            fwrite($this->verboseStream, $message . "\n");
        }
    }

    private function processSpec(): void
    {
        $spec = $this->spec;

        $this->apiVersion = $spec['info']['version'] ?? '';

        // Domain comes from the configured spec URL, path prefix from the spec's server entry
        $specParsed = parse_url($this->specUrl);
        $this->baseUri = ($specParsed['scheme'] ?? 'https') . '://' . ($specParsed['host'] ?? '') . '/';
        $serverUrl = $spec['servers'][0]['url'] ?? '';
        $this->pathPrefix = rtrim((string)(parse_url($serverUrl, PHP_URL_PATH) ?? ''), '/');

        // Register all component schemas as models upfront so $ref resolution works
        foreach ($spec['components']['schemas'] ?? [] as $schemaName => $schema) {
            $this->models[$schemaName] = $this->buildModel($schemaName, $schema);
            $this->debug('+ model %s', $schemaName);
        }

        // Special generic object model used when response is untyped {type: object}
        $this->models['object'] = [
            'properties' => [],
            'description' => 'Generic object',
            'name' => 'object',
            'type' => 'object',
            'additionalProperties' => ['location' => 'json'],
        ];

        foreach ($spec['paths'] ?? [] as $path => $methods) {
            foreach ($methods as $method => $operation) {
                if (is_array($operation) && isset($operation['operationId'])) {
                    $this->processOperation(strtoupper($method), $path, $operation);
                }
            }
        }

        $this->resolveExposedModels();
    }

    private function buildModel(string $name, array $schema): array
    {
        if (isset($schema['allOf'])) {
            $schema = $this->mergeAllOf($schema);
        }

        $type = $schema['type'] ?? 'object';
        $model = ['name' => $name];

        if (isset($schema['description'])) {
            $model['description'] = $schema['description'];
        }

        if ($type === 'object') {
            $required = $schema['required'] ?? [];
            $properties = [];
            foreach ($schema['properties'] ?? [] as $propName => $propSchema) {
                $properties[$propName] = $this->buildProperty($propName, $propSchema, in_array($propName, $required, true));
            }
            $model['type'] = 'object';
            $model['additionalProperties'] = false;
            $model['properties'] = $properties;
        } elseif ($type === 'array') {
            $model['type'] = 'array';
            $model['location'] = 'json';
            if (isset($schema['items'])) {
                $model['items'] = $this->transformItems($schema['items']);
            }
        } else {
            $model['type'] = $this->mapType($type);
        }

        return $model;
    }

    private function mergeAllOf(array $schema): array
    {
        $merged = [
            'type' => 'object',
            'properties' => [],
            'required' => array_values($schema['required'] ?? []),
        ];
        if (isset($schema['description'])) {
            $merged['description'] = $schema['description'];
        }

        foreach ($schema['allOf'] as $sub) {
            if (isset($sub['$ref'])) {
                $refName = $this->stripSchemaPrefix($sub['$ref']);
                $refSchema = $this->spec['components']['schemas'][$refName] ?? [];
                if (isset($refSchema['allOf'])) {
                    $refSchema = $this->mergeAllOf($refSchema);
                }
                foreach ($refSchema['properties'] ?? [] as $k => $v) {
                    $merged['properties'][$k] = $v;
                }
                foreach ($refSchema['required'] ?? [] as $r) {
                    if (!in_array($r, $merged['required'], true)) {
                        $merged['required'][] = $r;
                    }
                }
            } else {
                foreach ($sub['properties'] ?? [] as $k => $v) {
                    $merged['properties'][$k] = $v;
                }
                foreach ($sub['required'] ?? [] as $r) {
                    if (!in_array($r, $merged['required'], true)) {
                        $merged['required'][] = $r;
                    }
                }
            }
        }

        return $merged;
    }

    private function buildProperty(string $name, array $schema, bool $required): array
    {
        $prop = ['name' => $name];

        if (isset($schema['description'])) {
            $prop['description'] = $schema['description'];
        }

        // Bare $ref
        if (isset($schema['$ref'])) {
            $prop['$ref'] = $this->stripSchemaPrefix($schema['$ref']);
            $prop['location'] = 'json';
            if ($required) {
                $prop['required'] = true;
            }
            return $prop;
        }

        // oneOf with a $ref (nullable object reference)
        if (isset($schema['oneOf'])) {
            foreach ($schema['oneOf'] as $one) {
                if (isset($one['$ref'])) {
                    $prop['$ref'] = $this->stripSchemaPrefix($one['$ref']);
                    $prop['location'] = 'json';
                    if ($required) {
                        $prop['required'] = true;
                    }
                    return $prop;
                }
            }
        }

        $type = $schema['type'] ?? '';
        $prop['type'] = $this->mapType($type);
        $prop['location'] = 'json';

        if ($required) {
            $prop['required'] = true;
        }

        foreach (['default', 'minimum', 'maximum'] as $field) {
            if (isset($schema[$field])) {
                $prop[$field] = $schema[$field];
            }
        }

        if (isset($schema['format']) && $schema['format'] === 'date-time') {
            $prop['format'] = 'date-time';
        }

        if ($type === 'array' && isset($schema['items'])) {
            $items = $schema['items'];
            // Items-level enum (e.g. PluralRules.forms) gets hoisted to parent
            if (isset($items['enum'])) {
                $prop['enum'] = $items['enum'];
                unset($items['enum']);
            }
            $prop['items'] = $this->transformItems($items);
        } elseif (isset($schema['enum'])) {
            $prop['enum'] = $schema['enum'];
        }

        return $prop;
    }

    private function transformItems(array $items): array
    {
        if (isset($items['$ref'])) {
            return ['$ref' => $this->stripSchemaPrefix($items['$ref'])];
        }
        $result = [];
        if (isset($items['type'])) {
            $result['type'] = $this->mapType($items['type']);
        }
        return $result;
    }

    private function mapType(string $type): string
    {
        static $map = [
            'integer' => 'integer',
            'int' => 'integer',
            'int32' => 'integer',
            'int64' => 'integer',
            'number' => 'number',
            'float' => 'number',
            'double' => 'number',
            'string' => 'string',
            'boolean' => 'boolean',
            'bool' => 'boolean',
            'array' => 'array',
            'object' => 'object',
        ];
        return $map[$type] ?? ($type ?: 'null');
    }

    private function stripSchemaPrefix(string $ref): string
    {
        return str_replace('#/components/schemas/', '', $ref);
    }

    private function processOperation(string $method, string $path, array $op): void
    {
        $id = $op['operationId'];
        $uri = $this->pathPrefix . $path;

        $this->debug('+ operation %s %s => %s', $method, $uri, $id);

        $params = $this->buildParams($op);
        $responseModel = $this->resolveResponseModel($id, $op['responses'] ?? []);
        $errorResponses = $this->buildErrorResponses($op['responses'] ?? []);

        $tag = ($op['tags'] ?? ['misc'])[0];
        $docUrl = $this->baseUri . 'api/docs/' . $tag . '/' . strtolower($id);

        $operation = [
            'summary' => $op['summary'] ?? '',
            'responseNotes' => $op['description'] ?? '',
            'httpMethod' => $method,
            'uri' => $uri,
            'name' => $id,
            'parameters' => $params,
            'errorResponses' => $errorResponses,
            'notes' => '',
            'documentationUrl' => $docUrl,
            'deprecated' => $op['deprecated'] ?? false,
            'data' => [],
            'additionalParameters' => null,
        ];

        if ($responseModel !== null) {
            $operation['responseModel'] = $responseModel;
            $this->exposeModel($responseModel);
        }

        // Insert responseModel after 'name' for consistent output order
        $reordered = [];
        foreach ($operation as $k => $v) {
            $reordered[$k] = $v;
            if ($k === 'name' && $responseModel !== null) {
                $reordered['responseModel'] = $responseModel;
            }
        }
        unset($reordered['responseModel']);
        if ($responseModel !== null) {
            // Already inserted above; remove and reorder
            $final = [];
            foreach ($operation as $k => $v) {
                if ($k === 'name') {
                    $final[$k] = $v;
                    $final['responseModel'] = $responseModel;
                } elseif ($k !== 'responseModel') {
                    $final[$k] = $v;
                }
            }
            $this->operations[$id] = $final;
        } else {
            $this->operations[$id] = $operation;
        }
    }

    private function buildParams(array $op): array
    {
        $params = [];
        $uriParamNames = [];

        foreach ($op['parameters'] ?? [] as $param) {
            if (isset($param['$ref'])) {
                $refKey = str_replace('#/components/parameters/', '', $param['$ref']);
                $param = $this->spec['components']['parameters'][$refKey] ?? $param;
            }

            $name = $param['name'];
            $in = $param['in'];
            $schema = $param['schema'] ?? [];
            $isRequired = $param['required'] ?? false;

            $p = ['name' => $name];
            $p['type'] = $this->mapType($schema['type'] ?? 'string');
            $p['required'] = $in === 'path' ? true : $isRequired;

            if (isset($param['description'])) {
                $p['description'] = $param['description'];
            }

            foreach (['default', 'enum', 'minimum', 'maximum'] as $field) {
                if (isset($schema[$field])) {
                    $p[$field] = $schema[$field];
                }
            }

            switch ($in) {
                case 'path':
                    $p['location'] = 'uri';
                    $uriParamNames[$name] = true;
                    break;
                case 'query':
                    $p['location'] = 'query';
                    break;
                case 'header':
                    $p['location'] = 'header';
                    break;
                default:
                    $p['location'] = $in;
            }

            $params[$name] = $p;
        }

        $requestBody = $op['requestBody'] ?? null;
        if ($requestBody !== null) {
            $content = $requestBody['content'] ?? [];
            $bodyRequired = $requestBody['required'] ?? false;

            if (isset($content['application/x-www-form-urlencoded'])) {
                $schema = $content['application/x-www-form-urlencoded']['schema'] ?? [];
                $requiredFields = $schema['required'] ?? [];
                foreach ($schema['properties'] ?? [] as $propName => $propSchema) {
                    $isRequired = in_array($propName, $requiredFields, true);
                    $paramKey = isset($uriParamNames[$propName]) ? $propName . '_formParam' : $propName;
                    $p = [
                        'name' => $paramKey,
                        'type' => $this->mapType($propSchema['type'] ?? 'string'),
                        'required' => $isRequired,
                        'location' => 'formParam',
                    ];
                    if (isset($propSchema['description'])) {
                        $p['description'] = $propSchema['description'];
                    }
                    foreach (['default', 'enum', 'minimum', 'maximum', 'maxLength'] as $field) {
                        if (isset($propSchema[$field])) {
                            $p[$field] = $propSchema[$field];
                        }
                    }
                    if ($paramKey !== $propName) {
                        $p['sentAs'] = $propName;
                    }
                    $params[$paramKey] = $p;
                }
            } elseif (isset($content['text/plain'])) {
                $schema = $content['text/plain']['schema'] ?? [];
                $p = [
                    'name' => 'data',
                    'type' => $this->mapType($schema['type'] ?? 'string'),
                    'required' => $bodyRequired,
                    'location' => 'body',
                ];
                foreach (['description', 'default'] as $field) {
                    if (isset($schema[$field])) {
                        $p[$field] = $schema[$field];
                    }
                }
                $params['data'] = $p;
            } elseif (isset($content['application/octet-stream'])) {
                $schema = $content['application/octet-stream']['schema'] ?? [];
                $p = [
                    'name' => 'data',
                    'type' => $this->mapType($schema['type'] ?? 'string'),
                    'required' => false,
                    'location' => 'body',
                ];
                foreach (['description', 'default'] as $field) {
                    if (isset($schema[$field])) {
                        $p[$field] = $schema[$field];
                    }
                }
                $params['data'] = $p;
            } elseif (isset($content['application/json'])) {
                $schema = $content['application/json']['schema'] ?? [];
                $requiredFields = $schema['required'] ?? [];
                foreach ($schema['properties'] ?? [] as $propName => $propSchema) {
                    $paramKey = isset($uriParamNames[$propName]) ? $propName . '_json' : $propName;
                    $p = [
                        'name' => $paramKey,
                        'type' => $this->mapType($propSchema['type'] ?? 'string'),
                        'required' => false,
                        'location' => 'json',
                    ];
                    if (isset($propSchema['description'])) {
                        $p['description'] = $propSchema['description'];
                    }
                    foreach (['default', 'enum', 'minimum', 'maximum'] as $field) {
                        if (isset($propSchema[$field])) {
                            $p[$field] = $propSchema[$field];
                        }
                    }
                    if ($paramKey !== $propName) {
                        $p['sentAs'] = $propName;
                    }
                    $params[$paramKey] = $p;
                }
            }
        }

        $params['key'] = [
            'name' => 'key',
            'type' => 'string',
            'required' => false,
            'description' => 'API key - required if not sent in Authorization header',
            'location' => 'query',
        ];

        return $params;
    }

    private function resolveResponseModel(string $operationId, array $responses): ?string
    {
        // Custom response class always wins
        if (isset($this->responseClasses[$operationId])) {
            $class = $this->responseClasses[$operationId];
            $ns = explode('\\', $class);
            $modelName = end($ns);
            if (!isset($this->models[$modelName])) {
                $this->models[$modelName] = [
                    'name' => $modelName,
                    'type' => 'class',
                    'class' => $class,
                    'description' => 'Custom response class',
                ];
                $this->debug('+ custom response model %s => %s', $modelName, $class);
            }
            return $modelName;
        }

        // Scan 2xx responses first, then fall back to all responses (e.g. deliberate 404 endpoints)
        $toScan = [];
        foreach (['200', '201'] as $preferred) {
            if (isset($responses[$preferred])) {
                $toScan[] = $preferred;
            }
        }
        foreach (array_keys($responses) as $code) {
            $intCode = (int)$code;
            if ($intCode >= 200 && $intCode < 300 && !in_array($code, $toScan, true)) {
                $toScan[] = $code;
            }
        }
        // If no 2xx responses define a schema, scan the rest (e.g. ping404 always returns 404)
        if (empty($toScan)) {
            $toScan = array_keys($responses);
        }

        foreach ($toScan as $code) {
            $response = $responses[$code];
            // Skip component $refs for responses (those are error refs)
            if (isset($response['$ref'])) {
                continue;
            }
            $schema = $response['content']['application/json']['schema'] ?? null;
            if ($schema === null) {
                continue;
            }

            if (isset($schema['$ref'])) {
                return $this->stripSchemaPrefix($schema['$ref']);
            }

            $type = $schema['type'] ?? '';

            if ($type === 'array') {
                $items = $schema['items'] ?? [];
                if (isset($items['$ref'])) {
                    $itemName = $this->stripSchemaPrefix($items['$ref']);
                    $listName = $itemName . 'List';
                    if (!isset($this->models[$listName])) {
                        $this->models[$listName] = [
                            'type' => 'array',
                            'items' => ['$ref' => $itemName],
                            'location' => 'json',
                        ];
                        $this->debug('+ list model %s', $listName);
                    }
                    return $listName;
                }
                // Primitive array (e.g. array of strings for tags)
                $itemType = $this->mapType($items['type'] ?? 'string');
                $listName = $itemType === 'string' ? 'TagList' : ucfirst($itemType) . 'List';
                if (!isset($this->models[$listName])) {
                    $this->models[$listName] = [
                        'type' => 'array',
                        'items' => ['type' => $itemType],
                        'location' => 'json',
                    ];
                    $this->debug('+ primitive list model %s', $listName);
                }
                return $listName;
            }

            if ($type === 'object' && empty($schema['properties'])) {
                return 'object';
            }
        }

        return null;
    }

    private function buildErrorResponses(array $responses): array
    {
        static $componentPhrases = [
            'error_401' => 'Invalid API key',
            'error_403' => 'Insufficient privileges',
            'error_404' => 'One or more referenced resources not found',
            'asset_404' => 'Asset not in project',
            'locale_404' => 'Locale not in project',
            'translation_404' => 'Asset not translated in this locale',
            'tag_404' => 'Tag not in project',
        ];

        $errors = [];
        foreach ($responses as $code => $response) {
            $intCode = (int)$code;
            if ($intCode >= 200 && $intCode < 300) {
                continue;
            }
            if (isset($response['$ref'])) {
                $refKey = str_replace('#/components/responses/', '', $response['$ref']);
                $phrase = $componentPhrases[$refKey]
                    ?? ($this->spec['components']['responses'][$refKey]['description'] ?? '');
            } else {
                $phrase = $response['description'] ?? '';
            }
            if ($phrase !== '') {
                $errors[] = ['code' => $intCode, 'phrase' => $phrase];
            }
        }
        return $errors;
    }

    private function exposeModel(string $name): void
    {
        if (isset($this->exposedModels[$name]) || !isset($this->models[$name])) {
            return;
        }
        $this->exposedModels[$name] = true;
        $this->debug('~ expose model %s', $name);
    }

    private function resolveExposedModels(): void
    {
        $changed = true;
        while ($changed) {
            $changed = false;
            foreach (array_keys($this->exposedModels) as $name) {
                foreach ($this->collectRefs($this->models[$name] ?? []) as $ref) {
                    if (!isset($this->exposedModels[$ref]) && isset($this->models[$ref])) {
                        $this->exposedModels[$ref] = true;
                        $changed = true;
                        $this->debug('~ expose model %s (via %s)', $ref, $name);
                    }
                }
            }
        }
    }

    private function collectRefs(array $data): array
    {
        $refs = [];
        if (isset($data['$ref'])) {
            $refs[] = $data['$ref'];
        }
        if (isset($data['items']['$ref'])) {
            $refs[] = $data['items']['$ref'];
        }
        foreach ($data['properties'] ?? [] as $prop) {
            foreach ($this->collectRefs($prop) as $r) {
                $refs[] = $r;
            }
        }
        return $refs;
    }
}
