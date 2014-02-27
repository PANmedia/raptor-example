<?php
/**
 * RFM\File
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
namespace RFM;

class File {

    public $path;
    public $fullPath;

    public function delete() {
        if (!is_file($this->fullPath)) {
            throw new FileNotFoundException($this->path);
        }
        if (!@unlink($this->fullPath)) {
            throw new ServerException('Could not delete file: ' . $this->path);
        }
    }

    public function rename($to) {
        if (!is_file($this->fullPath)) {
            throw new FileNotFoundException($this->path);
        }
        if (!@rename($this->fullPath, dirname($this->fullPath) . '/' . $to)) {
            throw new ServerException('Could not rename file: ' . $this->path);
        }
    }

    public function getExtension($lastDot = true) {
        if (strpos($this->fullPath, '.') === false) {
            return '';
        }
        $parts = explode('.', $this->fullPath);
        if ($lastDot) {
            return array_pop($parts);;
        }
        array_shift($parts);
        return implode('.', $parts);
    }

    public function isImage($file) {
        $extension = strtolower($this->getExtension());
        return $extension === 'jpg'
            || $extension === 'jpeg'
            || $extension === 'png'
            || $extension === 'gif';
    }

    public function getContentType() {
        $types = [
            'png' => 'image/png',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
        ];

        if (isset($types[$this->getExtension()])) {
            return $types[$this->getExtension()];
        }
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
        return $this;
    }

    public function getFullPath() {
        return $this->fullPath;
    }

    public function setFullPath($fullPath) {
        $this->fullPath = $fullPath;
        return $this;
    }

}
