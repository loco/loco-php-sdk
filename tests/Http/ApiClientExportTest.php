<?php

namespace Loco\Tests\Http;

use Loco\Http\ApiClient;

/**
 * Test the live /export API.
 * @group live
 * @group export
 * @group readonly
 */
class ApiClientExportTest extends ApiClientTest {
    
    
    /**
     * Live test of single locale export
     */
    public function testLiveExportLocale(){
        $client = $this->getClient();
        $result = $client->exportLocale( array(
            'ext' => 'pot',
            'locale' => 'en-GB',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\RawResponse', $result );
        $this->assertRegExp( '/msgid\s+""/', (string) $result );
    }   


    /**
     * Live test of a multi-locale export in a single file
     */
    public function testLiveExportAll(){
        $client = $this->getClient();
        $result = $client->exportAll( array(
            'ext' => 'tmx',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\RawResponse', $result );
        $this->assertContains( '<!DOCTYPE tmx', (string) $result );
    }


    /**
     * Live test of zip archive
     */
    public function testLiveExportArchive(){
        $client = $this->getClient();
        $result = $client->exportArchive( array(
            'to' => 'po',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\ZipResponse', $result );
        $zip = $result->getZip();
        $this->assertInstanceOf('\ZipArchive', $zip );
        $this->assertContains( 'Exported', $zip->getArchiveComment() );
        $zip->close();
    }


    /**
     * Live test of template export
     */
    public function testLiveExportTemplate(){
        $client = $this->getClient();
        $result = $client->exportTemplate( array(
            'ext' => 'pot',
        ) );
        $this->assertInstanceOf('\Loco\Http\Response\RawResponse', $result );
        $this->assertContains( '"PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\n"', (string) $result );
    }      

}

