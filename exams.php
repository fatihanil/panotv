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
					if($alan=="id"){ echo "<td><input type=\"radio\" name=\"sinav_id\" value=\"$alan_degeri\" checked></td>"; }
					if($alan=="sinavadi"){ echo "<td><input type=\"text\" name=\"sinav_adi\" value=\"$alan_degeri\"></td>"; }
					if($alan=="sinavtarihi"){ echo "<td><input type=\"date\" name=\"sinav_tarihi\" value=\"$alan_degeri\"></td>"; }
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

	<?php
}else {
	header( "Location: login.php" );
}//----------------session control wrapper if
include_once("inc/footer.php");
?>
