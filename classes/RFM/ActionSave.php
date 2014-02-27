<?php
/**
 * RFM\ActionSave
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;
use RIE;

class ActionSave extends Action {

    public function __invoke() {
        $path = $this->fileManager->getInput('path');
        $file = $this->fileManager->getFile($path);
        $rieSave = new RIE\ActionSave();
        $rieSave->save($this->fileManager->getInput('image'), $file->getFullPath());
        echo 'true';
    }

}
