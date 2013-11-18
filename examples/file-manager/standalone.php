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
</head>
<body>
    <div id="file-manager"></div>
    <script type="text/javascript">
        var rfm = new RFM({
            node: document.getElementById('file-manager'),
            uriAction: '<?= RAPTOR_EXAMPLE_URI; ?>actions/file-manager.php',
            uriIcon: '<?= RAPTOR_EXAMPLE_URI; ?>examples/file-manager/icon/'
        });
    </script>
</body>
</html>
