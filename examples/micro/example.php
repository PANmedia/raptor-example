<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Micro');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                preset: 'micro'
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="center half">
        <h1 class="editable">Raptor Editor - Micro Example</h1>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        </p>
        <p>
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
        </p>
        <p>
            It has survived not only five centuries, but also the leap into electronic typesetting, 
            remaining essentially unchanged. 
        </p>
    </div>
</body>
</html>
