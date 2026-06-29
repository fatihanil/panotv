<?php
session_start();
include_once("conf.php");
if ( isset( $_SESSION[ 'yetkili' ] ) ) {//----------------session control wrapper if
	include_once("inc/header.php");
	?>


<div class="panel panel-primary">
	<div class="panel panel-heading">
		YAYINLANMIŞ MEDYALAR
	</div>
	<div class="panel panel-body">
		<form action="system/system.php" method="post">
 <table class="gallery-table">
  <tbody>
	<tr>
	  <th scope="col"></th>
	  <th scope="col">MEDYA</th>
	  <!--<th scope="col">BAŞLIK</th>-->
	  <th scope="col">BAŞLIK</th>
	  <!--<th scope="col">YAYIN BİTİŞ TARİHİ</th>-->
	</tr>
<?php
	$database=new mayeSQL();
	$medyalar=$database->sentQuery("SELECT id,CONCAT(itempath,itemname) item,itemheader,itemexpired FROM ".SLIDER_DB_TABLE.";");
	if($medyalar[0]!=null){
		$i=0;
	while(isset($medyalar[$i])){
		echo "<tr>";
		foreach($medyalar[$i] as $alan=>$alan_degeri){
			if($alan=="id"){			
				echo "<th scope='row'><input type='radio' name='medya_id' value='$alan_degeri'></th>";
			}
			if($alan=="item"):echo "<td><img class='gallery-thumbs' src='".SITE_URL.$alan_degeri."'><input type='hidden' name='medya' value='".SITE_URL.$alan_degeri."'>";endif;
			//if($alan=="itemtext"):echo "<td><input type='text' name='medya_text' readonly value='$alan_degeri'></td>";endif;
			if($alan=="itemheader"):echo "<td><input type='text' name='medya_text' readonly value='$alan_degeri'></td>";endif;
			//if($alan=="itemexpired"):echo "<td><input type='date' name='medya_expired' readonly value='$alan_degeri'></td>";endif;	
		}
		$i++;
		echo "</tr>";
	}  	
	}	
?>		
  </tbody>
</table>
<label>
	<input class="btn btn-danger" type="submit" value="YAYINI SİL" name="form-button">
</label>
</form>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel panel-heading">
		YENİ YAYIN
	</div>
	<div class="panel panel-body">
	<form action="system/system.php" method="post" enctype="multipart/form-data">
	 <table class="gallery-table">
	  <tbody>
		<tr>
		  <th scope="col"></th>
		  <th scope="col">MEDYA</th>
		  <th scope="col">BAŞLIK</th>
		  <th scope="col">METİN</th>
		  <th scope="col">YAYIN BİTİŞ TARİHİ</th>
		</tr>
		<tr>
		  <th scope="row"><input type="radio" name=""></th>
		  <td><input type="file" name="medya" ></td>
		  <td><input type="text" name="medya-basligi" maxlenght="100"></td>
		  <td><input type="text" name="medya-metni" maxlenght="100"></td>
		  <td><input type="date" name="yayin-sonu-tarihi"></td>
		</tr>
	  </tbody>
	</table>
	<label>
		<input class="btn btn-success" type="submit" value="YENİYİ YAYINLA" name="form-button">
	</label>
	</form>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel panel-heading">
		VİDEO EKLE
	</div>
	<div class="panel panel-body">
	<form action="system/system.php" method="post" enctype="multipart/form-data">
	<label>Youtube Videosunun ID(Kimlik Numarası) yapıştırılacak</i></label>
	<input class="form-control" type="text" name="video-url">
	<input type="submit" class="btn btn-success" name="form-button" value="VİDEOYU GÜNCELLE">
	</form>
	</div>
</div>
		
	<?php
}else {
	header( "Location: login.php" );
}//----------------session control wrapper if
include_once("inc/footer.php");
?>