<?php
include __DIR__ . '/../include.php';
$example = new Raptor\Revision\Example('Revisions', RAPTOR_EDITOR_URI);
$example->saveRevision(__DIR__ . '/content.json', __DIR__ . '/revisions.json');
echo $example->saveJson(__DIR__ . '/content.json');