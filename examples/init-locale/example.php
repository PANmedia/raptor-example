<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Init Locale');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                initialLocale: 'fr'
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable half center" id="left" data-id="body-1">
        <?php ob_start(); ?>
            <h1>Raptor Editor - Initial Locale Example</h1>
            <p>
                Some paragraph text.
            </p>
        <?= $example->renderContent('body-1', ob_get_clean()); ?>
    </div>
</body>
</html>
