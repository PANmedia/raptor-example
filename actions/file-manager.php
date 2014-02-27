<?php
/**
 * RFM example action handler.
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
require_once __DIR__ . '/../include.php';


try {
    $fileManager = new RFM\FileManager();
    $fileManager->setRoot(RAPTOR_DATA_DIR . '/uploads/');
    $action = $fileManager->getAction();
    $action();
} catch (RFM\ClientException $exception) {
    header('HTTP/1.1 400 Client Error');
    echo $exception->getMessage();
} catch (Exception $exception) {
    header('HTTP/1.1 500 Server Error');
    echo $exception->getMessage();
}
