<?php
/**
 * RFM\ActionDelete
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class ActionDelete extends Action {

    public function __invoke() {
        $path = $this->fileManager->getInput('path');
        $file = $this->fileManager->getFile($path);
        $file->delete();
    }

}
