<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Section');
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
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <h1>Section Example</h1>
        <div>
            <div class="section top-small outline">
            </div>
            <div class="section top outline">
            </div>
            <div class="section left outline">
            </div>
            <div class="section right outline">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.section').raptorSection({
            sections: [
                {
                    label: 'Banner',
                },
                {
                    label: 'Navigation',
                },
                {
                    label: 'Content',
                    insert: function(sectionItem) {
                        sectionItem.innerHTML = '<div><p>Add new content here.</p></div>';
                        $(sectionItem.firstChild).raptor({
                            autoEnable: true
                        });
                    }
                }
            ]
        });
    </script>
</body>
</html>
