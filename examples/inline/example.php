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
                preset: 'inline'
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="wrapper center">
        <?php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success') {
                    echo '<p>Successfully saved comment.</p>';
                } elseif ($_GET['status'] == 'failed') {
                    echo '<p>Failed to save comment.</p>';
                }
            }
        ?>
        <form action="<?= RAPTOR_EXAMPLE_URI; ?>actions/save-comment.php" method="post" class="center half">
            <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI']; ?>" />
            <h1>Raptor Inline Example</h1>
            <div class="source-watch" data-output="#source" data-target=".editable">
                <textarea name="comment" class="editable"></textarea>
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
