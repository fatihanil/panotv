<?php 
session_start();
include_once("conf.php");
include_once("inc/header.php");
?>
<div class="panel panel-primary">
	<div class="panel panel-heading">
		Yetkili Giriş Formu
	</div>
	<div class="panel-body">
		<img id="login-logo" class="img-thumbnail sola-yasla" src="<?php echo MANAGEMENT_LOGO; ?>">

		<fieldset class="">
			<legend><?php echo APP_TITLE ?></legend>	
			<form  action="system/session-manager.php" method="post">
			<div class="form-group">
				<label for="input-user-mail">Eposta</label>
				<input id="input-user-mail" class="form-control" type="text" name="user-email">
			</div>
			<div class="form-group">
				<label for="input-user-pass">Parola</label>
				<input id="input-user-pass" class="form-control" type="password" name="user-pass">
			</div>
			<div class="form-group">
				<input class="btn btn-default" type="submit" name="form-button" value="OTURUMU AÇ">
			</div>	
				<label>	
				<a href="system/system.php" >Şifreyi Sıfırla</a>
			</label>
			</form>
		</fieldset>	
	</div>

</div>



<?php
include_once("inc/footer.php");
?>