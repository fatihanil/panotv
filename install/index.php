<?php include_once("../inc/header.php"); ?>
<div class="container">
	<form class="form-group" action="../conf.php" method="post">
	<div class="form-control">
		<label>Tablo Ön Eki</label><input type="text" name="mysql-sunucusu">
	</div>
	<div class="form-control">
		<label>Veritabanı</label><input type="text" name="mysql-veritabani">
	</div>
	<div class="form-control">
		<label>Veri Tablosu</label><input type="text" name="mysql-kullanici-adi">
	</div>
	<div class="form-control">
		<label>Kullanıcılar Tablosu</label><input type="text" name="mysql-kullanici-parolasi">
	</div>
	<div class="form-control">
		<label>Nöbetler Tablosu</label><input type="text" name="mysql-tablo-oneki">
	</div>
	<div class="form-control">
		<input type="submit" name="form-button" value="VERİTABANI AYARLARINI KAYDET">
	</div>	
	</form>
</div>

<?php include_once("../inc/footer.php"); ?>