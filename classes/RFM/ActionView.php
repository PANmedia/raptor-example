<?php
/**
 * RFM\ActionView
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class ActionView extends Action {

    public function __invoke() {
        $path = $this->fileManager->getInput('path');
        $file = $this->fileManager->getFile($path);
        if ($file) {
            header('Content-Type: ' . $file->getContentType());
            readfile($file->getFullPath());
        }
    }

}
