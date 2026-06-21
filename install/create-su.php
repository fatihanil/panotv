<?php include_once("../conf.php");include_once(SITE_HEADER_URL); ?>
<form action="installation-complete.php" method="post">

<div class="form-group">
	<input type="text" name="user-email">
</div>
<div class="form-group">
	<input type="password" name="user-pass">
</div>
<div class="form-group">
	<input type="text" name="user-role">
</div>
<div class="form-group">
	<input type="text" name="user-name">
</div>
	<input class="btn btn-success" type="submit" name="form-button" value="KURULUMU TAMAMLA">
</form>
<?php include_once(SITE_FOOTER_URL); ?>