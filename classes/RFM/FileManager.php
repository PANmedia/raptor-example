<?php
/**
 * RFM\FileManager
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class FileManager {

    public $root;
    public $action;
    public $input;

    public function __construct() {
        $this->input = $_REQUEST;
    }

    public function getAction() {
        $action = $this->getInput('action');
        switch ($action) {
            case 'delete': {
                $this->input = $_POST;
                return new ActionDelete($this);
            }
            case 'upload': {
                $this->input = $_POST;
                return new ActionUpload($this);
            }
            case 'download': {
                $this->input = $_GET;
                return new ActionDownload($this);
            }
            case 'view': {
                $this->input = $_GET;
                return new ActionView($this);
            }
            case 'list': {
                $this->input = $_GET;
                return new ActionList($this);
            }
        }
        throw new ClientException('Unknown action: ' . $action);
    }

    public function cleanPath($path) {
        return str_replace(['~', '..', ':'], '', $path);
    }

    public function getFile($path) {
        $path = $this->cleanPath($path);
        $file = new File();
        $file->setPath($path);
        $file->setFullPath($this->getRoot() . '/' . $path);
        return $file;
    }

    public function getInput($key, $default = null) {
        return isset($this->input[$key]) ? $this->input[$key] : $default;
    }

    public function getRoot() {
        return $this->root;
    }

    public function setRoot($root) {
        $this->root = $root;
        return $this;
    }
}
