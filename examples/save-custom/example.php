<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Revision\RestExample('Save Custom');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                plugins: {
                    save: {
                        callback: function() {
                            alert(this.raptor.getHtml());
                        }
                    }
                }
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch center half" data-output="#source">
        <div class="full editable" data-id="header">
            <?= $example->renderContent('header', $example->getDefaultContent('header')); ?>
        </div>
        <div class="content editable" data-id="body">
            <?= $example->renderContent('body', $example->getDefaultContent('body')); ?>
        </div>
        <div class="sidebar editable" data-id="sidebar">
            <?= $example->renderContent('sidebar', $example->getDefaultContent('sidebar')); ?>
        </div>
        <div style="clear:both"></div>
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
