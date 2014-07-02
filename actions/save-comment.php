<?php
include __DIR__ . '/../include.php';
$redirect = isset($_POST['redirect']) ? $_POST['redirect'] : '/';
try {
    $example = new Raptor\Comment\Example('Save Comment');
    $example->save();
    header("Location: $redirect?status=success");
} catch (Raptor\ClientException $exception) {
    http_response_code(400);
    header("Location: $redirect?status=failed&message=" . urlencode($exception->getMessage()));
} catch (Raptor\ServerException $exception) {
    http_response_code(500);
    header("Location: $redirect?status=failed&message=" . urlencode($exception->getMessage()));
}
