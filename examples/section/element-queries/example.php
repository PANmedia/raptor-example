<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" />
    </head>
    <body class="large">
        <div class="layout">
            <div class="left-sidebar container sortable">
                <div class="content">
                    <h1>I am the primary content of a left sidebar</h1>
                    <div class="layout"></div>
                </div>
                <div class="sidebar">
                    <h1>I am a left sidebar</h1>
                    <div class="layout"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="right-sidebar container sortable">
                <div class="content">
                    <h1>I am the primary content of a right sidebar</h1>
                    <div class="layout"></div>
                </div>
                <div class="sidebar">
                    <h1>I am a right sidebar</h1>
                    <div class="layout"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="full-width sortable">
                <div class="container">
                    <h1>I am a full width container</h1>
                    <div class="layout"></div>
                </div>
            </div>
            <div class="two-col container sortable">
                <div class="col">
                    <h1>I am column 1 of 2</h1>
                    <div class="layout"></div>
                </div>
                <div class="col last">
                    <h1>I am column 2 of 2</h1>
                    <div class="layout"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="three-col container sortable">
                <div class="col">
                    <h1>I am column 1 of 3</h1>
                    <div class="layout"></div>
                </div>
                <div class="col">
                    <h1>I am column 2 of 3</h1>
                    <div class="layout"></div>
                </div>
                <div class="col last">
                    <h1>I am column 3 of 3</h1>
                    <div class="layout"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="five-col container pane">
                <div class="col">
                    <h1>I am column 1 of 5</h1>
                    <div class="layout"></div>
                </div>
                <div class="col">
                    <h1>I am column 2 of 5</h1>
                    <div class="layout"></div>
                </div>
                <div class="col">
                    <h1>I am column 3 of 5</h1>
                    <div class="layout"></div>
                </div>
                <div class="col">
                    <h1>I am column 4 of 5</h1>
                    <div class="layout"></div>
                </div>
                <div class="col last">
                    <h1>I am column 5 of 5</h1>
                    <div class="layout"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <script src="../../../../raptor-dependencies/jquery.js"></script>
        <script src="../../../../raptor-dependencies/jquery-ui.js"></script>
        <script type="text/javascript">
            $('.layout').sortable({
                connectWith: '.layout'
            });
        </script>
    </body>
</html>