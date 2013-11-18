<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Source View');
?>
<!doctype html>
<html>
<head>
    <?= $example->renderHead(); ?>
    <link rel="stylesheet" href="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/lib/codemirror.css" />
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>beautify-html.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/lib/codemirror.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/javascript/javascript.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/xml/xml.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/css/css.js"></script>
    <script src="<?= RAPTOR_DEPENDENCIES_URI; ?>codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(defaultOptions);
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="editable half" data-id="body-1">
        <?php ob_start(); ?>
        <h1>Raptor Editor - Live Source View</h1>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
            has been the industry's standard dummy text ever since the 1500s, when an unknown printer
            took a galley of type and scrambled it to make a type specimen book.
        </p>
        <blockquote>
            <p>
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged.
            </p>
        </blockquote>
        <p>
            It was popularised in the 1960s with the release of Letraset sheets containing
            Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
            including versions of Lorem Ipsum.
        </p>
        <p>
            <span class="cms-blue">This text is blue.</span>
            <span class="cms-red">This text is red.</span>
            <span class="cms-green">This text is green.</span>
            <a href=".">This is an internal link.</a>
            <a href="http://www.raptor-editor.com" target="_blank">This is an external link.</a>
            <a href="mailto:info@raptor-editor.com?Subject=Example">This is an email link.</a>
            <strong class="cms-bold">This text is bold.</strong>
            <em class="cms-italic">This text is italic.</em>
            <span class="cms-font-arial">This text is Arial.</span>
            <span class="cms-font-comic-sans">This text is Comic Sans.</span>
            <span class="cms-font-impact">This text is Impact.</span>
        </p>

        <ul>
            <li>List item 1</li>
            <li>List item 2</li>
            <li>List item 3</li>
        </ul>

        <p>
            Text above the image.
            <img src="../full-suite/images/orange.jpg" width="100" />
            Text below the image.
        </p>
        <p>
            The image below is a link.
            <a href="http://www.raptor-editor.com">
                <img src="../full-suite/images/orange.jpg" width="100" />
            </a>
            The image above is a link.
        </p>

        <table>
            <tr>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
            </tr>
            <tr>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
            </tr>
            <tr>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
            </tr>
            <tr>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
            </tr>
            <tr>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
                <td>Cell</td>
            </tr>
        </table>
        <?= $example->renderContent('body-1', ob_get_clean()); ?>
    </div>
    <div class="source-view half">
        <pre class="soure-view-code"></pre>
    </div>
    <script type="text/javascript">
        var previousHtml = '';
        setInterval(function() {
            var html = $('.editable').data('uiRaptor').getHtml();
            if (html != previousHtml) {
                previousHtml = html;
                var prettyHtml = style_html(html, {
                    max_char: 0
                });
                if (typeof CodeMirror !== 'undefined') {
                    $('.soure-view-code').html('');
                    CodeMirror($('.soure-view-code').get(0), {
                        value: prettyHtml,
                        mode: 'htmlmixed'
                    });
                } else {
                    $('.soure-view-code').text(prettyHtml);
                }
            }
        }, 400);
    </script>
</body>
</html>
