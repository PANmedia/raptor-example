<?php
/**
 * RIE\ActionSave
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RIE;

class ActionSave extends Action {

    public function __invoke() {
        $imageData = $this->imageEditor->getInput('image');
        $file = $this->imageEditor->getInput('id');
        if (!$file) {
            throw new ClientException('No file ID.');
        }
        $file = realpath(ROOT) . '/' . preg_replace('~[^a-zA-Z0-9_.\\\/\- ]|\.{2}~', '', $file);
        $this->save($imageData, $file);
        echo 'true';
    }

    public function save($imageData, $file) {
        if (!$imageData) {
            throw new ClientException('No data received.');
        }
        if (!is_file($file)) {
            throw new ClientException('Image file not found.');
        }
        if (!preg_match('/^data:(.*?);/', $imageData, $matches)) {
            throw new ClientException('Could not parse image data.');
        }
        $mimeType = $matches[1];
        $binaryData = file_get_contents($imageData);
        $size = strlen($binaryData);
        if (!file_put_contents($file, $binaryData)) {
            throw new ServerException('Failed to save image.');
        }
    }

}
