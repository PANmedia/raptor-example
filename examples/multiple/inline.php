<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Multiple Inline');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            Raptor.presets.inline.layouts.toolbar.uiOrder.unshift(['viewSource']);
            $('.editable').raptor(extendDefaults({
                preset: 'inline'
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="wrapper center">
        <form action="<?= RAPTOR_EXAMPLE_URI; ?>actions/save-comment.php" method="post" class="center half">
            <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI']; ?>" />
            <h1>Raptor Multiple Inline Example</h1>
            <div>
                <textarea name="one" class="editable"></textarea>
                <textarea name="two" class="editable"></textarea>
                <textarea name="three" class="editable"></textarea>
                <textarea name="four" class="editable"></textarea>
            </div>
        </form>
    </div>
</body>
</html>
