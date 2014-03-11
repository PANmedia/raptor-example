<?php
namespace Raptor\Section;
use LogicException;
use Raptor;

class Example extends Raptor\Example {

    public $layouts = [];

    public function saveSection($file) {
        if (isset($_POST['sections'])) {
            $data = [];
            if (file_exists($file)) {
                $string = file_get_contents($file);
                $data = json_decode($string, true);
                if ($data === false) {
                    $data = [];
                }
            }

            $sections = json_decode($_POST['sections']);
            if ($sections) {
                foreach ($sections as $id => $items) {
                    $data[$id] = $items;
                }
            }

            $string = json_encode($data, JSON_PRETTY_PRINT);
            if ($data !== false) {
                if (file_put_contents($file, $string)) {
                    return $string;
                }
            }
        }
        return json_encode(false);
    }

    public function renderSection($html) {
        return "<div class='raptor-section-item' data-raptor-section='{}'>$html</div>";
    }
    
    public function renderSections($id) {
        $file = RAPTOR_DATA_DIR . '/sections.json';
        if (file_exists($file)) {
            $data = file_get_contents($file);
            $data = json_decode($data, true);
            if ($data === false) {
                $data = [];
            }
        }

        $renderers = [];
        if (isset($data[$id]) && !empty($data[$id])) {
            foreach ($data[$id] as $i => $item) {
                switch ($item['type']) {
                    case 'layout': {
                        $renderers[$i] = new LayoutRenderer();
                        $renderers[$i]->setName($item['name']);
                        $renderers[$i]->setHtml($this->getLayout($item['name']));
                        if ($item['layout'] !== null) {
                            $renderers[$item['layout']]->addChild($renderers[$i], $item['pane']);
                            $renderers[$i]->setHasParent(true);
                        }
                        break;
                    }
                    case 'item': {
                        $renderers[$i] = new ItemRenderer();
                        $renderers[$i]->setName($item['name']);
                        $renderers[$i]->setData($item['data']);
                        if ($item['layout'] !== null) {
                            $renderers[$item['layout']]->addChild($renderers[$i], $item['pane']);
                            $renderers[$i]->setHasParent(true);
                        }
                        break;
                    }
                }
            }
        }

        $result = '';
        foreach ($renderers as $renderer) {
            if (!$renderer->getHasParent()) {
                $result .= $renderer->render();
            }
        }
        return $result;
    }

    // <editor-fold defaultstate="collapsed" desc="Getters and setters">
    public function getLayouts() {
        return $this->layouts;
    }

    public function getLayout($key) {
        if (!isset($this->layouts[$key])) {
            return null;
        }
        return $this->layouts[$key];
    }

    public function getLayoutJson($key) {
        $layout = $this->getLayout($key);
        if (!$layout) {
            return 'null';
        }
        $layout = preg_replace('/{(.*?)}/', '', $layout);
        return json_encode($layout);
    }

    public function setLayouts(array $layouts) {
        $this->layouts = $layouts;
        return $this;
    }

    public function addLayout($layout) {
        $this->layouts[] = $layout;
        return $this;
    }
    // </editor-fold>

}
