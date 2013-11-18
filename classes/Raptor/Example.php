<?php
namespace Raptor;
use LogicException;

class Example {

    public $name;
    public $content;

    public function __construct($name) {
        $this->name = $name;
        $this->loadContent(RAPTOR_DATA_DIR . '/content.json');
    }

    public function loadContent($file) {
        $this->content = [];
        if (file_exists($file)) {
            $this->content = file_get_contents($file);
            $this->content = json_decode($this->content, true);
            if (!$this->content) {
                $this->content = [];
            }
        }
        return $this->content;
    }

    public function getContent() {
        return $this->content;
    }

    public function renderHead() {
        ob_start();
        include RAPTOR_PARTIALS_DIR . 'head.php';
        return ob_get_clean();
    }

    public function renderContent($section, $buffer = null) {
        if (isset($this->content[$section])) {
            return $this->content[$section];
        }
        return $buffer;
    }

    public function renderNavigation() {
        ob_start();
        include RAPTOR_PARTIALS_DIR . 'nav.php';
        return ob_get_clean();
    }

    public function saveJson($file) {
        if (isset($_POST['raptor-content'])) {
            $content = [];
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $content = json_decode($content, true);
                if ($content === false) {
                    $content = [];
                }
            }

            $newContent = json_decode($_POST['raptor-content']);
            if ($newContent) {
                foreach ($newContent as $id => $html) {
                    $content[$id] = $html;
                }
            }

            $content = json_encode($content, JSON_PRETTY_PRINT);
            if ($content !== false) {
                if (file_put_contents($file, $content)) {
                    return json_encode(true);
                }
            }
        }
        return json_encode(false);
    }

}
