<?php
    include __DIR__ . '/../../include.php';
    include __DIR__ . '/amazon-s3-key.php';
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
                        s3: {
                            bucketURL: <?= json_encode($buckerUrl); ?>,
                            accessKeyId: <?= json_encode($accessKeyId); ?>,
                            policy: <?= json_encode($policy); ?>,
                            signature: <?= json_encode($signature); ?>
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
            <h1>Raptor Editor - File Manager Example</h1>
            <p>One</p>
            <p>Two</p>
            <p>Three</p>
        <?= $example->renderContent('body-1', ob_get_clean()); ?>
    </div>
</body>
</html>
