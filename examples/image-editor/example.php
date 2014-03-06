<?php
    if (isset($_POST['image'])) {
        if (preg_match('/^data:(.*?);/', $_POST['image'], $matches)) {
            header('Content-Type: ' . $matches[1]);
            echo file_get_contents($_POST['image']);
            die();
        }
    }
    include __DIR__ . '/../../include.php';
    $example = new Raptor\ImageEditor\Example('Image Editor Example');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <style type="text/css">
        body {
            height: 3000px;
            background-size: 50px 50px;
            background-color: #0ae;
            background-image: -webkit-linear-gradient(rgba(255, 255, 255, .2) 50%, transparent 50%, transparent);
            background-image: -moz-linear-gradient(rgba(255, 255, 255, .2) 50%, transparent 50%, transparent);
            background-image: linear-gradient(rgba(255, 255, 255, .2) 50%, transparent 50%, transparent);
        }
    </style>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="center half">
        <h1>Image Editor Example</h1>
        <div id="saved-confirmation" class="ui-widget ui-notification" style="display: none">
            <div class="ui-state-confirmation ui-corner-all">
                <span class="ui-icon ui-icon-confirmation"></span>
                <ul>
                    <li id="rie-error-text">Sucesssfully saved image.</li>
                </ul>
            </div>
        </div>
        <form action="" method="post">
            <img id="image-editor" src="../../partials/raptor.png" data-id="raptor-example/partials/raptor.png" />
        </form>
    </div>
    <script type="text/javascript">
        var image = document.getElementById('image-editor'),
            rie = new RIE({
                node: image,
                bind: {
                    save: function() {
                        rie.saveTo('../../actions/image-editor.php', image.dataset.id, function() {
                            jQuery('#saved-confirmation').show();
                        });
                    }
                }
            });
    </script>
</body>
</html>
