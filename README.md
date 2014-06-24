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

This SDK includes a REST client for the [Loco API](https://localise.biz/api). Other utilities will be added in future.

The converter API for language pack file formats can be used without a Loco account. Other endpoints are for working with Loco projects and require an API key.

See [localise.biz/api](https://localise.biz/api) for full API documention.


### Client Usage

Basic usage of the client is to construct with your API key and call API methods directly on it. The following example simply verifies your credentials:

```php
$client = Loco\Http\ApiClient::factory( array( 'key' => 'yourkeyhere' ) );
$result = $client->authVerify();
printf("Authenticated as '%s'\n", $result['user']['name'] );
```

The Loco API client is built on [Guzzle](http://docs.guzzlephp.org/), so you can use its factory methods to pass in your API key from your site configuration. You could create your client from a JSON config [like our example](https://github.com/loco/loco-php-sdk/blob/master/config.json.dist) as follows:

```php
$client = Guzzle\Service\Builder\ServiceBuilder::factory('/path/to/config.json' )->get('loco');
```

Most responses are Guzzle models, which behave much like arrays. The above example fetches `$result['user']` although `$result` is actually an instance of [Guzzle\Service\Resource\Model](http://api.guzzlephp.org/class-Guzzle.Service.Resource.Model.html).


## Docs

Check the [Loco API documentation](https://localise.biz/api) to see what model is returned from each end point.

See the [example](https://github.com/loco/loco-php-sdk/tree/master/example) directory for more working code examples.

Build the PHP API documentation with [apigen](http://apigen.org/) using `apigen -c apigen.yml`

