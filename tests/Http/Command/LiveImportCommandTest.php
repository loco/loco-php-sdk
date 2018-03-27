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
    public function testLiveImportPostsValidJson()
    {
        $client = static::getClient();
        $result = $client->import([
            'ext' => 'json',
            'index' => 'id',
            'locale' => 'en',
            'src' => '{"foo":"Foo","bar":"Bar","baz":"Baz"}',
        ]);
        $this->assertInstanceOf(Result::class, $result);
    }
}
