<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Basic');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('iframe').load(function() {
                $(this).contents().find('.editable').raptor(extendDefaults({
                    autoEnable: true
                }));
            });
        });
    </script>
    <style type="text/css">
        iframe {
            width: 100%;
            border: 1px dotted #aaa;
            margin: 5px;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch" data-output="#source" data-target=".editable">
        <div class="center half" data-id="body-1">
            <iframe src="iframe.php" seamless="seamless"></iframe>
        </div>
    </div>
    <div id="source" class="center half"></div>
    <script type="text/javascript" src="autoheight.js"></script>
</body>
</html>
