<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Table');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(defaultOptions);
            $('tbody td').each(function() {
                var index = tableGetCellIndex(this);
                $(this).html($(this).html() + ' [' + index.x + ', ' + index.y + ']');
            });
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <?php ob_start(); ?>
        <h1>Raptor Editor - Table Example</h1>
        <table>
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Cell</b></td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td rowspan="2">Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td colspan="2">Cell</td>
                    <td rowspan="2">Cell</td>
                    <td>Cell</td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td colspan="2">Cell</td>
                    <td>Cell</td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td colspan="2">Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Header</th>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
            </tfoot>
        </table>
        <?= $example->renderContent('body-1', ob_get_clean()); ?>
    </div>

</body>
</html>
