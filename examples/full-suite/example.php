<?php
    include __DIR__ . '/../../include.php';
    $example = new Raptor\Example('Full Suite');
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?= $example->renderHead(); ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/libs/modernizr-2.0.6.min.js"></script>
    <script type="text/javascript">
        init(function($) {
            $('.editable').raptor(defaultOptions);
        });
    </script>
</head>
<body>
    <?= $example->renderNavigation(); ?>
    <div id="header-container">
        <header class="wrapper clearfix">
            <h1 id="title" class="editable" data-id="site-title">
                <?php ob_start(); ?>
                    Site Title
                <?= $example->renderContent('site-title', ob_get_clean()); ?>
            </h1>
            <nav class="site-nav">
                <ul>
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Other Link</a></li>
                    <li><a href="#">Last Link</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <div id="main-container">
        <div id="main" class="wrapper clearfix">
            <article class="editable" data-id="article">
                <?php ob_start(); ?>
                    <header>
                        <h1>Article Header H1</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec.</p>
                    </header>
                    <section>
                        <h2>Article Section H2</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra.</p>
                        <img src="images/orange.jpg" />
                    </section>
                    <section>
                        <h2>Article Section H2</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra.</p>
                    </section>
                    <footer>
                        <h3>Article Footer h3</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor.</p>
                    </footer>
                <?= $example->renderContent('article', ob_get_clean()); ?>
            </article>

            <aside class="editable" data-id="side-bar">
                <?php ob_start(); ?>
                    <h3>Side Bar</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
                <?= $example->renderContent('side-bar', ob_get_clean()); ?>
            </aside>

        </div>
    </div>

    <div id="footer-container">
        <footer class="wrapper editable" data-id="footer">
            <?php ob_start(); ?>
                <h3>Footer</h3>
            <?= $example->renderContent('footer', ob_get_clean()); ?>
        </footer>
    </div>

</body>
</html>
