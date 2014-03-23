<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Basic');
?>
<!doctype html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300|Alegreya+Sans:300|Raleway:300' rel='stylesheet' type='text/css' />
    <style type="text/css">
        .cms-font-raleway {
            font-family: 'Raleway', sans-serif;
        }
        .cms-font-alegreya {
            font-family: 'Alegreya Sans SC', sans-serif;
        }
        .light {
            font-family: 'Alegreya Sans', sans-serif;
        }
    </style>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            extendLocale('en', {
                fontFamilyMenuFontRaleway: 'Raleway',
                fontFamilyMenuFontAlegreya: 'Alegreya',
            });
            $('.editable').raptor(extendDefaults({
                plugins: {
                    fontFamilyMenu: {
                        fonts: [
                            'raleway',
                            'alegreya',
                        ],
                    }
                }
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch" data-output="#source" data-target=".editable">
        <div class="editable center half light" data-id="body-1">
            <?= $example->renderContent('body-1', $example->getDefaultContent()); ?>
        </div>
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
