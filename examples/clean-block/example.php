<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Basic');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(extendDefaults({
                autoEnable: true
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch" data-output="#source" data-target=".editable">
        <div class="editable center half" data-id="body-1">
            <?php ob_start(); ?>
            <h4><strong class="cms-bold" style="color: rgb(234, 89, 10); font-family: proxima-nova, Helvetica, Arial, sans-serif; font-size: 1.3125em; line-height: 1.71429em;">Welcome to Some Random Website</strong><span style="color: rgb(234, 89, 10); font-family: proxima-nova, Helvetica, Arial, sans-serif; line-height: 1.71429em; font-size: 12px;">&nbsp;</span><br></h4>

            <p>This is not real content that I took from a website as an example context of dirty content.&nbsp;</p>
            <ul><li>Raptor&nbsp;</li><li>Rocks</li><li>Many peoples</li><li>Socks &nbsp;</li><li>Lets clean this mess up &nbsp;<span style="font-size: 12px; text-indent: -1.25em;">&nbsp;</span></li></ul><h4><span style="font-family: proxima-nova, Helvetica, Arial, sans-serif; font-size: 1.125em; line-height: 1.33333em;"><span class="cms-color cms-red"><strong class="cms-bold"><span class="cms-color cms-green">The end, thanks for watching.</span></strong></span></span></h4><h4><font size="4"><span class="cms-color cms-red"></span></font><small class="cms-small"><font size="4"><span class="cms-color cms-red"></span></font></small></h4>
            <?= $example->renderContent('body-1', ob_get_clean()); ?>
        </div>
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
