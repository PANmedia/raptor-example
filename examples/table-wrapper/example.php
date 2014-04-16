<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Table Wrapper');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(defaultOptions);
        });
    </script>
    <style type="text/css">
        .test-cell {
            vertical-align: top;
        }
        .editable {
            min-height: 100px;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <?php ob_start(); ?>
    <p>Paragraph</p>
    <table>
        <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
        </tr>
        <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
        </tr>
    </table>
    <p>Paragraph</p>
    <?php $content = ob_get_clean(); ?>
    <div class="source-watch" data-output="#source">
        <table class="center half">
            <tr>
                <td class="test-cell">
                    <div class="editable" data-id="body-1">
                        <?= $example->renderContent('body-1', $content); ?>
                    </div>
                </td>
                <td class="test-cell">
                    <div class="editable" data-id="body-2">
                        <?= $example->renderContent('body-2', $content); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="test-cell">
                    <div class="editable" data-id="body-3">
                        <?= $example->renderContent('body-3', $content); ?>
                    </div>
                </td>
                <td class="test-cell">
                    <div class="editable" data-id="body-4">
                        <?= $example->renderContent('body-4', $content); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
