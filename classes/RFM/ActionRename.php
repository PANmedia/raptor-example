<?php
/**
 * RFM\ActionRename
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class ActionRename extends Action {

    public function __invoke() {
        $path = $this->fileManager->getInput('path');
        $file = $this->fileManager->getFile($path);
        $name = $this->fileManager->getInput('name');
        $file->rename($name);
    }

}
