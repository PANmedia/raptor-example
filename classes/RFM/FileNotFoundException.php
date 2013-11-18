<?php
/**
 * RFM\FileNotFoundException
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class FileNotFoundException extends ClientException {

    public $path;

    public function __construct($path) {
        parent::__construct('Could not find file: ' . $path);
    }

}
