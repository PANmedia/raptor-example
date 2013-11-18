<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('File Manager');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                plugins: {
                    fileManager: {
                        uriPublic: '<?= RAPTOR_EXAMPLE_URI; ?>data/uploads/',
                        uriAction: '<?= RAPTOR_EXAMPLE_URI; ?>actions/file-manager.php',
                        uriIcon: '<?= RAPTOR_EXAMPLE_URI; ?>examples/file-manager/icon/'
                    }
                }
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <?php ob_start(); ?>
            <h1>Raptor Editor - File Manager Example</h1>
            <p>One</p>
            <p>Two</p>
            <p>Three</p>
        <?= $example->renderContent('body-1', ob_get_clean()); ?>
    </div>
</body>
</html>
