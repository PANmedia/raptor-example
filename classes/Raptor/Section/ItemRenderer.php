<?php
namespace Raptor\Section;
use LogicException;
use Raptor;

class ItemRenderer {

    public $data;
    public $hasParent = false;
    public $layoutIndex;
    public $layoutPane;
    public $name;
    public $title;
    public $type;

    public function __construct($item) {
        foreach ($item as $key => $value) {
            $this->$key = $value;
        }
    }

    public function render() {
        $savedItem = json_encode($this);
        $title = $this->title ?: $this->name;
        $result = "<div class='raptor-section-item' data-raptor-section='$savedItem' data-title='$title'>";
        switch ($this->name) {
            case 'raptor-block': {
                $id = uniqid('item-');
                $result .= "<div id='$id'><p>Default content...</p></div>";
                $result .= "
                    <script type='text/javascript'>
                        init(function($) {
                            $('#$id').raptor(extendDefaults({
                                autoEnable: true
                            }));
                        });
                    </script>
                ";
                break;
            }
            case 'raptor-image': {
                $result .= '<img src="../../partials/raptor.png" alt="Raptor Editor" />';
                break;
            }
            case 'insert-dialog': {
                $result .= "
                    <div class='button-set'>
                        <div class='button-set-text'>{$this->data['choice']['description']}</div>
                        <a href='{$this->data['choice']['link']}' class='button-set-link'>{$this->data['choice']['text']}</a>
                    </div>
                ";
                break;
            }
            case 'youtube': {
                $result .= '<div class="embed-container"><iframe src="//www.youtube.com/embed/' . $this->data['choice']['youtubeId'] . '" frameborder="0" allowfullscreen></iframe></div>';
                break;
            }
        }
        $result .= '</div>';
        return $result;
    }

    // <editor-fold defaultstate="collapsed" desc="Getters and setters">
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
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