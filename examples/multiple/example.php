<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Multiple Blocks');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                autoEnable: true
            }));
        });
    </script>
    <style type="text/css">
        .editable {
            width: 300px;
            height: 300px;
            float: left
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="wrapper center">
        <div class="center half">
            <h1>Raptor Multiple Blocks Example</h1>
            <div class="editable outline" data-id="body-1">
                <?php ob_start(); ?>
                One
                <?= $example->renderContent('body-1', ob_get_clean()); ?>
            </div>
            <div class="editable outline" data-id="body-2">
                <?php ob_start(); ?>
                Two
                <?= $example->renderContent('body-2', ob_get_clean()); ?>
            </div>
            <div class="editable outline" data-id="body-3">
                <?php ob_start(); ?>
                Three
                <?= $example->renderContent('body-3', ob_get_clean()); ?>
            </div>
            <div class="editable outline" data-id="body-4">
                <?php ob_start(); ?>
                Four
                <?= $example->renderContent('body-4', ob_get_clean()); ?>
            </div>
        </div>
    </div>
</body>
</html>
