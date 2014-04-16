<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Disable Preview');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                preview: false
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch" data-output="#source" data-target=".editable">
        <div class="editable center half" data-id="body-1">
            <?= $example->renderContent('body-1', $example->getDefaultContent()); ?>
        </div>
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
