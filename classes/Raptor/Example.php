<?php
namespace Raptor;
use LogicException;

class Example {

    public $name;
    public $content;
    public $contentFile;

    public function __construct($name = null) {
        $this->name = $name;
        $this->contentFile = RAPTOR_DATA_DIR . '/content.json';
    }

    public function renderHead() {
        ob_start();
        include RAPTOR_PARTIALS_DIR . 'head.php';
        return ob_get_clean();
    }

    public function renderContent($id, $buffer = null) {
        $content = $this->getContent();
        if (isset($content[$id])) {
            return $content[$id];
        }
        return $buffer;
    }

    public function renderNavigation() {
        ob_start();
        include RAPTOR_PARTIALS_DIR . 'nav.php';
        return ob_get_clean();
    }

    public function getDefaultContent($type = null) {
        if ($type) {
            $type = '-' . $type;
        }
        ob_start();
        require RAPTOR_PARTIALS_DIR . '/default-content' . $type . '.php';
        return ob_get_clean();
    }

    public function saveContent() {
        $content = json_encode($this->getContent(), JSON_PRETTY_PRINT);
        if ($content === false) {
            throw new ServerException('Failed to encode content.');
        }
        if (file_put_contents($this->getContentFile(), $content) === false) {
            throw new ServerException('Failed to write content file.');
        }
    }

    public function getContentBlock($id) {
        $content = $this->getContent();
        if (isset($content[$id])) {
            return $content[$id];
        }
        return null;
    }

    public function setContentBlock($id, $newContent) {
        $content = $this->getContent();
        $content[$id] = $newContent;
        $this->setContent($content);
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getContent() {
        if (!$this->content) {
            $file = $this->getContentFile();
            $this->content = [];
            if (file_exists($file)) {
                $this->content = file_get_contents($file);
                $this->content = json_decode($this->content, true);
                if (!$this->content) {
                    $this->content = [];
                }
            }
        }
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function getContentFile() {
        return $this->contentFile;
    }

    public function setContentFile($contentFile) {
        $this->contentFile = $contentFile;
        return $this;
    }

}
