<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;
use GuzzleHttp\Command\Result;

/**
 * Test the live /translations API.
 *
 * @group live
 * @group translations
 */
class ApiClientTranslationsTest extends ApiClientTestCase
{

    /**
     * ensure we have an asset to translate
     */
    public function testAssetCreatedForTranslating()
    {
        $id = 'test-'.md5(microtime());
        $name = 'Test translations';
        $client = static::getClient();
        $model = $client->createAsset(compact('id', 'name'));
        $this->assertEquals($id, $model['id']);

        return $id;
    }

    /**
     * ensure we have a locale to translate into
     */
    public function testLocaleCreatedForTranslating()
    {
        $rand = substr(md5(microtime()), 0, 5);
        $code = 'en-GB-x-'.$rand;
        $client = static::getClient();
        $model = $client->createLocale(compact('code'));
        $this->assertEquals($code, $model['code']);

        return $code;
    }

    /**
     * getTranslations
     *
     * @depends testAssetCreatedForTranslating
     * @group readonly
     */
    public function testAssetInTranslationList($id)
    {
        $client = static::getClient();
        /** @var Result $listing */
        $listing = $client->getTranslations(compact('id'));
        $this->assertInstanceOf(Result::class, $listing);
        // If array has numeric keys, response was an array of objects, otherwise response was an object.
        $this->assertArrayHasKey(0, $listing);
        $native = $listing[0];
        $this->assertInternalType('array', $native, 'Native translation of test asset not found in list');
        $this->assertTrue($native['translated'], 'Native locales expected to be translated');

        return $id;
    }

    /**
     * getTranslation
     *
     * @depends testAssetInTranslationList
     * @depends testLocaleCreatedForTranslating
     * @group readonly
     *
     * @param string $id
     * @param string $locale
     *
     * @return Result
     */
    public function testAssetUntranslatedInitially($id, $locale)
    {
        $client = static::getClient();
        $model = $client->getTranslation(compact('id', 'locale'));
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals($id, $model['id']);
        $this->assertEquals($locale, $model['locale']['code']);
        $this->assertFalse($model['translated']);
        $this->assertFalse($model['flagged']);
        $this->assertEquals(0, $model['revision']);

        return $model;
    }

    /**
     * translate
     *
     * @depends testAssetUntranslatedInitially
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testTranslate(Result $translation)
    {
        $client = static::getClient();
        $model = $client->translate(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
                'translation' => 'Test OK',
            ]
        );
        $this->assertInstanceOf(Result::class, $model);
        $this->assertTrue($model['translated']);
        $this->assertFalse($model['flagged']);
        $this->assertEquals(1, $model['revision']);

        return $model;
    }

    /**
     * @depends testTranslate
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testAssetTranslatedAfterTranslation(Result $translation)
    {
        $client = static::getClient();
        $model = $client->getTranslation(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
            ]
        );
        $this->assertTrue($model['translated'], 'Asset not translated after translation');
        $this->assertEquals(1, $model['revision'], 'Asset revision not incremented after translation');

        return $translation;
    }

    /**
     * @depends testAssetTranslatedAfterTranslation
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testTranslationDuplicateDoesNothing(Result $translation)
    {
        // This is to make sure at least one second passed since previous translation,
        // so that we can detect if translation timestamp changes.
        sleep(1);

        $client = static::getClient();
        $model = $client->translate(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
                'translation' => 'Test OK',
            ]
        );
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals(1, $model['revision'], 'Duplicate translation should not bump revision');
        $this->assertEquals(
            $translation['modified'],
            $model['modified'],
            'Duplicate translation should not alter timestamp'
        );

        return $model;
    }

    /**
     * @depends testTranslationDuplicateDoesNothing
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testTranslationChange(Result $translation)
    {
        // This is to make sure at least one second passed since previous translation,
        // so that we can detect if translation timestamp changes.
        sleep(1);

        $client = static::getClient();
        $model = $client->translate(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
                'translation' => 'Test OK Again',
            ]
        );
        $this->assertEquals(2, $model['revision'], 'Second translation should bump revision');
        $this->assertNotSame($translation['modified'], $model['modified'], 'Second translation should alter timestamp');

        return $model;
    }

    /**
     * @depends testTranslationChange
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testTranslationFlagging(Result $translation)
    {
        $client = static::getClient();
        $model = $client->flagTranslation(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
                'flag' => 'fuzzy',
            ]
        );
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals(200, $model['status']);
        $this->assertEquals('Flagged as "Fuzzy"', $model['message']);

        return $translation;
    }

    /**
     * @depends testTranslationFlagging
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testTranslationIncompleteAfterFlagging(Result $translation)
    {
        $client = static::getClient();
        $model = $client->getTranslation(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
            ]
        );
        $this->assertTrue($model['flagged'], 'Asset should be flagged after flagging');
        $this->assertTrue($model['translated'], 'Asset should still be "translated" when flagged');

        return $translation;
    }

    /**
     * @depends testTranslationIncompleteAfterFlagging
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testUnflagTranslation(Result $translation)
    {
        $client = static::getClient();
        $model = $client->unflagTranslation(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
            ]
        );
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals(200, $model['status']);
        $this->assertEquals('Unflagged', $model['message']);

        return $translation;
    }

    /**
     * @depends testTranslationFlagging
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testTranslationCompleteAfterUnflagging(Result $translation)
    {
        $client = static::getClient();
        $model = $client->getTranslation(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
            ]
        );
        $this->assertFalse($model['flagged'], 'Asset should be unflagged after unflagging');

        return $translation;
    }

    /**
     * @depends testTranslationCompleteAfterUnflagging
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testUntranslate(Result $translation)
    {
        $client = static::getClient();
        $model = $client->untranslate(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
            ]
        );
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals(200, $model['status']);
        $this->assertStringEndsWith('translation deleted', $model['message']);

        //sleep(1);
        return $translation;
    }

    /**
     * @depends testUntranslate
     *
     * @param Result $translation
     *
     * @return Result
     */
    public function testAssetUntranslatedAfterDelete(Result $translation)
    {
        $client = static::getClient();
        $model = $client->getTranslation(
            [
                'id' => $translation['id'],
                'locale' => $translation['locale']['code'],
            ]
        );
        $this->assertFalse($model['translated'], 'Asset not untranslated after delete operation');
        $this->assertFalse($model['flagged'], 'Asset should not be flagged when no translation exists');
        $this->assertEquals(0, $model['revision'], 'Asset revision not zeroed after delete operation');

        return $model;
    }

    /**
     * final test deletes asset and locale
     *
     * @depends testAssetUntranslatedAfterDelete
     *
     * @param Result $translation
     */
    public function testAssetAndLocaleDeletedFinally(Result $translation)
    {
        $client = static::getClient();
        $model = $client->deleteAsset(['id' => $translation['id']]);
        $this->assertEquals(200, $model['status']);
        $model = $client->deleteLocale(['locale' => $translation['locale']['code']]);
        $this->assertEquals(200, $model['status']);
    }

}
