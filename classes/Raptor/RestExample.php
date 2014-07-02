<?php
namespace Raptor;

class RestExample extends Example {

    public function save() {
        if (!isset($_POST['id'])) {
            throw new ClientException('ID parameter missing.');
        }
        if (!isset($_POST['content'])) {
            throw new ClientException('Content parameter missing.');
        }

        $this->setContentBlock($_POST['id'], $_POST['content']);
        $this->saveContent();
    }

}
