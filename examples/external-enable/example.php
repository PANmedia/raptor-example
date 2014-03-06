<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Autoenable');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <style type="text/css">
        .raptor-editable-block-hover {
            background: none !important;
        }
    </style>
    <script type="text/javascript">
        init(function($) {
            $('.enable').button().click(function() {
                $('.editable').data('uiRaptor').enableEditing();
            });
            $('.disable').button().click(function() {
                $('.editable').data('uiRaptor').disableEditing();
            });
            $('.editable').raptor(extendDefaults({
                layouts: {
                    hoverPanel: false
                }
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch center half" data-output="#source" data-target=".editable">
        <button class="enable">Enable Editing</button>
        <button class="disable">Disable Editing</button>
        <div class="editable" data-id="body-1">
            <?= $example->renderContent('body-1', $example->getDefaultContent()); ?>
        </div>
    </div>
    <div id="source"></div>
</body>
</html>
