<?php include __DIR__ . '/../../include.php'; ?>
<!doctype html>
<html>
<head>
    <?php include __DIR__ . '/../../partials/head.php'; ?>
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
    <button id="open">Open</button>
    <script type="text/javascript">
        var rfm = RFM.dialog({
            uriAction: '<?= RAPTOR_EXAMPLE_URI; ?>actions/file-manager.php',
            uriIcon: '<?= RAPTOR_EXAMPLE_URI; ?>examples/file-manager/icon/'
        }, {
            autoOpen: false
        });
        jQuery('#open').click(function() {
            jQuery(rfm.node).dialog('open');
        })
    </script>
</body>
</html>
