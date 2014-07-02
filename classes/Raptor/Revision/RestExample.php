<?php
namespace Raptor\Revision;
use Raptor;

class RestExample extends Raptor\RestExample {
    use TRevisionExample;

    public function save() {
        if (!isset($_POST['id'])) {
            throw new ClientException('ID parameter missing.');
        }
        if (!isset($_POST['content'])) {
            throw new ClientException('Content parameter missing.');
        }

        $id = $_POST['id'];
        $content = $this->getContent();
        if (!isset($content[$id]) || $content[$id] != $_POST['content']) {
            $this->addRevision($id, $_POST['content']);
        }

        $this->saveRevisions();

        return parent::save();
    }

}
