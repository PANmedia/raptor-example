<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Section\Example('Section Example');
    $example->setLayouts([
        'col-2' => '
            <div data-layout="col-2" class="row">
                <div data-pane="1" class="col col6">{1}</div>
                <div data-pane="2" class="col col6 last">{2}</div>
            </div>
        ',
        'col-3' => '
            <div data-layout="col-3" class="row">
                <div data-pane="1" class="col col4">{1}</div>
                <div data-pane="2" class="col col4">{2}</div>
                <div data-pane="3" class="col col4 last">{3}</div>
            </div>
        ',
        'sidebar-right' => '
            <div data-layout="sidebar-right" class="row">
                <div data-pane="1" class="col col9">{1}</div>
                <div data-pane="2" class="col col3 last">{2}</div>
            </div>
        ',
        'sidebar-left' => '
            <div data-layout="sidebar-left" class="row">
                <div data-pane="2" class="col col3">{2}</div>
                <div data-pane="1" class="col col9 last">{1}</div>
            </div>
        '
    ]);
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <link rel="stylesheet" href="layout-grid.css" />
    <style type="text/css">
        .section {
            min-height: 300px;
            margin: 0 0 10px 0;
            padding: 5px;
        }

        .row {
            border: 1px dotted #0074D9;
            padding: 5px;
            margin: 5px;
        }

        .col {
            border: 1px dotted #2ECC40;
            padding: 5px;
            min-height: 50px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .row:after {
            content: " ";
            display: table;
            clear: both;
        }

        .row:after { clear: both; }

        .embed-container {
            position: relative;
            padding-bottom: 56.25%;
            padding-top: 30px;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            height: auto;
        }
        .embed-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>

    <div class="center half" data-id="body-1" >
        <h1>Section Layout Example.</h1>
        <div>
            <div class="section outline source-watch" data-id="1" data-output="#source">
                <?= $example->renderSections(1); ?>
            </div>
        </div>
        <div>
            <div class="section outline source-watch" data-id="1" data-output="#source">
                <?= $example->renderSections(1); ?>
            </div>
        </div>
        <div>
            <div class="section outline source-watch" data-id="1" data-output="#source">
                <?= $example->renderSections(1); ?>
            </div>
        </div>
        <div>
            <div class="section outline source-watch" data-id="1" data-output="#source">
                <?= $example->renderSections(1); ?>
            </div>
        </div>
    </div>
    <div id="source" class="center half"></div>

    <script id="youtube-dialog" type="text/x-template">
        <div>
            <div class="form-field">
                <label for="url" class="form-label">Youtube URL</label>
                <input type="text" name="url" id="url" placeholder="E.g. http://www.youtube.com/watch?v=76whNCgqYgw" class="form-text" />
            </div>
            <button id="insert">Insert</button>
            <button id="cancel">Cancel</button>
        </div>
    </script>

    <script type="text/javascript">
        var youtubeDialog = $(document.getElementById('youtube-dialog').innerHTML);
        youtubeDialog.find('button').button();

        function getYoutubeId(url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[7].length == 11) {
                return match[7];
            }
            return null;
        }

        var nodes = document.getElementsByClassName('section');
        for (var i = 0; i < nodes.length; i++) {
            var section = new RaptorSection({
                node: nodes[i],
                saveUrl: '../../actions/save-section.php',
                id: function(section) {
                    return section.getNode().dataset['id'];
                },
                layouts: [
                    {
                        name: 'col-2',
                        label: '2 Columns',
                        layout: <?= $example->getLayoutJson('col-2'); ?>
                    },
                    {
                        name: 'col-3',
                        label: '3 Columns',
                        layout: <?= $example->getLayoutJson('col-3'); ?>
                    },
                    {
                        name: 'sidebar-right',
                        label: 'Right Sidebar',
                        layout: <?= $example->getLayoutJson('sidebar-right'); ?>
                    },
                    {
                        name: 'sidebar-left',
                        label: 'Left Sidebar',
                        layout: <?= $example->getLayoutJson('sidebar-left'); ?>
                    }
                ],
                sections: [
                    {
                        name: 'raptor-block',
                        label: 'Raptor Block',
                        insert: function(sectionItem) {
                            sectionItem.innerHTML = '<div><p>Default content...</p></div>';
                            init(function($) {
                                $(sectionItem.firstChild).raptor(extendDefaults({
                                    autoEnable: true
                                }));
                            });
                        }
                    },
                    {
                        name: 'raptor-image',
                        label: 'Raptor Image',
                        insert: '<img src="../../partials/raptor.png" alt="Raptor Editor" />'
                    },
                    {
                        name: 'youtube',
                        label: 'Youtube Video',
                        choices: {
                            content: youtubeDialog.html()
                        },
                        bind: function(section, content) {
                            $(content).find('#insert').click(function() {
                                var url = $('#url').val(),
                                    id = getYoutubeId(url),
                                    embed = '<div class="embed-container"><iframe src="//www.youtube.com/embed/' + id + '" frameborder="0" allowfullscreen></iframe></div>';
                                section.choiceInsert(embed, {
                                    youtubeId: id
                                });
                            });
                            $(content).find('#cancel').click(function() {
                                $(this).closest('.ui-dialog-content').dialog('close');
                            });
                        }
                    }
                ]
            });
        }
    </script>
</body>
</html>