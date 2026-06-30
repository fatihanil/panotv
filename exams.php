<?php 
session_start();
include_once("conf.php");
if ( isset( $_SESSION[ 'yetkili' ] ) ) {//----------------session control wrapper if
	include_once("inc/header.php");
	?>

<div class="panel panel-primary">
	<div class="panel panel-heading">		
		Ulusal Sınav Bilgileri
	</div>
	<div class="panel panel-body">
		<form action="system/system.php" method="post">
		<table>
			<tr>
				<th></th>
				<th>SINAV ADI</th>
				<th>SINAVIN TARİHİ</th>
				<th></th>
			</tr>
		<?php
		$database=new mayeSQL();
		$sinavlar=$database->sentQuery("select id,sinavadi,sinavtarihi from ".ULUSALSINAVLAR_DB_TABLE." ORDER BY id ASC;");
		$i=0;
			while(isset($sinavlar[$i])){
				echo "<tr>";
				$id_icin = "";
				foreach($sinavlar[$i] as $alan=>$alan_degeri){
					if($alan=="id"){ 
						echo "<td><input type=\"radio\" id=\"radio_$alan_degeri\" name=\"sinav_id\" value=\"$alan_degeri\" checked></td>"; 
						$id_icin = $alan_degeri;
					}
					if($alan=="sinavadi"){ echo "<td><input type=\"text\" name=\"sinav_adi\" value=\"$alan_degeri\"></td>"; }
					if($alan=="sinavtarihi"){ echo "<td><input type=\"date\" name=\"sinav_tarihi\" value=\"$alan_degeri\"></td>"; }
				}
				if($id_icin != "") {
					echo "<td><button type=\"submit\" name=\"form-button\" value=\"SINAVI SİL\" class=\"btn btn-danger btn-sm\" title=\"Bu Sınavı Sil\" onclick=\"document.getElementById('radio_$id_icin').checked=true;\"><strong style=\"font-size: 1.5rem; line-height: 0.5;\">-</strong></button></td>";
				}
				$i++;
				echo "</tr>";
			}
			unset($sinavlar);
			?>
			<tr>
				<td colspan="4" style="text-align: right;">
					<button class="btn btn-success btn-sm" type="submit" name="form-button" value="SINAV ALANI EKLE" title="Yeni Sınav Alanı Ekle">
						<strong style="font-size: 1.5rem; line-height: 0.5;">+</strong>
					</button>
				</td>
			</tr>
		</table>
			<label>
				<input class="btn btn-primary" type="submit" value="SEÇİLENİ GÜNCELLE" name="form-button">
			</label>
		</form>
		
	</div>
</div>	

	<?php
}else {
	header( "Location: login.php" );
}//----------------session control wrapper if
include_once("inc/footer.php");
?>
