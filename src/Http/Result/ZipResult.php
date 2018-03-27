<?php

namespace Loco\Http\Result;

use Psr\Http\Message\ResponseInterface;

/**
 * Response class for endpoints that return binary zip files.
 */
class ZipResult extends RawResult
{
    /**
     * @var \ZipArchive
     */
    private $zip;

    /**
     * @var string
     */
    private $tmp;

    /**
     * Create a response model object from a completed command
     *
     * @param ResponseInterface $response
     *
     * @return ZipResult
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $me = new self;

        return $me->init($response);
    }

    /**
     * Delete temporary file on shutdown if it still exists
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->tmp && file_exists($this->tmp)) {
            unlink($this->tmp);
        }
    }

    /**
     * Get zip archive instance.
     *
     * @throws \Exception if zip file is invalid
     *
     * @return \ZipArchive
     */
    public function getZip()
    {
        if (!$this->zip) {
            $bin = $this->__toString();
            // temporary file required for opening zip
            $this->tmp = tempnam(sys_get_temp_dir(), 'loco_zip_');
            file_put_contents($this->tmp, $bin);
            // should be able to read zip from disk now
            $this->zip = new \ZipArchive;
            $valid = $this->zip->open($this->tmp, \ZipArchive::CHECKCONS);
            // fatal server error might still respond 200 (e.g. memory exhaustion) so need to ensure Zip was valid
            if (true !== $valid) {
                $sniff = substr($bin, 0, 100);
                trigger_error('Invalid zip data begins: '.$bin, E_USER_WARNING);
                throw new \Exception('Response data was invalid zip archive');
            }
        }

        return $this->zip;
    }
}
