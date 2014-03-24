<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Basic');
?>
<!doctype html>
<html>
<head>
    <style type="text/css">
        .cms-raptor-orange {
            color: #ff8a07;
        }
        .cms-sabertooth-red {
            color: #cd2c31;
        }
        .cms-mammoth-blue {
            color: #22a1db;
        }
    </style>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            extendLocale('en', {
                colorMenuBasicRaptorOrange: 'Raptor Orange',
                colorMenuBasicSabertoothRed: 'Sabertooth Red',
                colorMenuBasicMammothBlue: 'Mammoth Blue'
            });
            $('.editable').raptor(extendDefaults({
                plugins: {
                    colorMenuBasic: {
                        colors: {
                            'raptor-orange': '#ff8a07',
                            'sabertooth-red': '#cd2c31',
                            'mammoth-blue': '#22a1db'
                        }
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
