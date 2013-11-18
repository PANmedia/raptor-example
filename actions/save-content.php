<?php
include __DIR__ . '/../include.php';
$example = new Raptor\Revision\Example('Save Content');
$example->saveRevision(RAPTOR_DATA_DIR . '/content.json', RAPTOR_DATA_DIR . '/revisions.json');
echo $example->saveJson(RAPTOR_DATA_DIR . '/content.json');