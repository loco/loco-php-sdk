<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use GuzzleHttp\Command\Result;

/**
 * Test the live /tags API.
 *
 * @group live
 * @group tags
 */
class ApiClientTagsTest extends ApiClientTestCase
{

    /**
     * @var ApiClient
     */
    private $client;

    /**
     * Instantiate client for each test.
     */
    public function setUp()
    {
        $this->client = static::getClient();
    }

    /**
     * getTags
     *
     * @group readonly
     */
    public function testGetTags()
    {
        /** @var Result $tags */
        $tags = $this->client->getTags();
        $this->assertInstanceOf(Result::class, $tags);
        $tags = $tags->toArray();
        // If array has numeric keys, response was an array of objects, otherwise response was an object.
        $this->assertArrayHasKey(0, $tags);
        $this->assertInternalType('array', $tags);
        $tag = current($tags);
        $this->assertInternalType('string', $tag);

        return $tag;
    }

    /**
     * createTag
     */
    public function testCreateTag()
    {
        $name = md5(__CLASS__.__FUNCTION__.microtime());
        $model = $this->client->createTag(compact('name'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertSame(201, $model['status']);
        $this->assertEquals('Tag created', $model['message']);

        return $name;
    }

    /**
     * @depends testCreateTag
     */
    public function testPatchTag($tag)
    {
        $name = $tag.' renamed';
        $model = $this->client->patchTag(compact('tag', 'name'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertSame(200, $model['status']);
        $this->assertEquals('Tag renamed', $model['message']);

        return $name;
    }

    /**
     * @depends testPatchTag
     */
    public function testDeleteTag($tag)
    {
        $model = $this->client->deleteTag(compact('tag'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertSame(200, $model['status']);
        $this->assertEquals('Tag deleted', $model['message']);
    }

}

