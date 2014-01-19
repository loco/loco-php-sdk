# Loco SDK for PHP

## Installation

Installation is via [composer](http://getcomposer.org/doc/00-intro.md#using-composer). With composer installed run the following:

    cd php-sdk-php
    php /path/to/composer.phar install

To test the installation, try pinging the REST API by running the following example from the command line:

    php example/ping.php


## REST API Client

This SDK includes a REST client for the [Loco API](https://localise.biz/) Other utilities will be added in future.

The converter API for language pack file formats can be used without a Loco account. Other endpoints are for working with Loco projects and require an API key.


### Usage

Basic usage of the `ApiClient` is to create an instance via its factory method and call the configured service end points:

    $client = \Loco\Http\ApiClient::factory();
    $response = $client->ping();

Responses that have structured data return [Guzzle models](http://api.guzzlephp.org/class-Guzzle.Service.Resource.Model.html).

Responses that return raw data must be cast to strings from the response object; for example when returning the contents of a file:

    $client = \Loco\Http\ApiClient::factory();
    $response = $client->ping( array (
        'from' => 'po', 
        'to'   => 'php,
        'src'  => file_get_contents('file.po'),
    ) );
    $phpsrc = (string) $response;

### Authenticated API calls

Endpoints that require authentication must be supplied a `key` parameter via the factory method; for example:

    $client = \Loco\Http\ApiClient::factory( array(
        'key' => 'your-loco-api-project-key',
    ) );
    $response = $client->testAuth();
    

