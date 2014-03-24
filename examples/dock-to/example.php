<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Dock To');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                autoEnable: true,
                plugins: {
                    dock: {
                        dockToElement: true,
                        docked: true,
                        dockTo: '#top'
                    }
                }
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch center half" data-output="#source" data-target=".editable">
        <h1>Dock To Example</h1>
        <div id="top"></div>
        <div class="editable content" data-id="body-1">
            <?= $example->renderContent('body-1', $example->getDefaultContent()); ?>
        </div>
        <div class="editable sidebar" data-id="sidebar-1">
            <?php ob_start(); ?>
            <ul>
                <li>List item 1</li>
                <li>List item 2</li>
                <li>List item 3</li>
                <li>List item 4</li>
                <li>List item 5</li>
                <li>List item 6</li>
            </ul>
            <?= $example->renderContent('sidebar-1', ob_get_clean()); ?>
        </div>
    </div>
    <div style="clear:both;"></div>
    <div id="source" class="center half"></div>
</body>
</html>
