<?php
session_start();
include_once("conf.php");
if ( isset( $_SESSION[ 'yetkili' ] ) ) {//----------------session control wrapper if
	include_once("inc/header.php");
	?>	
<div class="panel panel-primary">
	<div class="panel panel-heading">		
		Sınav Ayarları
	</div>
	<div class="panel panel-body">
		<form action="system/system.php" method="post">
		<table>
			<tr>
				<th></th>
				<th>SINAV ADI</th>
				<th>SINAVIN TARİHİ</th>
			</tr>
		<?php
		$database=new mayeSQL();
		$sinavlar=$database->sentQuery("select id,sinavadi,sinavtarihi from ".ULUSALSINAVLAR_DB_TABLE.";");
		$i=0;
			while(isset($sinavlar[$i])){
				echo "<tr>";
				foreach($sinavlar[$i] as $alan=>$alan_degeri){
					if($alan=="id"){ echo "<td><input type=\"radio\" name=\"sinav_id\" value=\"$alan_degeri\" checked></th>"; }
					if($alan=="sinavadi"){ echo "<td><input type=\"text\" name=\"sinav_adi\" value=\"$alan_degeri\"></th>"; }
					if($alan=="sinavtarihi"){ echo "<td><input type=\"date\" name=\"sinav_tarihi\" value=\"$alan_degeri\"></th>"; }
				}
				$i++;
				echo "</tr>";
			}
			unset($sinavlar);
			?>
		</table>
			<label>
				<input class="btn btn-danger" type="submit" value="SINAVI SİL" name="form-button">
				<input class="btn btn-success" type="submit" value="SINAV ALANI EKLE" name="form-button">
				<input class="btn btn-primary" type="submit" value="SINAVI GÜNCELLE" name="form-button">
			</label>
		</form>
		
	</div>
</div>	
<!--___________________________________-->

<div class="panel panel-primary">
	<div class="panel panel-heading">
		NÖBET YERLERİ
	</div>
	<div class="panel panel-body">
		<form action="system/system.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>			
				<th></th>
				<th>NÖBET YERİ</th>
			</tr>
	<?php
		$database=new mayeSQL();
		$nobetyerleri=$database->sentQuery("SELECT id,datavalue FROM ".APP_DATA_DB_TABLE." WHERE dataname=\"nobet yeri\";");
		$i=0;
		while(isset($nobetyerleri[$i])){
			echo "<tr>";
			foreach($nobetyerleri[$i] as $alan=>$alan_degeri){
				if($alan=="id"){ echo "<td><input type=\"radio\" name=\"nobetyeri_id\" value=\"$alan_degeri\" checked></td>"; }
				if($alan=="datavalue"){ echo "<td><input type=\"text\" name=\"nobet_yeri\" value=\"$alan_degeri\"></td>"; }			
			}
			$i++;
			echo "</tr>";
		}
		unset($nobetyerleri);	
		?>	
		</table>
		</label>
		<label>
			<input class="btn btn-danger" type="submit" value="NÖBET YERİNİ SİL" name="form-button">
			<input class="btn btn-success" type="submit" value="NÖBET YERİ EKLE" name="form-button">
			<input class="btn btn-primary" type="submit" value="NÖBET YERİNİ GÜNCELLE" name="form-button">
		</label>
	</form>

	</div>
</div>




<div class="panel panel-primary">
	<div class="panel panel-heading">
		KURUM LOGOSU
	</div>
	<div class="panel panel-body">
		<i class="alert alert-danger">Dosyanız 2 MB.'dan küçük ve en boy oranı eşit olmalı.</i>
		<form action="system/system.php" method="post" enctype="multipart/form-data">
		<?php
			$logo=$database->sentQuery("SELECT datavalue FROM ".APP_DATA_DB_TABLE." WHERE dataname='logo';");
			?>
			<label>
			<div class="img-thumbnail">
				Tanımlı Logo
				<img class="thumbnail_picture" src="
			<?php
				if($logo[0]!=null){ echo FILE_UPLOAD_URL.$logo[0]['datavalue']; }else{ echo FILE_UPLOAD_URL.LOGO_DEFAULT; }
				unset($logo);
			?>">
			</div>
			</label>
			<div class="clearfix"></div>
			<hr>
			<label>
				Logo yükle<input type="file" name="okulun-logosu">
			</label>
			<label>
				<input class="btn btn-primary" type="submit" value="LOGOYU GÜNCELLE" name="form-button">
			</label>
		</form>
	</div>
</div>

<!--___________________________________-->

<div class="panel panel-primary">
	<div class="panel panel-heading">
		Renk Ayarları
	</div>
	<div class="panel panel-body">
		<form action="system/system.php" method="post">
		<?php
			$colors=$database->sentQuery("select dataname,datavalue from ".APP_DATA_DB_TABLE." where dataproperty=\"color\";");
			$i=0;
			while(isset($colors[$i])){
				echo "<label>";
					echo $colors[$i]['dataname']."<input type=\"color\" name=\"".$colors[$i]['dataname']."\" value=\"#".$colors[$i]['datavalue']."\">";
				$i++;
				echo "</label>";
			}
			if($colors[$i]==null){
				echo "<label>Duyuru Zemin<input type='color' name=''></label><label>Duyuru Başlık<input type='color' name=''></label>";
				echo "<label>Başlık Zemini<input type='color' name=''></label><label>Başlık Yazısı<input type='color' name=''></label>";
			}
			?>
					<input class="btn btn-primary" type="submit" value="RENKLERİ DEĞİŞTİR" name="form-button">
				</label>
			</form>
	</div>
</div>
<div class="panel panel-warning">
	<div class="panel panel-heading">
		FOTOĞRAF SUNUSUNUN EKRANDA KALMA SÜRESİ(milisaniye)
	</div>
	<div class="panel panel-body">
	<form action="system/system.php" method="post">
	<?php
		$slider_ekran_suresi=$database->sentQuery("SELECT CAST(datavalue AS UNSIGNED)AS datavalue FROM ".APP_DATA_DB_TABLE." WHERE dataname='slidertime';");
			$i=0;
			while(isset($slider_ekran_suresi[$i])){
				echo "<input type='text' name='slider-suresi' value='".$slider_ekran_suresi[0]['datavalue']."'>";	
				$i++;				
			}			
			?>
			<input class="btn btn-warning" type="submit" name="form-button" value="SLIDER SÜRESİNİ KAYDET">
	</form>
	</div>
</div>

	<?php
}else {
	header( "Location:".SITE_URL."login.php" );
} //----------------session control wrapper if
include_once("inc/footer.php");
?>
