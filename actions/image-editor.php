<?php
/**
 * RFM example action handler.
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
require_once __DIR__ . '/../include.php';

try {
    $imageEditor = new RIE\ImageEditor();
    $imageEditor->setRoot(RAPTOR_EXAMPLE_DIR . '/uploads/');
    $action = $imageEditor->getAction();
    $action();
} catch (RIE\ClientException $exception) {
    header('HTTP/1.1 400 Client Error');
    echo $exception->getMessage();
} catch (RIE\ImageEditorException $exception) {
    header('HTTP/1.1 500 Server Error');
    echo $exception->getMessage();
}
