<?php
namespace Raptor\Revision;
use Raptor;

trait TRevisionExample {

    public $revisions;
    public $revisionFile;

    public function addRevision($id, $content) {
        $revisions = $this->getRevisions();
        if (!isset($revisions[$id])) {
            $revisions[$id] = [];
        }
        $revisions[$id][time()] = $content;
        $this->setRevisions($revisions);
        return $this;
    }

    public function getRevisions() {
        if (!$this->revisions) {
            $file = $this->getRevisionFile();
            $this->revisions = [];
            if (file_exists($file)) {
                $this->revisions = file_get_contents($file);
                $this->revisions = json_decode($this->revisions, true);
                if (!is_array($this->revisions)) {
                    $this->revisions = [];
                }
            }
        }
        return $this->revisions;
    }

    public function setRevisions($revisions) {
        $this->revisions = $revisions;
        return $this;
    }

    public function saveRevisions() {
        $revisions = json_encode($this->getRevisions(), JSON_PRETTY_PRINT);
        if ($revisions === false) {
            throw new ServerException('Failed to encode content.');
        }
        if (file_put_contents($this->getRevisionFile(), $revisions) === false) {
            throw new ServerException('Failed to write content file.');
        }
    }

    public function renderContent($id, $buffer = null) {
        $revisions = $this->getRevisions();
        $content = $this->getContent();
        if (isset($content[$id])) {
            if (!isset($revisions[$id])) {
                $this->addRevision($id, $content[$id]);
                $this->saveRevisions();
            }
            return $content[$id];
        }
        if (!isset($revisions[$id])) {
            $this->addRevision($id, $buffer);
            $this->saveRevisions();
        }
        return $buffer;
    }

    public function renderRevisions() {
        $result = [
            'current' => [
                'identifier' => 0,
                'content' => '',
                'updated' => time() . '000',
            ],
            'revisions' => [],
        ];
        if (isset($_GET['id'])) {
            $content = $this->getContent();

            if (isset($content[$_GET['id']])) {
                $result['current'] = [
                    'identifier' => 0,
                    'content' => $content[$_GET['id']],
                    'updated' => time() . '000',
                ];
            }
            $revisions = $this->getRevisions();

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

    public function getRevisionFile() {
        if (!$this->revisionFile) {
            $this->revisionFile = RAPTOR_DATA_DIR . '/revisions.json';
        }
        return $this->revisionFile;
    }

    public function setRevisionFile($revisionFile) {
        $this->revisionFile = $revisionFile;
        return $this;
    }

}
