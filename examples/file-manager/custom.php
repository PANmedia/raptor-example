<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Custom File Manager');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                preset: 'full',
                plugins: {
                    fileManager: false,
                    insertFile: {
                        customAction: function() {
                            this.insertFiles([{
                                location: prompt('Full URL to file:'),
                                name: 'Some file name'
                            }]);
                        }
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
            <h1>Raptor Editor - Custom File Manager Example</h1>
            <p>One</p>
            <p>Two</p>
            <p>Three</p>
        <?= $example->renderContent('body-1', ob_get_clean()); ?>
    </div>
</body>
</html>
