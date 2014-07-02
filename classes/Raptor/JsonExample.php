<?php
namespace Raptor;
use LogicException;

class JsonExample extends Example {

    public function save() {
        if (!isset($_POST['raptor-content'])) {
            throw new ClientException('Content parameter missing.');
        }

        $content = $this->getContent();

        $newContent = json_decode($_POST['raptor-content']);
        if ($newContent) {
            foreach ($newContent as $id => $html) {
                $this->setContentBlock($id, $html);
            }
        }

        $this->saveContent();
        return true;
    }

}
