<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Revision\JsonExample('Revisions');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <title>Raptor Editor - Revisions Example</title>
    <script type="text/javascript">
        init(function($) {
            $('#left').raptor(extendDefaults({
                preset: 'mammoth',
                plugins: {
                    revisions: {
                        url: function() {
                            var id = this.raptor.getElement().data('id');
                            if (id) {
                                return '../../actions/revisions.php?id=' + id;
                            }
                        }
                    }
                }
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" id="left" data-id="body-1">
        <?php ob_start(); ?>
            <h1>Raptor Editor - Revisions Example</h1>
            <p>One</p>
            <p>Two</p>
            <p>Three</p>
        <?= $example->renderContent('body-1', ob_get_clean()); ?>
    </div>
</body>
</html>
