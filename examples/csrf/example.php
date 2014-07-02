<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\CSRF\Example('CSRF');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        var csrf = <?= json_encode($example->generateCsrf()); ?>;
        init(function($) {
            $('.editable').raptor(extendDefaults({
                autoEnable: true,
                plugins: {
                    save: {
                        checkDirty: false
                    },
                    saveJson: {
                        url: '../../actions/save-content-json-csrf.php',
                        postName: 'raptor-content',
                        checkDirty: false,
                        retain: true,
                        post: function(data) {
                            data.csrf = csrf;
                            return data;
                        },
                        formatResponse: function(data) {
                            return data.message;
                        }
                    }
                },
                bind: {
                    saved: function(data, status, xhr) {
                        csrf = data.csrf;
                    },
                    saveFailed: function(data, status, xhr) {
                        csrf = data.csrf;
                    }
                }
            }));
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
