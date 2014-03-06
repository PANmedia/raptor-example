<?php
/**
 * RIE\ImageEditor
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RIE;

class ImageEditor {

    public $root;
    public $action;
    public $input;

    public function __construct() {
        $this->input = $_REQUEST;
    }

    public function getAction() {
        $action = $this->getInput('action');
        if (!$action) {
            throw new ClientException('No action supplied.');
        }
        switch ($action) {
            case 'save': {
                $this->input = $_POST;
                return new ActionSave($this);
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
