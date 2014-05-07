<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Section\Example('Section Example');
    $example->setLayouts([
        'col-2' => '
            <div data-layout="col-2" data-title="2 Column Layout" class="layout-col-2 layout-row">
                <div data-pane="1" data-title="Left Pane" class="layout-col layout-col-1">{1}</div>
                <div data-pane="2" data-title="Right Pane" class="layout-col layout-col-2 layout-col-last">{2}</div>
            </div>
        ',
        'col-3' => '
            <div data-layout="col-3" data-title="3 Column Layout" class="layout-col-3 layout-row">
                <div data-pane="1" data-title="Left Pane" class="layout-col layout-col-1">{1}</div>
                <div data-pane="2" data-title="Middle Pane" class="layout-col layout-col-2">{2}</div>
                <div data-pane="3" data-title="Right Pane" class="layout-col layout-col-3 layout-col-last">{3}</div>
            </div>
        ',
        'sidebar-right' => '
            <div data-layout="sidebar-right" data-title="Right Sidebar Layout" class="layout-sidebar-right layout-row">
                <div data-pane="1" data-title="Content Pane" class="layout-col layout-content">{1}</div>
                <div data-pane="2" data-title="Sidebar Pane" class="layout-col layout-sidebar">{2}</div>
            </div>
        ',
        'sidebar-left' => '
            <div data-layout="sidebar-left" data-title="Left Sidebar Layout" class="row">
                <div data-pane="2" data-title="Sidebar Pane" class="col col3">{2}</div>
                <div data-pane="1" data-title="Content Pane" class="col col9 last">{1}</div>
            </div>
        '
    ]);

    $dialog = json_encode("
        <div>
            <div class='form-field'>
                <label class='form-label'>Description</label>
                <input class='form-text' type='text' name='description' />
            </div>
            <div class='form-field'>
                <label class='form-label'>Text</label>
                <input class='form-text' type='text' name='text' />
            </div>
            <div class='form-field'>
                <label class='form-label'>Link</label>
                <input class='form-text' type='text' name='link' />
            </div>
        </div>
    ");

    $content = json_encode("
        <div class='button-set'>
            <div class='button-set-text'>{{description}}</div>
            <a href='{{link}}' class='button-set-link'>{{text}}</a>
        </div>
    ");
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

        .button-set {
            background: linear-gradient(to bottom, #ffc578 0%,#fb9d23 100%);
            border-radius: 10px;
            border-top: 1px solid #ffc578;
            box-sizing: border-box;
            padding: 15px;
            text-align: center;
            width: 100%;
        }

        .button-set-text {
            margin-bottom: 10px;
        }

        .button-set-link {
            background: linear-gradient(to bottom, #b8e1fc 0%,#a9d2f3 10%,#90bae4 25%,#90bcea 37%,#90bff0 50%,#6ba8e5 51%,#a2daf5 83%,#bdf3fd 100%);
            border-radius: 10px;
            border-top: 1px solid #b8e1fc;
            box-sizing: border-box;
            color: #fff;
            display: inline-block;
            min-width: 80%;
            padding: 15px;
            text-align: center;
            text-shadow: 1px 1px #000;
        }

        /*
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
        */
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <h1>Section Example</h1>
        <div>
            <div class="section top-small outline" data-id="1" data-title="Small Top Container">
                <?= $example->renderSections(1); ?>
            </div>
            <div class="section top outline" data-id="2" data-title="Top Container">
                <?= $example->renderSections(2); ?>
            </div>
            <div class="section left outline" data-id="3" data-title="Content Container">
                <?= $example->renderSections(3); ?>
            </div>
            <div class="section right outline" data-id="4" data-title="Sidebar Container">
                <?= $example->renderSections(4); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        (function($) {
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
                            label: 'Insert via Dialog',
                            title: 'Insert via Dialog',
                            type: 'insert-dialog',
                            dialog: null,
                            insert: function(sectionItem) {
                                this.sectionItem = sectionItem;
                                this.getDialog().dialog('open');
                            },
                            getDialog: function() {
                                if (!this.dialog) {
                                    this.dialog = $(<?= $dialog; ?>);
                                    this.dialog.dialog({
                                        title: 'Insert Quick Link',
                                        modal: true,
                                        buttons: [
                                            {
                                                text: 'Insert',
                                                click: function() {
                                                    var content = <?= $content; ?>;
                                                    this.sectionItem.raptorSectionItem.choice = {};
                                                    content = content.replace(/{{(.*?)}}/g, function(match, token) {
                                                        var value = this.dialog.find('[name=\"' + token + '\"]').val();
                                                        this.sectionItem.raptorSectionItem.choice[token] = value;
                                                        return value;
                                                    }.bind(this));
                                                    this.sectionItem.innerHTML = content;
                                                    this.dialog.dialog('close');
                                                }.bind(this)
                                            }
                                        ]
                                    });
                                }
                                return this.dialog;
                            }
                        },
                        {
                            label: 'Ajax Chooser',
                            title: 'Make a Choice',
                            type: 'ajax-choice-example',
                            choices: {
                                url: 'ajax-choices.php'
                            },
                            bind: function(section, content) {
                                $(content).on('click', 'button', function() {
                                    section.choiceInsert('<script src="test.js"></'+'script>', 'test');
    //                                section.choiceInsert($(this).closest('tr').text(), 'test');
                                });
                            }
                        },
                        {
                            label: 'Ajax Content',
                            type: 'ajax-content',
                            insert: function(sectionItem) {
                                sectionItem.innerHTML = 'Loading...';
                                $.ajax({
                                    url: 'ajax-content.php',
                                    dataType: 'json'
                                }).done(function(response) {
                                    sectionItem.innerHTML = response.html;
                                }).fail(function() {
                                    sectionItem.innerHTML = 'Failed to load content';
                                });
                            }
                        },
                        {
                            label: 'Raptor Block',
                            type: 'raptor-block',
                            insert: function(sectionItem) {
                                sectionItem.innerHTML = '<div><p>Add new content here.</p></div>';
                                $(sectionItem.firstChild).raptor(extendDefaults({
                                    autoEnable: true
                                }));
                            }
                        }
                    ]
                });
            }
        })(init);
    </script>
</body>
</html>
