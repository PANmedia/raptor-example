<?php
namespace Raptor\Section;
use LogicException;
use Raptor;

class Example extends Raptor\Example {

    public $layouts = [];
    public $data = null;

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

    public function renderContainer($id, $classes) {
        $data = json_encode([
            'title' => $this->getTitle($id, 'Small Top Container'),
        ]);
        return "
            <div class='section $classes' data-id='$id' data-container='$data'>
                {$this->renderSections($id)}
            </div>
        ";
    }

    public function renderSection($html) {
        return "<div class='raptor-section-item' data-raptor-section='{}'>$html</div>";
    }

    public function renderSections($id) {
        $data = $this->getData();

        $renderers = [];
        if (isset($data[$id]) && !empty($data[$id])) {
            foreach ($data[$id]['items'] as $i => $item) {
                switch ($item['type']) {
                    case 'layout': {
                        $renderers[$i] = new LayoutRenderer($item);
                        $renderers[$i]->setHtml($this->getLayout($item['name']));
                        if ($item['layoutIndex'] !== null) {
                            $renderers[$item['layoutIndex']]->addChild($renderers[$i], $item['layoutPane']);
                            $renderers[$i]->setHasParent(true);
                        }
                        break;
                    }
                    case 'item': {
                        $renderers[$i] = new ItemRenderer($item);
                        if ($item['layoutIndex'] !== null) {
                            $renderers[$item['layoutIndex']]->addChild($renderers[$i], $item['layoutPane']);
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

    public function getTitle($id, $defaultTitle) {
        $data = $this->getData();
        if (isset($data[$id]) && isset($data[$id]['title'])) {
            return $data[$id]['title'] ?: $defaultTitle;
        }
        return $defaultTitle;
    }

    public function getData() {
        if (!$this->data) {
            $file = RAPTOR_DATA_DIR . '/sections.json';
            if (file_exists($file)) {
                $this->data = file_get_contents($file);
                $this->data = json_decode($this->data, true);
                if ($this->data === false) {
                    $this->data = [];
                }
            }
        }
        return $this->data;
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
        $layout = (new LayoutRenderer())->setHtml($this->getLayout($key))->render();
        if (!$layout) {
            return 'null';
        }
        $layout = preg_replace('/{([0-9]+)}/', '', $layout);
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
