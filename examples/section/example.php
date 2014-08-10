<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Section\Example('Section Example');
    $example->setLayouts([
        'col-2' => '
            <div {{layout, col-2, 2 Column Layout}} class="layout-2-col layout-row">
                <div {{pane, 1, Left Pane}} class="layout-col layout-col-1">{1}</div>
                <div {{pane, 2, Right Pane}} class="layout-col layout-col-2 layout-col-last">{2}</div>
                <div style="clear:both"></div>
            </div>
        ',
        'col-3' => '
            <div {{layout, col-3, 3 Column Layout}} class="layout-3-col layout-row">
                <div {{pane, 1, Pane 1}} class="layout-col layout-col-1">{1}</div>
                <div {{pane, 2, Pane 2}} class="layout-col layout-col-2">{2}</div>
                <div {{pane, 3, Pane 3}} class="layout-col layout-col-3 layout-col-last">{3}</div>
                <div style="clear:both"></div>
            </div>
        ',
        'sidebar-right' => '
            <div {{layout, sidebar-right, Right Sidebar Layout}} class="layout-sidebar-right layout-row">
                <div {{pane, 1, Content Pane}} class="layout-col layout-content">{1}</div>
                <div {{pane, 2, Sidebar Pane}} class="layout-col layout-sidebar">{2}</div>
                <div style="clear:both"></div>
            </div>
        ',
        'sidebar-left' => '
            <div {{layout, sidebar-left, Left Sidebar Layout}} class="layout-sidebar-left">
                <div {{pane, 2, Content Pane}} class="layout-col layout-content">{2}</div>
                <div {{pane, 1, Sidebar Pane}} class="layout-col layout-sidebar">{1}</div>
                <div style="clear:both"></div>
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

        /* Debug styles */
        .section {
            background-color: rgba(0, 0, 0, 0.1);
        }

        /* Layouts */
        .layout-2-col .layout-col-1 {
            width: 49%;
            float: left;
        }

        .layout-2-col .layout-col-2 {
            width: 49%;
            float: right;
        }

        .layout-3-col .layout-col-1 {
            width: 32%;
            float: left;
        }

        .layout-3-col .layout-col-2 {
            width: 32%;
            float: left;
            margin-left: 2%;
        }

        .layout-3-col .layout-col-3 {
            width: 32%;
            float: right;
        }

        .layout-sidebar-right .layout-sidebar {
            float: right;
            width: 29%;
        }

        .layout-sidebar-right .layout-content {
            float: left;
            width: 69%;
        }

        .layout-sidebar-left .layout-sidebar {
            float: left;
            width: 29%;
        }

        .layout-sidebar-left .layout-content {
            float: right;
            width: 69%;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable center half" data-id="body-1">
        <h1>Section Example</h1>
        <div>
            <?= $example->renderContainer(1, 'top-small'); ?>
            <?= $example->renderContainer(2, 'top'); ?>
            <?= $example->renderContainer(3, 'left'); ?>
            <?= $example->renderContainer(4, 'right'); ?>
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
                            name: 'insert-dialog',
                            insert: function(sectionItem) {
                                this.sectionItem = sectionItem;
                                this.getDialog(sectionItem, false);
                            },
                            edit: function(sectionItem) {
                                var choices = sectionItem.raptorSectionItem.data.choice,
                                    dialog = this.getDialog(sectionItem, true);
                                for (var key in choices) {
                                    dialog.find('[name="' + key + '"]').val(choices[key]);
                                }
                            },
                            getDialog: function(sectionItem, editing) {
                                var dialog = $(<?= $dialog; ?>);
                                dialog.dialog({
                                    title: 'Insert Quick Link',
                                    modal: true,
                                    close: function() {
                                        if (!editing) {
                                            sectionItem.parentNode.removeChild(sectionItem);
                                        }
                                        dialog.dialog('destroy').remove();
                                    },
                                    buttons: [
                                        {
                                            text: 'Insert',
                                            click: function() {
                                                var content = <?= $content; ?>;
                                                sectionItem.raptorSectionItem.choice = {};
                                                content = content.replace(/{{(.*?)}}/g, function(match, token) {
                                                    var value = dialog.find('[name="' + token + '"]').val();
                                                    sectionItem.raptorSectionItem.choice[token] = value;
                                                    return value;
                                                });
                                                sectionItem.innerHTML = content;
                                                dialog.dialog('destroy').remove();
                                            }
                                        }
                                    ]
                                });
                                return dialog;
                            }
                        },
                        {
                            label: 'Ajax Content',
                            name: 'ajax-content',
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
                            name: 'raptor-block',
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
