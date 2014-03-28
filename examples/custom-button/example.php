<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Custom Button');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        Raptor.extendLocale('en', {
            customButtonTitle: 'My Custom Button'
        });
        Raptor.registerUi(new Raptor.Button({
            name: 'customButton',
            click: function() {
                Raptor.selectionReplace('<b>My super awesome button</b>');
            }
        }));
        Raptor.presets[preset].layouts.toolbar.uiOrder[0].unshift('customButton');
        init(function($) {
            $('.editable').raptor(defaultOptions);
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
