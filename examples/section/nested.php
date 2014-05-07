<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Section\Example('Section Example');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <style type="text/css">
        .section {
            min-height: 200px;
            margin: 0 0 10px 0;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <h1>Section Example</h1>
        <div>
            <div class="section" data-id="1">
                <?= $example->renderSections(1); ?>
                <div class="section" data-id="2">
                    <?= $example->renderSections(2); ?>
                </div>
            </div>
            <div class="section" data-id="3">
                <?= $example->renderSections(3); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var nodes = document.getElementsByClassName('section');
        for (var i = 0; i < nodes.length; i++) {
            var section = new RaptorSection({
                node: nodes[i],
                saveUrl: '../../actions/save-section.php',
                id: function(section) {
                    return section.getNode().dataset['id'];
                },
                sections: [
                    {
                        label: 'Nest Item',
                        type: 'nested-item',
                        insert: function(sectionItem) {
                            sectionItem.innerHTML = '<div><p>Nest items.</p></div>';
                        },
                        choice: 'test'
                    }
                ]
            });
        }
    </script>
</body>
</html>
