<?php
include __DIR__ . '/../include.php';
$example = new Raptor\Section\Example('Save Section');
echo $example->saveSection(RAPTOR_DATA_DIR . '/sections.json');

