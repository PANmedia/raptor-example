<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Section\Example('Section Example');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <style type="text/css">
        .top {
            min-height: 200px;
            margin: 0 0 10px 0;
        }

        .top-small {
            margin: 0 0 10px 0;
        }

        .left {
            width: 79%;
            float: left;
            min-height: 400px;
            box-sizing: border-box;
        }

        .right {
            width: 20%;
            float: right;
            min-height: 400px;
            box-sizing: border-box;
        }

        .raptor-section-item {
            border: 1px dotted #aaa;
        }

        .pane-horz,
        .pane-vert {
            border: 1px dotted #afa;
            min-height: 10px;
        }
        .pane-vert {
            float: left;
            width: 30%;
        }

        .raptor-section-item-active {
            border: 1px solid #faa;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <h1>Section Example</h1>
        <div>
            <div class="section top-small outline" data-id="1">
                <?= $example->renderSections(1); ?>
            </div>
            <div class="section top outline" data-id="2">
                <?= $example->renderSections(2); ?>
            </div>
            <div class="section left outline" data-id="3">
                <?= $example->renderSections(3); ?>
            </div>
            <div class="section right outline" data-id="4">
                <?= $example->renderSections(4); ?>
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
                        label: 'Embed',
                        title: 'Embed From Another Website',
                        type: 'embed',
                        choices: {
                            content: 'test'
                        }
                    }
                ]
            });
        }
    </script>
</body>
</html>
