<?php
namespace Raptor\Revision;
use LogicException;
use Raptor;

class Example extends Raptor\Example {

    public function saveRevision($file, $revisionsFile) {
        if (isset($_POST['raptor-content'])) {
            $content = [];
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $content = json_decode($content, true);
                if ($content === false) {
                    $content = [];
                }
            }
            $revisions = [];
            if (file_exists($revisionsFile)) {
                $revisions = file_get_contents($revisionsFile);
                $revisions = json_decode($revisions, true);
                if (!is_array($revisions)) {
                    $revisions = [];
                }
            }
            $newContent = json_decode($_POST['raptor-content']);
            if ($newContent) {
                foreach ($newContent as $id => $html) {
                    if (!isset($content[$id]) || $content[$id] != $html) {
                        $revisions[$id][time()] = $html;
                    }
                }
            }

            $revisions = json_encode($revisions, JSON_PRETTY_PRINT);
            if ($revisions !== false) {
                if (file_put_contents($revisionsFile, $revisions)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function renderRevisions() {
        $file = RAPTOR_DATA_DIR . '/content.json';
        $revisionsFile = RAPTOR_DATA_DIR . '/revisions.json';
        $result = [
            'current' => null,
            'revisions' => null,
        ];
        if (isset($_GET['id'])) {
            $content = [];
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $content = json_decode($content, true);
                if ($content === false) {
                    $content = [];
                }
            }
            if (isset($content[$_GET['id']])) {
                $result['current'] = [
                    'identifier' => 0,
                    'content' => $content[$_GET['id']],
                    'updated' => time() . '000',
                ];
            }
            $revisions = [];
            if (file_exists($revisionsFile)) {
                $revisions = file_get_contents($revisionsFile);
                $revisions = json_decode($revisions, true);
                if ($revisions === false) {
                    $revisions = [];
                }
            }
            if (isset($revisions[$_GET['id']])) {
                krsort($revisions[$_GET['id']]);
                foreach ($revisions[$_GET['id']] as $time => $content) {
                    $result['revisions'][] = [
                        'identifier' => $time,
                        'content' => $content,
                        'updated' => $time . '000',
                    ];
                }
            }
        }
        return json_encode($result, JSON_PRETTY_PRINT);
    }

}
