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
			</tr>
<?php 
  $database=new mayeSQL();
  $duyurular=$database->sentQuery("SELECT id,duyurumetni,duyurusonu FROM ".DUYURULAR_DB_TABLE.";");
  $i=0;
  while(isset($duyurular[$i])){
	  echo "<tr>";
	  foreach($duyurular[$i] as $alan=>$alan_degeri){
		  if($alan=="id"){ echo "<td><input type=\"radio\" name=\"duyuru-id\" value=\"$alan_degeri\"></td>";}
		  if($alan=="duyurumetni"){ echo "<td><input type=\"text\"  name=\"duyuru-metni\" value=\"$alan_degeri\"></td>"; }
		  if($alan=="duyurusonu"){ echo "<td><input type=\"date\" name=\"duyuru-sonu\" value=\"$alan_degeri\"></td>"; }
	  }
	  $i++;
	  echo "</tr>";
  }
  unset($duyurular);
  ?>			
		  </tbody>
		</table>
		<label>
			<input class="btn btn-danger" type="submit" value="DUYURUYU SİL" name="form-button">
			<input class="btn btn-primary" type="submit" value="DUYURUYU GÜNCELLE" name="form-button">
			<input class="btn btn-success" type="submit" value="DUYURU EKLE" name="form-button">
		</label>
	</form>
	</div>
</div>
	<?php
}else {
	header( "Location:".SITE_ROOT."login.php" );
}//----------------session control wrapper if
include_once("inc/footer.php");
?>

