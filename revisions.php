<?php
include __DIR__ . '/../include.php';
$example = new Raptor\Revision\Example('File Manager', RAPTOR_EDITOR_URI);
echo $example->renderRevisions(__DIR__ . '/content.json', __DIR__ . '/revisions.json');
