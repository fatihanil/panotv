<?php 
session_start();
include_once("conf.php");
include_once("inc/header.php");
?>
<?php if (!isset($_SESSION['yetkili'])): ?>
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
<?php else: ?>
<div class="panel panel-primary">
	<div class="panel panel-heading">
		Yönetim Paneli Menüsü
	</div>
	<div class="panel-body">
		<img id="login-logo" class="img-thumbnail sola-yasla" src="<?php echo MANAGEMENT_LOGO; ?>">
		
		<fieldset>
			<legend><?php echo APP_TITLE; ?> - Yönetim Paneli</legend>
			<p>Sisteme başarıyla giriş yaptınız. Lütfen yapmak istediğiniz işlemi aşağıdaki menüden seçiniz:</p>
			
			<div class="row" style="margin-top: 20px;">
				<div class="col-md-12">
					<div class="list-group">
						<a href="options.php" class="list-group-item active">
							<h4 class="list-group-item-heading"><i class="fa fa-cog"></i> Temel Ayarlar</h4>
							<p class="list-group-item-text">Sınav ayarları, nöbet yerleri, kurum logosu ve renk seçeneklerini düzenleyin.</p>
						</a>
						<a href="gallery.php" class="list-group-item">
							<h4 class="list-group-item-heading"><i class="fa fa-picture-o"></i> Galeri</h4>
							<p class="list-group-item-text">Yayınlanmış medyaları yönetin veya yeni görsel/video yayını ekleyin.</p>
						</a>
						<a href="turns.php" class="list-group-item">
							<h4 class="list-group-item-heading"><i class="fa fa-calendar"></i> Nöbetler</h4>
							<p class="list-group-item-text">Nöbet günlerini, nöbet yerlerini ve nöbetçi listesini güncelleyin.</p>
						</a>
						<a href="lunchs.php" class="list-group-item">
							<h4 class="list-group-item-heading"><i class="fa fa-cutlery"></i> Yemek</h4>
							<p class="list-group-item-text">Günlük yemek menüsünü kaydedin ve düzenleyin.</p>
						</a>
						<a href="announcement.php" class="list-group-item">
							<h4 class="list-group-item-heading"><i class="fa fa-bullhorn"></i> Duyuru</h4>
							<p class="list-group-item-text">Kayan yazı duyuru bandında gösterilecek duyuruları ekleyin veya silin.</p>
						</a>
						<a href="exams.php" class="list-group-item">
							<h4 class="list-group-item-heading"><i class="fa fa-graduation-cap"></i> Sınavlar</h4>
							<p class="list-group-item-text">Sınav takvimini ve ayarlarını yönetin.</p>
						</a>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<?php endif; ?>



<?php
include_once("inc/footer.php");
?>