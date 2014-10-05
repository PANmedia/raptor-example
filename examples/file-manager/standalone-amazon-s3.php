<?php
    include __DIR__ . '/../../include.php';
    include __DIR__ . '/amazon-s3-key.php';
?>
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
        var rfm = new RFM.S3({
            node: document.getElementById('file-manager'),
            s3: {
                bucketURL: <?= json_encode($buckerUrl); ?>,
                accessKeyId: <?= json_encode($accessKeyId); ?>,
                policy: <?= json_encode($policy); ?>,
                signature: <?= json_encode($signature); ?>
            }
        });
        rfm.refresh();
    </script>
</body>
</html>
