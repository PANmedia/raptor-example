<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Auto Select');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <script type="text/javascript">
        init(function($) {
            $('.editable:eq(0)').raptor(extendDefaults({
                autoSelect: 'start'
            }));
            $('.editable:eq(1)').raptor(extendDefaults({
                autoSelect: 'end'
            }));
            $('.editable:eq(2)').raptor(extendDefaults({
                autoSelect: 'all'
            }));
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch" data-output="#source" data-target=".editable">
        <div class="editable third" data-id="body-1">
            <?php ob_start(); ?>
            <h1>Set selection at start</h1>
            <p>
                In publishing and graphic design, placeholder text is commonly used to demonstrate the
                elements of a document or visual presentation, such as font, typography, and layout. Even
                though using "lorem ipsum" often arouses curiosity because of its resemblance to classical
                Latin, it is not intended to have meaning. Where text is visible in a document, people tend
                to focus on the textual content rather than upon overall presentation, so publishers use
                lorem ipsum when displaying a typeface or design elements and page layout in order to direct
                the focus to the publication style and not the meaning of the text.
            </p>
            <?= $example->renderContent('body-1', ob_get_clean()); ?>
        </div>
        <div class="editable third" data-id="body-2">
            <?php ob_start(); ?>
            <h1>Set selection at end</h1>
            <p>
                In publishing and graphic design, placeholder text is commonly used to demonstrate the
                elements of a document or visual presentation, such as font, typography, and layout. Even
                though using "lorem ipsum" often arouses curiosity because of its resemblance to classical
                Latin, it is not intended to have meaning. Where text is visible in a document, people tend
                to focus on the textual content rather than upon overall presentation, so publishers use
                lorem ipsum when displaying a typeface or design elements and page layout in order to direct
                the focus to the publication style and not the meaning of the text.
            </p>
            <?= $example->renderContent('body-2', ob_get_clean()); ?>
        </div>
        <div class="editable third" data-id="body-3">
            <?php ob_start(); ?>
            <h1>Select all</h1>
            <p>
                In publishing and graphic design, placeholder text is commonly used to demonstrate the
                elements of a document or visual presentation, such as font, typography, and layout. Even
                though using "lorem ipsum" often arouses curiosity because of its resemblance to classical
                Latin, it is not intended to have meaning. Where text is visible in a document, people tend
                to focus on the textual content rather than upon overall presentation, so publishers use
                lorem ipsum when displaying a typeface or design elements and page layout in order to direct
                the focus to the publication style and not the meaning of the text.
            </p>
            <?= $example->renderContent('body-3', ob_get_clean()); ?>
        </div>
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
