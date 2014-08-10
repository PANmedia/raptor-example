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
            $('.editable').raptor(defaultOptions);
        });
    </script>
    <style type="text/css">
        .editable {
            width: 45%;
            min-height: 300px;
            float: left;
            margin: 1%;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <h1>Raptor Multiple Blocks Example</h1>
    <div class="editable outline" data-id="body-1">
        <?= $example->renderContent('body-1', $example->getDefaultContent()); ?>
    </div>
    <div class="editable outline" data-id="body-2">
        <?= $example->renderContent('body-2', $example->getDefaultContent()); ?>
    </div>
    <div class="editable outline" data-id="body-3">
        <?= $example->renderContent('body-3', $example->getDefaultContent()); ?>
    </div>
    <div class="editable outline" data-id="body-4">
        <?= $example->renderContent('body-4', $example->getDefaultContent()); ?>
    </div>
</body>
</html>
