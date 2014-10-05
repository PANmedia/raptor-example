<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Comment\Example('Inline');
    $content = $example->getContent();
    ksort($content);
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                preset: 'inline',
                bind: {
                    layoutShow: function() {
                        setTimeout(function() {
                            this.getElement().closest('.source-watch').find('.ui-notification').hide();
                            this.getElement().show();
                            this.getElement().parent().show();
                        }.bind(this), 1000);
                    }
                }
            }));
        });
    </script>
    <style>
        body {
            background-color: #555;
            color: #eee;
        }
        #source {
            background-color: white;
            border: 1px solid #c1c1c1;
        }
        .editable {
            display: none;
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="wrapper center">
        <form action="<?= RAPTOR_EXAMPLE_URI; ?>actions/save-comment.php" method="post" class="center half">
            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="ui-widget ui-notification">
                    <div class="ui-state-confirmation ui-corner-all">
                        <p>
                            <span class="ui-icon ui-icon-error"></span>
                            <strong>Success:</strong> Successfully saved comment.
                        </p>
                    </div>
                </div>
            <?php elseif (isset($_GET['status']) && $_GET['status'] == 'failed'): ?>
                <div class="ui-widget ui-notification">
                    <div class="ui-state-error ui-corner-all">
                        <p>
                            <span class="ui-icon ui-icon-error"></span>
                            <strong>Alert:</strong> Failed to save comment. <?= isset($_GET['message'])  ? $_GET['message'] : ''; ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <input type="hidden" name="redirect" value="<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>" />
            <h1>Raptor Inline Example</h1>
            <div class="source-watch" data-output="#source" data-target=".editable">
                <textarea name="comment" class="editable"></textarea>
                <div class="ui-notification">
                    <div class="ui-state-information ui-corner-all">
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
            <br/>
            <button>Submit</button>
        </form>
        <div class="center half">
            <?php foreach ($content as $key => $comment): ?>
                <h4><?= date('Y-m-d H:i:s', $key); ?></h4>
                <div>
                    <?= $comment; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="source" class="center half"></div>
    </div>
</body>
</html>
