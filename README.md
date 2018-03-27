# LEGACY BRANCH

A newer version of this library is on the master branch.

This version should continue to work with the live API up to version 1.0.18, but will no longer be maintained.


---

# Loco SDK for PHP

## Installation

Installation is via [Composer](http://getcomposer.org/doc/00-intro.md#using-composer).

Add the latest stable version of [loco/loco](https://packagist.org/packages/loco/loco) to your project's composer.json file as follows:

```json
"require": {
  "loco/loco": "~1.0"
}
```

If you want to install straight from Github you'll have to write your own [autoloader](https://gist.github.com/jwage/221634) for now.


## REST API Client

The SDK includes a REST client for the [Loco API](https://localise.biz/api).


### Client Usage

Basic usage of the client is to construct with your API key and call the endpoint methods directly. The following example simply verifies your credentials:

```php
$client = Loco\Http\ApiClient::factory( array( 'key' => 'your_api_key' ) );
$result = $client->authVerify();
printf("Authenticated as '%s'\n", $result['user']['name'] );
```

The Loco API client is built on [Guzzle 3](http://guzzle3.readthedocs.org). You can use its factory methods to configure your API Key as above, or you can use a JSON config [like our example](https://github.com/loco/loco-php-sdk/blob/master/config.json.dist). Constructing from the config file can be done as follows:

```php
$client = Guzzle\Service\Builder\ServiceBuilder::factory('config.json' )->get('loco');
```


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