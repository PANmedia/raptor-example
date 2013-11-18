<?php
include __DIR__ . '/../include.php';
$example = new Raptor\Comment\Example('Save Comment');

$redirect = isset($_POST['redirect']) ? $_POST['redirect'] : '/';

if ($example->saveComment(RAPTOR_DATA_DIR . '/comments.json')) {
    header("Location: $redirect?status=success");
} else {
    header("Location: $redirect?status=failed");
}
