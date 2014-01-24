<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Source View');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <link rel="stylesheet" href="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/lib/codemirror.css" />
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>beautify-html.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/lib/codemirror.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/javascript/javascript.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/xml/xml.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/css/css.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                partialEdit: '.box'
            }));
        });
    </script>
    <style type="text/css">
        .box {
            width: 40%;
            margin: 10px 4%;
            display: inline-block;
            box-sizing: border-box;
            outline: 1px solid #aaa;
        }
        .editable {
            outline: 1px solid #aaa;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch" data-output="#source" data-target=".editable">
        <div class="editable half" data-id="body-1">
            <?php ob_start(); ?>
                <h1>Partial editing</h1>
                <div class="box">
                    <p>You can edit me.</p>
                </div>
                <div class="box">
                    <p>You can edit me.</p>
                </div>
                <p>But you cannot edit me.</p>
                <div class="box">
                    <p>You can edit me.</p>
                </div>
                <div class="box">
                    <p>You can edit me.</p>
                </div>
            <?= $example->renderContent('body-1', ob_get_clean()); ?>
        </div>
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
