<?php include __DIR__ . '/../../include.php'; ?>
<!doctype html>
<html>
<head>
    <?php
        require_once RAPTOR_THEMES_DIR . 'include.php';
        require_once RAPTOR_DEPENDENCIES_DIR . 'include.php';
        require_once RAPTOR_COMMON_DIR . 'include.php';
        require_once RAPTOR_LOCALES_DIR . 'include.php';
        require_once RAPTOR_FILE_MANAGER_DIR . 'src/include.php';
    ?>
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
    <script type="text/javascript">
        RFM.dialog({
            uriAction: '<?= RAPTOR_EXAMPLE_URI; ?>actions/file-manager.php',
            uriIcon: '<?= RAPTOR_EXAMPLE_URI; ?>examples/file-manager/icon/'
        });
    </script>
</body>
</html>
