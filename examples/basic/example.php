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
            $('.editable').raptor(defaultOptions);
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div class="source-watch" data-output="#source" data-target=".editable">
        <div class="editable center half" data-id="body-1">
            <?php ob_start(); ?>
                <h1>Raptor Editor - Basic Example</h1>
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
                    <em class="cms-font-arial">This text is Arial.</em>
                    <em class="cms-font-comic-sans">This text is Comic Sans.</em>
                    <em class="cms-font-impact">This text is Impact.</em>
                </p>

                <ul>
                    <li>
                        List item 1
                    </li>
                    <li>
                        List item 2
                    </li>
                    <li>
                        <p>List item 3</p>
                    </li>
                </ul>

                <ol>
                    <li>
                        List item 1
                    </li>
                    <li>
                        List item 2
                    </li>
                    <li>
                        <p>List item 3</p>
                    </li>
                </ol>

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
    </div>
    <div id="source" class="center half"></div>
</body>
</html>
