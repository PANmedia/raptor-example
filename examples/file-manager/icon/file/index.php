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

if (is_file($file) && contentType($file)) {
    header('Content-type: ' . contentType($file));
    readfile($file);
} else {
    header('HTTP/1.1 404 Not Found');
}
