<?php

function sunucuyaDosyaKaydet( $d, $d_hedef, $d_boyut_siniri, $d_tip_listesi ) {
	echo "\n sunucuyaDosyaKaydet()";
	$d_yukleme_ani_hatasi = array();
	$tetik=true;
	$d_uzanti="";
	if ( is_array( $d ) ) {
		echo "\$d değişkeni dizidir";
		if ( $d[ 'error' ] != 0 ) {
			$tetik=false;
			$d_yukleme_ani_hatasi = "Dosya Bozuk";
		}else{
			$parcalar= explode( '.', $d[ 'name' ] ) ;
			$d_uzanti=strtolower(end($parcalar));			
			if ( in_array( $d_uzanti, $d_tip_listesi ) === false ) {
				$tetik=false;
				$d_yukleme_ani_hatasi = "Tip Kabul Edilemez";
			}else{
				if ( $d[ 'size' ] > $d_boyut_siniri ) {
					$tetik=false;
					$d_yukleme_ani_hatasi = "Boyut Sınırı Aşıyor";
				}else{
					if ( $tetik===true) {
						$d_yeni="tvpano".date("Ymj-His").".".$d_uzanti;
						echo "\n dosyayı yükleyeceğim";
						try{
							move_uploaded_file( $d[ 'tmp_name' ], SITE_REAL_PATH."/slider/media/".$d_yeni);
											  // $_SERVER['DOCUMENT_ROOT'] . "/tvpano/slider/media/".$d_yeni);	
											  echo "\n dosyayı yükledim.";
						}catch(Exception $e){
							echo "Hata Oldu:".$e->getMessage()."\n";
						}						
					} else {
						echo "Hata";
						print_r( $d_yukleme_ani_hatasi );
					}
				}
			}
		}	
		return $d_yeni;
	}else{
		var_dump($d);
	}

}