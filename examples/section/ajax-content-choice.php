<p id="<?= $id = uniqid('test-'); ?>">This choice was pulled from Ajax</p>
<script type="text/javascript" src="test.js"></script>
<script type="text/javascript">
    jQuery('#<?= $id; ?>').text('This content was switched out via JS.');
</script>