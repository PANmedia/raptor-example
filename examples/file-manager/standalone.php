<?php include __DIR__ . '/../../include.php'; ?>
<!doctype html>
<html>
<head>
    <?php include __DIR__ . '/../../partials/head.php'; ?>
    <style type="text/css">
        body {
            padding: 10px;
        }
    </style>
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
