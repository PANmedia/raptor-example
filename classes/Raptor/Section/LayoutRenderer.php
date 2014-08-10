<?php
namespace Raptor\Section;
use LogicException;
use Raptor;

class LayoutRenderer {

    public $children = [];
    public $hasParent = false;
    public $html;
    public $items = [];
    public $layoutIndex;
    public $layoutPane;
    public $name;
    public $title;
    public $type;
    public $panes = [];

    public function __construct($item = []) {
        foreach ($item as $key => $value) {
            $this->$key = $value;
        }
    }

    public function render() {
        $html = $this->html;
        $html = preg_replace_callback('/{{(.*?)}}/', function($matches) {
            $data = explode(',', $matches[1]);
            $type = trim($data[0]);
            $id = trim($data[1]);
            $defaultTitle = trim($data[2]);
            switch ($type) {
                case 'layout': {
                    $title = $this->title ?: $defaultTitle;
                    $json = htmlspecialchars(json_encode([
                        'name' => $id,
                        'title' => $title,
                        'defaultTitle' => $defaultTitle,
                    ], JSON_HEX_QUOT));
                    return "data-layout='$id' data-title='$title' data-raptor-layout=\"$json\"";
                }
                case 'pane': {
                    $title = isset($this->panes[$id]['title']) ? $this->panes[$id]['title'] : $defaultTitle;
                    $json = htmlspecialchars(json_encode([
                        'id' => $id,
                        'title' => $title,
                        'defaultTitle' => $defaultTitle,
                    ], JSON_HEX_QUOT));
                    return "data-pane='$id' data-title='$title' data-raptor-layout-pane=\"$json\"";
                }
            }
        }, $html);
        /*
        $html = preg_replace_callback('/{{title(\.(?<paneID>[0-9]+))?\|(?<defaultTitle>.*?)}}/', function($matches) {
            if (!$matches['paneID']) {
                return $this->title ?: $matches['defaultTitle'];
            }
            if (isset($this->panes[$matches['paneID']]) &&
                    isset($this->panes[$matches['paneID']]['title']) &&
                    $this->panes[$matches['paneID']]['title']) {
                return $this->panes[$matches['paneID']]['title'];
            }
            return $matches['defaultTitle'];
        }, $html);
        */
        $html = preg_replace_callback('/{([0-9+])}/', function($matches) {
            if (empty($this->children[$matches[1]])) {
                return '';
            }
            $result = '';
            foreach ($this->children[$matches[1]] as $child) {
                $result .= $child->render();
            }
            return $result;
        }, $html);
        return $html;
    }

    // <editor-fold defaultstate="collapsed" desc="Getters and setters">
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getHtml() {
        return $this->html;
    }

    public function setHtml($html) {
        $this->html = $html;
        return $this;
    }

    public function getChildren() {
        return $this->children;
    }

    public function setChildren(array $children) {
        $this->children = $children;
        return $this;
    }

    public function addChild($child, $pane) {
        $this->children[$pane][] = $child;
        return $this;
    }

    public function getHasParent() {
        return $this->hasParent;
    }

    public function setHasParent($hasParent) {
        $this->hasParent = $hasParent;
        return $this;
    }
    // </editor-fold>

}
