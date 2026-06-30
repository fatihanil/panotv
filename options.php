<?php
session_start();
include_once("conf.php");
if ( isset( $_SESSION[ 'yetkili' ] ) ) {//----------------session control wrapper if
	include_once("inc/header.php");
	?>	
<!-- Sınav Ayarları artık exams.php dosyasından yönetilmektedir -->

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
				<th></th>
			</tr>
	<?php
		$database=new mayeSQL();
		$nobetyerleri=$database->sentQuery("SELECT id,datavalue FROM ".APP_DATA_DB_TABLE." WHERE dataname=\"nobet yeri\" ORDER BY id ASC;");
		$i=0;
		while(isset($nobetyerleri[$i])){
			echo "<tr>";
			$id_icin = "";
			foreach($nobetyerleri[$i] as $alan=>$alan_degeri){
				if($alan=="id"){ 
					echo "<td><input type=\"radio\" id=\"radio_$alan_degeri\" name=\"nobetyeri_id\" value=\"$alan_degeri\"></td>"; 
					$id_icin = $alan_degeri;
				}
				if($alan=="datavalue"){ echo "<td><input type=\"text\" name=\"nobet_yeri[$id_icin]\" value=\"$alan_degeri\"></td>"; }			
			}
			if($id_icin != "") {
				echo "<td><button type=\"submit\" name=\"form-button\" value=\"NÖBET YERİNİ SİL\" class=\"btn btn-danger btn-sm\" title=\"Bu Nöbet Yerini Sil\" onclick=\"document.getElementById('radio_$id_icin').checked=true;\"><strong style=\"font-size: 1.5rem; line-height: 0.5;\">-</strong></button></td>";
			}
			$i++;
			echo "</tr>";
		}
		unset($nobetyerleri);	
		?>	
			<tr>
				<td colspan="3" style="text-align: right;">
					<button class="btn btn-success btn-sm" type="submit" name="form-button" value="NÖBET YERİ EKLE" title="Yeni Nöbet Yeri Ekle">
						<strong style="font-size: 1.5rem; line-height: 0.5;">+</strong>
					</button>
				</td>
			</tr>
		</table>
		<label>
			<button class="btn btn-primary" type="submit" name="form-button" value="NÖBET YERİNİ GÜNCELLE">SEÇİLENİ GÜNCELLE</button>
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
		RENKLERİ AYARLA
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
			if(!is_array($colors) || empty($colors)){
				echo "<label>Duyuru Zemin<input type='color' name='Duyuru Zemin' value='#d3a625'></label><label>Duyuru Metni<input type='color' name='Duyuru Metni' value='#990000'></label>";
				echo "<label>Başlık Zemini<input type='color' name='Başlık Zemini' value='#69343e'></label><label>Başlık Metni<input type='color' name='Başlık Metni' value='#f0f8ff'></label>";
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
	header( "Location: login.php" );
} //----------------session control wrapper if
include_once("inc/footer.php");
?>
