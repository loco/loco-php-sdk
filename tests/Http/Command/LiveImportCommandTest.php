<?php

namespace Loco\Tests\Http\Command;

use Loco\Tests\Http\ApiClientTestCase;
use GuzzleHttp\Command\Result;

/**
 * Test the live /import API.
 *
 * @group live
 */
class LiveImportCommmandTest extends ApiClientTestCase
{
    public function testLiveImportPostsValidYaml()
    {
        $client = static::getClient();
        $result = $client->import([
            'ext' => 'yml',
            'index' => 'id',
            'locale' => 'en',
            'data' => 'foo: Foo',
        ]);
        $this->assertInstanceOf(Result::class, $result);
    }


    public function testLiveImportSupportsLegacyBinding()
    {
        $client = static::getClient();
        $result = $client->import([
            'ext' => 'pot',
            'index' => 'text',
            'locale' => 'en',
            'src' => "msgid \"\"\nmsgstr \"\"\n\nmsgid \"Foo\"\nmsgstr \"\"",
        ]);
        $this->assertInstanceOf(Result::class, $result);
    }
}
