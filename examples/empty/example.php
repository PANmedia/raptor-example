<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Empty');
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
            min-height: 10px;
            border: 1px dotted black;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <?= $example->renderContent('body-1', ''); ?>
    </div>
</body>
</html>
