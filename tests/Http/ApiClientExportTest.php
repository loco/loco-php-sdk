<?php

namespace Loco\Tests\Http;

use Loco\Http\Result\RawResult;
use Loco\Http\Result\ZipResult;

/**
 * Test the live /export API.
 *
 * @group live
 * @group export
 * @group readonly
 */
class ApiClientExportTest extends ApiClientTestCase
{

    /**
     * Live test of single locale export
     */
    public function testLiveExportLocale()
    {
        $client = static::getClient();
        $result = $client->exportLocale(
            [
                'ext' => 'pot',
                'locale' => 'en-GB',
            ]
        );
        $this->assertInstanceOf(RawResult::class, $result);
        $this->assertRegExp('/msgid\s+""/', (string)$result);
    }

    /**
     * Live test of a multi-locale export in a single file
     */
    public function testLiveExportAll()
    {
        $client = static::getClient();
        $result = $client->exportAll(
            [
                'ext' => 'tmx',
            ]
        );
        $this->assertInstanceOf(RawResult::class, $result);
        $this->assertContains('<!DOCTYPE tmx', (string)$result);
    }

    /**
     * Live test of zip archive
     */
    public function testLiveExportArchive()
    {
        $client = static::getClient();
        $result = $client->exportArchive(
            [
                'to' => 'po',
            ]
        );
        $this->assertInstanceOf(ZipResult::class, $result);
        $zip = $result->getZip();
        $this->assertInstanceOf(\ZipArchive::class, $zip);
        $this->assertContains('Exported', $zip->getArchiveComment());
        $zip->close();
    }

    /**
     * Live test of template export
     */
    public function testLiveExportTemplate()
    {
        $client = static::getClient();
        $result = $client->exportTemplate(
            [
                'ext' => 'pot',
            ]
        );
        $this->assertInstanceOf(RawResult::class, $result);
        $this->assertContains('"PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\n"', (string)$result);
    }

}

