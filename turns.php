<?php
session_start();
include_once("conf.php");
if ( isset( $_SESSION[ 'yetkili' ] ) ) {//----------------session control wrapper if
	include_once("inc/header.php");
	?>
<div class="panel panel-primary">
	<div class="panel panel-heading">
		Nöbetçileri Excel ile Yükle
	</div>
	<div class="panel panel-body">
	<div class="well">
		<label>	1. Adım:
			<input class="btn btn-success" type="button" value="Excel dosyasını indir" name="excel-sablonunu-indir" onclick="window.location.href='<?php echo SITE_URL.'tvpano_nobetler.xlsx'; ?>'">
		</label>	
	</div>
	<div class="well">
		<form action="system/system.php" method="post" enctype="multipart/form-data">
  		<label> 2. Adım: Excel Dosyasını Yükle
 			<input class="btn btn-primary" type="file"  name="excel-dosyasi">
 		</label>
		<label>
			<input class="btn btn-success" type="submit" value="EXCEL'İ YÜKLE" name="form-button">
		</label>
		</form>
	</div>

	</div>
</div>
<div class="panel panel-primary">
	<div class="panel panel-heading">
		Nöbet Günü
	</div>
	<div class="panel panel-body">
		<form action="turns.php" method="post">  	
  		Günü Seçin:
		<select name="nobet-gunu">
			<option value="pazartesi" selected>Pazartesi</option>
			<option value="sali">Salı</option>
			<option value="carsamba">Çarşamba</option>
			<option value="persembe">Perşembe</option>
			<option value="cuma">Cuma</option>
		</select>  	
		<label>
			<input class="btn btn-primary" type="submit" value="NÖBETÇİLERİ GÖSTER" name="nobetcileri-goster">
		</label>
		</form>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel panel-heading">
		Nöbet Listesini Temizle
	</div>
	<div class="panel panel-body">
		<form action="system/system.php" method="post">  			
  	<label>
 	<input class="btn btn-danger" type="submit" value="NÖBETÇİLERİ TEMİZLE" name="form-button">
 </label>
		</form>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel panel-heading">
		NÖBET LİSTESİ
	</div>
	<div class="panel panel-body">
		<?php
	if(isset($_POST['nobetcileri-goster'])){
		$nobet_gunu=$_POST['nobet-gunu'];
	}else{
		$nobet_gunu="pazartesi";
	} 
	$database=new mayeSQL();  	
	?>
<fieldset>
<form action="system/system.php" method="post">  
	<div class="well well-warning"><?php echo strtoupper($nobet_gunu); ?></div>
	<table>
		<tr>
			
			<th>---- NÖBET YERİ ---</th>
			<th>---- NÖBETÇİ ------</th>
		</tr>
	<?php	
	$nobet_sayisi=$database->sentQuery("SELECT COUNT(datavalue) FROM ".APP_DATA_DB_TABLE." WHERE dataname='nobet yeri';");
	$nobet_yeri_sayisi=(int)$nobet_sayisi[0]['COUNT(datavalue)'];	
	$nobetler=$database->sentQuery("SELECT id,nobetyeri,nobetci FROM ".NOBETLER_DB_TABLE." WHERE nobetgunu='$nobet_gunu';");			
	if(is_null($nobetler[0])){
		$nobet_yerleri=$database->sentQuery("SELECT datavalue FROM ".APP_DATA_DB_TABLE." WHERE dataname='nobet yeri';");
		if(is_bool($nobetler)):unset($nobetler);endif;
		for($i=0;$i<$nobet_yeri_sayisi;$i++){			
			$nobetler[$i]=array("id"=>"","nobetyeri"=>$nobet_yerleri[$i]["datavalue"],"nobetci"=>"");
		}			
	}
	$i=0;
	echo "<input type='hidden' name='nobet_gunu' value='$nobet_gunu'>";
	while(isset($nobetler[$i])){
		echo "<tr>";
		foreach($nobetler[$i] as $alan=>$alan_degeri){
			if($alan=="id"):echo "<input type='hidden' name='nobet_id[]' value='$alan_degeri' readonly>";endif;
			if($alan=="nobetyeri"){			
				echo "<td><input type='text' name='nobet_yeri[]' value='$alan_degeri' readonly></td>";
			}
			if($alan=="nobetci"):echo "<td><input type=\"text\" value=\"$alan_degeri\" name='nobetci[]'></td>";endif;		
		}
		$i++;
		echo "</tr>";
	}	
	unset($nobetler);				  	  
	  ?>
	</table> 
 <label>
 	<input class="btn btn-success" type="submit" value="NÖBETÇİLERİ KAYDET" name="form-button">
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