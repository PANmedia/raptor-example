<?php
namespace Raptor\Revision;
use Raptor;

class JsonExample extends Raptor\JsonExample {
    use TRevisionExample;

    public function save() {
        if (!isset($_POST['raptor-content'])) {
            throw new ClientException('Content parameter missing.');
        }

        $newContent = json_decode($_POST['raptor-content']);
        if ($newContent === false) {
            throw new ClientException('Failed to decode content.');
        }

        $content = $this->getContent();
        foreach ($newContent as $id => $html) {
            if (!isset($content[$id]) || $content[$id] != $html) {
                $this->addRevision($id, $html);
            }
        }

        $this->saveRevisions();

        return parent::save();
    }

}
