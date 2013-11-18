<?php
require_once __DIR__ . '/../include.php';    
file_put_contents(RAPTOR_DATA_DIR . '/comments.json', '');
file_put_contents(RAPTOR_DATA_DIR . '/content.json', '');
file_put_contents(RAPTOR_DATA_DIR . '/revisions.json', '');
file_put_contents(RAPTOR_DATA_DIR . '/sections.json', '');
if (isset($_REQUEST['redirect'])) {
    header('Location: ' . $_REQUEST['redirect']);
} else {
    echo 'Save data cleared.';
}
