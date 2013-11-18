<?php
/**
 * RFM\Action
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class Action {

    public $fileManager;

    public function __construct($fileManager) {
        $this->fileManager = $fileManager;
    }

}
