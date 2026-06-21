<?php
session_start();
include_once("conf.php");
setlocale( LC_TIME, 'tr_TR' );
$haftanin_gunleri = array(
	'Monday' => 'Pazartesi',
	'Tuesday' => 'Salı',
	'Wednesday' => 'Çarşamba',
	'Thursday' => 'Perşembe',
	'Friday' => 'Cuma',
	'Saturday' => 'Cumartesi',
	'Sunday' => 'Pazar'
);
$bugunun_gunu = $haftanin_gunleri[ date( "l" ) ];

if ( isset( $_SESSION[ 'yetkili' ] ) ) { //----------------session control wrapper if
	include_once( "inc/header.php" );
	?>
	<div class="panel panel-primary">
		<div class="panel panel-heading">
			YEMEK LİSTESİ İÇİN TARİH SEÇİN
		</div>
		<div class="panel panel-body">
			<form action="lunchs.php" method="post">
				Tarihi Seçin:<input type="date" name="secilen_tarih">

				<label>
 	<input class="btn btn-primary" type="submit" value="--YEMEKLERİ GÖSTER--" name="yemekleri_goster">
 </label>
			
			</form>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel panel-heading">
			YEMEK MENÜSÜ
		</div>
		<div class="panel panel-body">
			<?php
			if ( isset( $_POST[ 'yemekleri_goster' ] ) ) {
				$gosterilecek_tarih = $_POST[ 'secilen_tarih' ];
			} else {
				$gosterilecek_tarih = date( "Y-n-d" );
			}
			$database = new mayeSQL();
			?>
			<form action="system/system.php" method="post">
				<div class="clearfix"></div>
				
					<?php
					$yemekler = $database->sentQuery( "SELECT tarih,yemek1,yemek2,yemek3,yemek4 FROM ".YEMEKLER_DB_TABLE." WHERE tarih=\"" . $gosterilecek_tarih . "\";" );
					if ( is_null( $yemekler[ 0 ] ) ) {
						$yemekler = array( 0 => array( "tarih" => $gosterilecek_tarih, "yemek1" => "", "yemek2" => "", "yemek3" => "", "yemek4" => "" ) );
					}
					foreach ( $yemekler[ 0 ] as $alan => $alan_degeri ) {
						if ( $alan == "tarih" ) {
							echo "<div class='form-group'><input type=\"hidden\" name=\"tarih\" value=\"$alan_degeri\">TARİH: $alan_degeri | $bugunun_gunu</div>";
						}
						if ( $alan == "yemek1" ): echo "<div class='form-group'>1.YEMEK :<input type=\"text\" value=\"$alan_degeri\" name=\"yemek1\"></div>";
						endif;
						if ( $alan == "yemek2" ): echo "<div class='form-group'>2.YEMEK: <input type=\"text\" value=\"$alan_degeri\" name=\"yemek2\"></div>";
						endif;
						if ( $alan == "yemek3" ): echo "<div class='form-group'>3.YEMEK: <input type=\"text\" value=\"$alan_degeri\" name=\"yemek3\"></div>";
						endif;
						if ( $alan == "yemek4" ): echo "<div class='form-group'>4.YEMEK: <input type=\"text\" value=\"$alan_degeri\" name=\"yemek4\"></div>";
						endif;				 
		  			}
	  				unset($yemekler);		  
	  ?>					
 					<input class="btn btn-success" type="submit" value="YEMEKLERİ KAYDET" name="form-button">				
				
			</form>
		</div>
	</div> <
	<?php
} else {
	header( "Location:" . SITE_ROOT . "login.php" );
} //----------------session control wrapper if
include_once( "inc/footer.php" );
?>