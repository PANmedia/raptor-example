<?php
include __DIR__ . '/../include.php';
$example = new Raptor\Revision\Example('Revisions');
echo $example->renderRevisions();
