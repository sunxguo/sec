<meta charset="utf-8">
<?php if (isset($message)) { ?>
<script>alert("<?=addslashes($message) ?>")</script>
<?php } ?>
<?php if (isset($url)) { ?>
<script>window.location.href="<?=$url ?>"</script>
<?php } else { ?>
<script>javascript:history.go(-1);</script>
<?php } ?>

