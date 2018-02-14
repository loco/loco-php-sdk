<?php

namespace Loco\Tests\Http;

use GuzzleHttp\Command\Result;
use Loco\Http\ApiClient;

/**
 * Test the live /assets API.
 *
 * @group live
 * @group assets
 */
class ApiClientAssetsTest extends ApiClientTestCase
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
     * getAssets
     *
     * @group readonly
     */
    public function testAssetsList()
    {
        // top level is array
        $assets = $this->client->getAssets();
        $this->assertInstanceOf(Result::class, $assets);
        // items are instances of Asset model, but Guzzle won't validate due to primitive being top level.
        $asset = $assets[0];
        $this->assertInternalType('array', $asset);
        $this->assertArrayHasKey('id', $asset);

        return $asset;
    }

    /**
     * getAsset
     *
     * @depends testAssetsList
     * @group readonly
     *
     * @param array $asset
     */
    public function testAssetGet(array $asset)
    {
        $model = $this->client->getAsset(['id' => $asset['id']]);
        $this->assertInstanceOf(Result::class, $model);
        $this->assertArrayHasKey('id', $model);
        $id = $model['id'];
        $this->assertEquals($asset['id'], $id);
    }

    /**
     * createAsset
     */
    public function testAssetCreate()
    {
        $slug = 'test-'.substr(md5(microtime()), 0, 5);
        $name = 'Test asset';
        $model = $this->client->createAsset(['id' => $slug, 'name' => $name]);
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals($slug, $model['id']);
        $this->assertEquals($name, $model['name']);
        $this->assertEquals('text', $model['type']);

        return $slug;
    }

    /**
     * tagAsset
     *
     * @depends testAssetCreate
     *
     * @param string $id
     */
    public function testAssetTag($id)
    {
        $name = 'Test tag';
        $model = $this->client->tagAsset(compact('id', 'name'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertInternalType('array', $model['tags']);
        $this->assertContains($name, $model['tags']);
    }

    /**
     * patchAsset
     *
     * @depends testAssetCreate
     *
     * @param string $id
     *
     * @return string
     */
    public function testAssetPatch($id)
    {
        $name = 'Renamed OK';
        $notes = 'Notes field OK';
        $context = 'Context field OK';
        $model = $this->client->patchAsset(compact('id', 'name', 'notes', 'context'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals($id, $model['id']);
        $this->assertEquals($name, $model['name']);
        $this->assertEquals($notes, $model['notes']);
        $this->assertEquals($context, $model['context']);

        return $id;
    }

    /**
     * patchAsset with failure
     *
     * @depends testAssetCreate
     * @expectedException \GuzzleHttp\Command\Exception\CommandClientException
     *
     * @param string $slug
     */
    public function testAssetPatchRejectsUnpatchable($slug)
    {
        $this->client->patchAsset(['id' => $slug, 'translated' => 0]);
    }

    /**
     * createPlural
     *
     * @depends testAssetPatch
     *
     * @param string $slug
     *
     * @return string
     */
    public function testCreateNewPlural($slug)
    {
        $name = 'Plural of Test Asset';
        $model = $this->client->createPlural(['id' => $slug, 'name' => $name]);
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals($name, $model['name']);
        // number translated will depend on whether locales exist that must have this blank (e.g. zero plural langs)
        $this->assertGreaterThan(0, $model['progress']['translated']);

        return $model['id'];
    }

    /**
     * createPlural with deliberate failure creating plural of a plural
     *
     * @depends testCreateNewPlural
     * @expectedException \GuzzleHttp\Command\Exception\CommandClientException
     *
     * @param string $slug
     */
    public function testCreatePluralOfPluralFails($slug)
    {
        $this->client->createPlural(['id' => $slug, 'name' => '_']);
    }

    /**
     * unlinkPlural
     *
     * @depends testAssetPatch
     * @depends testCreateNewPlural
     *
     * @param string $id
     * @param string $pid
     *
     * @return string
     */
    public function testUnlinkPlural($id, $pid)
    {
        $model = $this->client->unlinkPlural(compact('id', 'pid'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals('Plural form unlinked', $model['message']);

        return $pid;
    }

    /**
     * createPlural with existing asset
     *
     * @depends testAssetPatch
     * @depends testUnlinkPlural
     *
     * @param string $id
     * @param string $pid
     *
     * @return string
     */
    public function testPluralCreateFromExisting($id, $pid)
    {
        $name = 'Plural Asset renamed';
        $model = $this->client->createPlural(compact('id', 'name', 'pid'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals($pid, $model['id']);
        $this->assertEquals($name, $model['name']);

        return $pid;
    }

    /**
     * deleteAsset
     *
     * @depends testAssetPatch
     * @depends testPluralCreateFromExisting
     *
     * @param string $id1
     * @param string $id2
     */
    public function testAssetDelete($id1, $id2)
    {
        foreach (func_get_args() as $slug) {
            $model = $this->client->deleteAsset(['id' => $slug]);
            $this->assertInstanceOf(Result::class, $model);
            $this->assertEquals(200, $model['status']);
        }
    }

}

