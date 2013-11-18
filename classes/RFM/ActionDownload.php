<?php
/**
 * RFM\ActionDownload
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class ActionDownload extends Action {

    public function __invoke() {
        $path = $this->fileManager->getInput('path');
        $file = $this->fileManager->getFile($path);
        if ($file) {
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary');
            header('Content-disposition: attachment; filename="' . basename($file->getFullPath()) . '"');
            readfile($file->getFullPath());
        }
    }

}
