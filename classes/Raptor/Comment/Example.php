<?php
namespace Raptor\Comment;
use LogicException;
use Raptor;

class Example extends Raptor\Example {

    public function __construct($name) {
        parent::__construct($name);
        $this->setContentFile(RAPTOR_DATA_DIR . '/comments.json');
    }

    public function save() {
        if (!isset($_POST['comment'])) {
            throw new Raptor\ClientException('Comment parameter missing.');
        }

        $content = $this->getContent();

        $newContent = json_decode($_POST['comment']);
        if (isset($_POST['comment']) && trim($_POST['comment'])) {
            $this->setContentBlock(time(), $_POST['comment']);
        }

        $this->saveContent();
    }

}
