# Loco SDK for PHP

## Installation

Installation is via [Composer](http://getcomposer.org/doc/00-intro.md#using-composer).

Add the latest stable version of [loco/loco](https://packagist.org/packages/loco/loco) to your project's composer.json file as follows:

```json
"require": {
  "loco/loco": "^2.0"
}
```

If you want to install straight from Github you'll have to write your own [autoloader](https://gist.github.com/jwage/221634) for now.


## REST API Client

The SDK includes a REST client for the [Loco API](https://localise.biz/api).


### Client Usage

Basic usage of the client is to construct with your API key and call the endpoint methods directly. The following example simply verifies your credentials:

```php
$client = Loco\Http\ApiClient::factory(['key' => 'your_api_key']);
$result = $client->authVerify();
printf("Authenticated as '%s'\n", $result['user']['name']);
```

#### Loco\Http\ApiClient::factory options
* `'key'` - string. API key for your Localize.biz project
* `'validate_response'` - bool. Default - false. Set to true if you want API response to be validated according to model description on deserialization
* `'httpHandlerStack'` - \GuzzleHttp\HandlerStack. A custom handler stack for \GuzzleHttp\Client. Use it if you need to inject a middleware and interact with Response/Request in some way. See Guzzle's [Handlers and Middleware](http://docs.guzzlephp.org/en/stable/handlers-and-middleware.html) docs section for details. 

## Command Line Client

A [Console](http://symfony.com/doc/current/components/console/introduction.html) interface supporting all methods of the Loco API is at `bin/console`. Just run it to see all the available options.

The console reads from [config.json](https://github.com/loco/loco-php-sdk/blob/master/config.json.dist), but you can override your API key from the command line. Run the following to verify your credentials:

```
bin/console loco:auth:verify -v -k <your_api_key> 
```

## Docs

Check the [Loco API documentation](https://localise.biz/api) to see what model is returned from each end point.

See the [example](https://github.com/loco/loco-php-sdk/tree/master/example) directory for more working code examples.

Build the PHP API documentation with [apigen](http://apigen.org/) using `apigen -c apigen.yml`
