<?php

namespace Loco\Tests\Http;

use GuzzleHttp\Command\Exception\CommandClientException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Command\Result;

/**
 * Test the live /locales API.
 *
 * @group live
 * @group locales
 */
class ApiClientLocalesTest extends ApiClientTestCase
{

    /**
     * getLocales
     *
     * @group readonly
     */
    public function testLocalesList()
    {
        $client = static::getClient();
        // top level is array
        /** @var Result $locales */
        $locales = $client->getLocales();
        $this->assertInternalType('array', $locales->toArray());
        // items are instances of Locale model, but Guzzle won't validate due to primitive being top level.
        $locale = $locales[0];
        $this->assertInternalType('array', $locale);
        $this->assertArrayHasKey('code', $locale);

        return $locale;
    }

    /**
     * getLocale
     *
     * @depends testLocalesList
     * @group readonly
     *
     * @param array $locale
     *
     * @return string
     */
    public function testLocaleGet(array $locale)
    {
        $client = static::getClient();
        $model = $client->getLocale(['locale' => $locale['code']]);
        $this->assertInstanceOf(Result::class, $model);
        $code = $model['code'];
        $this->assertEquals($locale['code'], $code);

        return $code;
    }

    /**
     * createLocale
     *
     * @return string
     */
    public function testLocaleCreate()
    {
        $rand = substr(md5(microtime()), 0, 5);
        $code = 'en-GB-x-'.$rand;
        $client = static::getClient();
        $model = $client->createLocale(['code' => $code]);
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals($code, $model['code']);
        $this->assertStringStartsWith('English ', $model['name']);

        return $code;
    }

    /**
     * patchLocale
     *
     * @depends testLocaleCreate
     *
     * @param string $code
     *
     * @return string
     */
    public function testLocalePatch($code)
    {
        $client = static::getClient();
        $update = [
            'name' => 'Renamed OK',
            'locale' => $code,
        ];
        $model = $client->patchLocale($update);
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals('Renamed OK', $model['name']);

        return $code;
    }

    /**
     * patchLocale with failure trying to set a non-existant property
     *
     * @depends testLocaleCreate
     * @expectedException \GuzzleHttp\Exception\ClientException
     *
     * @throws \GuzzleHttp\Exception\ClientException
     * @throws \GuzzleHttp\Command\Exception\CommandClientException
     *
     * @param string $code
     */
    public function testLocalePatchRejectsUnpatchable($code)
    {
        $client = static::getClient();
        $update = [
            'locale' => $code,
            'rubbish' => 1,
        ];

        // We want to make sure original exception was ClientException
        try {
            $client->patchLocale($update);
        } catch (CommandClientException $e) {
            /** @var \GuzzleHttp\Exception\ClientException $previous */
            $previous = $e->getPrevious();
            if ($previous instanceof ClientException) {
                throw $previous;
            }

            throw $e;
        }
    }

    /**
     * deleteLocale
     *
     * @depends testLocalePatch
     *
     * @param string $code
     */
    public function testLocaleDelete($code)
    {
        $client = static::getClient();
        $model = $client->deleteLocale(['locale' => $code]);
        $this->assertInstanceOf(Result::class, $model);
        $this->assertEquals(200, $model['status']);
    }

}

