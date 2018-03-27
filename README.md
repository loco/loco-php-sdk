# Loco SDK for PHP

## Installation

Installation is via [Composer](http://getcomposer.org/doc/00-intro.md#using-composer).

Add the latest stable version of [loco/loco](https://packagist.org/packages/loco/loco) to your project's `composer.json` file as follows:

```json
"require": {
  "loco/loco": "^2.0"
}
```


## REST API Client

The SDK includes a REST client for the [Loco API](https://localise.biz/api).

### Client usage

The client is built on [Guzzle](http://guzzle.readthedocs.org). 
Basic usage is to construct with your API key and call the [endpoint methods](https://localise.biz/api/docs) directly. The following example simply verifies your credentials:

```php
$client = Loco\Http\ApiClient::factory(['key' => 'your_api_key']);
$result = $client->authVerify();
printf("Authenticated as '%s'\n", $result['user']['name']);
```

### Advanced options 

Additionally the `ApiClient::factory` method can take any arguments accepted by Guzzle's client constructor.
See [Request Options](https://guzzle.readthedocs.io/en/stable/request-options.html) and [Handlers and Middleware](http://docs.guzzlephp.org/en/stable/handlers-and-middleware.html) for full details.


## Command Line Client

A [Console](http://symfony.com/doc/current/components/console/introduction.html) interface supporting all methods of the Loco API is at `bin/console`. Just run it to see all the available options.

The console reads from [config.json](https://github.com/loco/loco-php-sdk/blob/master/config.json.dist), but you can override your API key from the command line. Run the following to verify your credentials:

```sh
bin/console loco:auth:verify -v -k <your_api_key> 
```


## Documentation

* Check the [Loco API documentation](https://localise.biz/api) for full details on each endpoint.
* See the [example directory](https://github.com/loco/loco-php-sdk/tree/master/example) for more working code examples.


## Breaking changes in v2.0

Updating from Guzzle 3 to Guzzle 6 brought some necessary breaking changes with it. If you're upgrading from [1.0.18](https://github.com/loco/loco-php-sdk/tree/1.0.18), please note the following:

* The structure of `config.json` has changed. Note in particular a single root object containing your values, and also that `base_url` is now `base_uri`.
* The version number of the SDK is no longer synced to the version of the API. Each release will however be built against the [latest version](https://localise.biz/api/docs/changelog) of the live service.
