<?php

namespace Loco\Tests\Http;

use GuzzleHttp\Command\Result;
use Loco\Http\ApiClient;

/**
 * Test the live /import API.
 *
 * @group live
 * @group importer
 */
class ApiClientImportTest extends ApiClientTestCase
{

    /**
     * @var ApiClient
     */
    private $client;

    /**
     * IDs of assets imported
     */
    private $assets = [];

    /**
     * Expected translations when created from id
     */
    private $expect = [
        'sample' => 'échantillon',
        'example' => 'exemple',
        'examples' => 'exemples',
        'something' => 'quelque chose de spécifique',
        "multiple \nlines" => "c'est \nmulti",
        'something, with, commas' => 'and "quotes" too',
    ];

    /**
     * Expected translations when created from text
     */
    private $expectFromText = [
        'sample' => 'échantillon',
        'example' => 'exemple',
        'examples' => 'exemples',
        'specific-something' => 'quelque chose de spécifique',
        'multiple-lines' => "c'est \nmulti",
        'something-with-commas' => 'and "quotes" too',
    ];

    /**
     * Ensure client available to all tests
     */
    public function setUp()
    {
        if (!$this->client) {
            $this->client = static::getClient();
        }
    }

    /**
     * Trash imported assets between each test
     */
    public function tearDown()
    {
        while ($id = array_pop($this->assets)['id']) {
            $param = compact('id');
            $this->client->deleteAsset($param);
        }
    }

    /**
     * Do import from file exported by converter tests.
     */
    private function import($sourcefile, $index = '', $locale = '')
    {
        $sourcefile = __DIR__.'/Fixtures/'.$sourcefile;
        $src = file_get_contents($sourcefile);
        $ext = pathinfo($sourcefile, PATHINFO_EXTENSION);
        $params = compact('index', 'locale', 'src', 'ext');
        $result = $this->client->import($params);
        // result response should always have assets and locales keys even if nothing imported
        $this->assertInstanceOf(Result::class, $result);
        $this->assertInternalType('array', $result['assets']);
        $this->assertInternalType('array', $result['locales']);
        // check presence of all assets known to be in file
        $foundIds = [];
        $this->assets = $result['assets'];
        foreach ($this->assets as $asset) {
            $this->assertArrayHasKey('id', $asset);
            $foundIds[] = $asset['id'];
        }
        if ($index === 'id') {
            $expectedIds = array_keys($this->expect);
        } else {
            $expectedIds = array_keys($this->expectFromText);
        }

        sort($foundIds);
        sort($expectedIds);
        $this->assertEquals($expectedIds, $foundIds, 'Expected assets were not in response, got '.json_encode($foundIds));
        // assets all imported, check them on the server too
        // will throw with 404 if asset does not exist
        foreach ($expectedIds as $id) {
            $this->client->getAsset(compact('id'));
        }
        // check locales were used
        if ($locale) {
            // index them first
            $locales = [];
            foreach ($result['locales'] as $l) {
                $locales[$l['code']] = $l;
            }
            // English should always have been used if any locale is set
            $this->assertArrayHasKey('en', $locales, 'english not returned in locales');
            // check all english translations exist and are correct
            foreach ($this->assets as $asset) {
                $param = ['id' => $asset['id'], 'locale' => 'en'];
                $translation = $this->client->getTranslation($param);
                // check if id is correct
                $this->assertEquals($asset['id'], $translation['id'], 'English not imported correctly');
            }
            // Specifying english only means no translations should exist in non-english locales
            if (strpos($locale, 'en') === 0) {
                $this->assertCount(1, $locales);
                foreach ($this->assets as $asset) {
                    $param = ['id' => $asset['id'], 'locale' => 'fr'];
                    $translation = $this->client->getTranslation($param);
                    $this->assertFalse($translation['translated'], 'Should not be translated, but is');
                }
            } else { // else check foreign translations as intended to import
                $this->assertCount(2, $locales);
                $this->assertArrayHasKey($locale, $locales, 'foreign locale not returned in locales');
                // check all foreign translations exist and are correct
                foreach ($this->expectFromText as $id => $foreign) {
                    $param = compact('id', 'locale');
                    $translation = $this->client->getTranslation($param);
                    $this->assertEquals($foreign, $translation['translation'], $locale.' not translated');
                }
            }
        }

        return $result;
    }

    /**
     * import YAML with assets only, no translations
     */
    public function testYamlImportAssetsOnly()
    {
        $this->import('test-fr_FR.po', 'id');
    }

    /**
     * import YAML with keys as native texts
     */
    public function testYamlImportEnglish()
    {
        $this->import('test-fr_FR.po', 'text', 'en');
    }

    /**
     * import YAML with keys as native texts plus french translations
     */
    public function testYamlImportFrench()
    {
        $this->import('test-fr_FR.po', 'text', 'fr');
    }

}
