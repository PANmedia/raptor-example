<?php
include __DIR__ . '/../../../../include.php';

function input($key, $default = null) {
    return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
}

function contentType($file) {
    $types = [
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
    ];

    $parts = explode('.', $file);
    $ext = strtolower(array_pop($parts));
    if (isset($ext, $types)) {
        return $types[$ext];
    }
}

$path = str_replace(['~', '..'], '', input('path', '/'));
$file = RAPTOR_UPLOAD_DIR . '/' . $path;

if (!is_file($file) || !contentType($file)) {
    header('HTTP/1.1 404 Not Found');
}

if (!class_exists('Imagine\Gd\Imagine')) {
    header('Content-type: ' . contentType($file));
    readfile($file);
    return;
}

$cacheFile = __DIR__ . '/' . $path;
$cacheDir = dirname($cacheFile);
if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}
if (!is_dir($cacheDir)) {
    throw new Exception('Cache directory does not exist, and could not be created.');
}

$imagine = new Imagine\Gd\Imagine();
$size = new Imagine\Image\Box(50, 50);
$mode = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

$imagine->open($file)
    ->thumbnail($size, $mode)
    ->save($cacheFile);

header('Content-type: ' . contentType($cacheFile));
readfile($cacheFile);
