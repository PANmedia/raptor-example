<?php
/**
 * RIE\Action
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RIE;

class Action {

    public $imageEditor;

    public function __construct($imageEditor = null) {
        $this->imageEditor = $imageEditor;
    }

}
