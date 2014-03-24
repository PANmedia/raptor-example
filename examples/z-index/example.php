<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Autoenable');
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
        .box {
            background-color: #4CFF2F;
            position: relative;
            margin: 0 auto;
        }
        .box,
        .box .editable {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="box" style="z-index: 5000;">
        <div class="editable" data-id="body-3'">
            <?= $example->renderContent('body-3', 5000); ?>
        </div>
    </div>
    <div class="box" style="z-index: 1000;">
        <div class="editable" data-id="body-2">
            <?= $example->renderContent('body-2', 1000); ?>
        </div>
    </div>
    <div class="box" style="z-index: 1;">
        <div class="editable" data-id="body-1">
            <?= $example->renderContent('body-1', 1); ?>
        </div>
    </div>
</body>
</html>
