<?php
namespace Raptor\Section;
use LogicException;
use Raptor;

class Example extends Raptor\Example {

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
        $result = '';
        if (isset($data[$id]) && !empty($data[$id])) {
            foreach ($data[$id] as $sectionItem) {
                $savedItem = json_encode($sectionItem);
                $result .= "<div class='raptor-section-item' data-raptor-section='$savedItem'>";
                if (isset($sectionItem['choice']) && isset($sectionItem['choice']['choice'])) {
                    switch ($sectionItem['choice']['choice']) {
                        case 1: {
                            ob_start();
                            include RAPTOR_EXAMPLE_DIR . '/examples/section/ajax-content-choice.php';
                            $result .= ob_get_clean();
                            break;
                        }
                        case 2: {
                            $result .= 'Two';
                            break;
                        }
                        case 3: {
                            $result .= 'Three';
                            break;
                        }
                    }
                } elseif ($sectionItem['type'] === 'nested-item') {
                    $result .= "<div><p>Nest items.</p></div>";
                } elseif ($sectionItem['type'] === 'raptor-block') {
                    $id = uniqid('item-');
                    $result .= "<div id='$id'>Some Raptor Content</div>";
                    $result .= "
                        <script type='text/javascript'>
                            init(function($) {
                                $('#$id').raptor(extendDefaults({
                                    autoEnable: true
                                }));
                            });
                        </script>
                    ";
                }
                $result .= '</div>';
            }
        }
        return $result;
//        $revisions = [];
//        if (file_exists($revisionsFile)) {
//            $revisions = file_get_contents($revisionsFile);
//            $revisions = json_decode($revisions, true);
//            if ($revisions === false) {
//                $revisions = [];
//            }
//        }
//        if (isset($revisions[$_GET['id']])) {
//            krsort($revisions[$_GET['id']]);
//            foreach ($revisions[$_GET['id']] as $time => $data) {
//                $result['revisions'][] = [
//                    'identifier' => $time,
//                    'content' => $data,
//                    'updated' => $time . '000',
//                ];
//            }
//        }
    }

}
