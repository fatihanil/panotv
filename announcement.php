<?php 
session_start();
include_once("conf.php");
if ( isset( $_SESSION[ 'yetkili' ] ) ) {//----------------session control wrapper if
	include_once("inc/header.php");
	?>

<div class="panel panel-primary">
	<div class="panel panel-heading">
		Duyuru Yönetimi
	</div>
	<div class="panel panel-body">
		<form action="system/system.php" method="post" >
		<table>
		  <tbody>
			<tr>
			  <th scope="col"></th>
			  <th scope="col">DUYURU METNİ</th>
			  <th scope="col">YAYINDAN KALKMA TARİHİ</th>
			  <th scope="col"></th>
			</tr>
<?php 
  $database=new mayeSQL();
  $duyurular=$database->sentQuery("SELECT id,duyurumetni,duyurusonu FROM ".DUYURULAR_DB_TABLE." ORDER BY id ASC;");
  $i=0;
  while(isset($duyurular[$i])){
	  echo "<tr>";
	  $id_icin = "";
	  foreach($duyurular[$i] as $alan=>$alan_degeri){
		  if($alan=="id"){ 
			  echo "<td><input type=\"radio\" id=\"radio_$alan_degeri\" name=\"duyuru-id\" value=\"$alan_degeri\"></td>";
			  $id_icin = $alan_degeri;
		  }
		  if($alan=="duyurumetni"){ echo "<td><input type=\"text\"  name=\"duyuru-metni\" value=\"$alan_degeri\"></td>"; }
		  if($alan=="duyurusonu"){ echo "<td><input type=\"date\" name=\"duyuru-sonu\" value=\"$alan_degeri\"></td>"; }
	  }
	  if($id_icin != "") {
		  echo "<td><button type=\"submit\" name=\"form-button\" value=\"DUYURUYU SİL\" class=\"btn btn-danger btn-sm\" title=\"Bu Duyuruyu Sil\" onclick=\"document.getElementById('radio_$id_icin').checked=true;\"><strong style=\"font-size: 1.5rem; line-height: 0.5;\">-</strong></button></td>";
	  }
	  $i++;
	  echo "</tr>";
  }
  unset($duyurular);
  ?>			
			<tr>
				<td colspan="4" style="text-align: right;">
					<button class="btn btn-success btn-sm" type="submit" name="form-button" value="DUYURU EKLE" title="Yeni Duyuru Ekle">
						<strong style="font-size: 1.5rem; line-height: 0.5;">+</strong>
					</button>
				</td>
			</tr>
		  </tbody>
		</table>
		<label>
			<button class="btn btn-primary" type="submit" name="form-button" value="DUYURUYU GÜNCELLE">SEÇİLENİ GÜNCELLE</button>
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

