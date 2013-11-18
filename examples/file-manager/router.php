<?php
/**
 * RFM example router for serving icons in the built in PHP server.
 *
 * @author David Neilsen <david@panmedia.co.nz>
 */
ini_set('display_errors', true);
error_reporting(E_ALL);
if (preg_match('/^.*\/icon\/file\/(.*)$/', $_SERVER['REQUEST_URI'], $matches)) {
    $_REQUEST['path'] = $matches[1];
    include __DIR__ . '/icon/file/index.php';
    return true;
}

return false;
