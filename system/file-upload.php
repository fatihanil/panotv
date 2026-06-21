<?php
function dosyayiSunucuyaYukle( $target_path, $file, $file_size_limit, $file_types_limit ) {
/*	$yuklemeHatalari=array();
	try {   
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    //if (!isset($file['error']) ||  is_array($file['error']) )
	if($file['error']!=0){
		$yuklemeHatalari[]='Kabul edilemez bozuk dosya biçimi.';
        //throw new RuntimeException('Kabul edilemez bozuk dosya biçimi.');   

    // Check $_FILES['upfile']['error'] value.
    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('Hiç bir dosya gönderilemedi.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Formun dosya gönderme limitini aşan dosya boyutu.');
        default:
            throw new RuntimeException('Formdan gelen bilgilerle bilinmeyen bir hata gerçekleşti.');
    }
	}

    // You should also check filesize here.
    if ($file['size'] > $file_size_limit) {
		$yuklemeHatalari[]='Dosya uygulamada izin verilen boyutu aştı.';
        throw new RuntimeException('Dosya uygulamada izin verilen boyutu aştı.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search($finfo->file($file['tmp_name']),array('jpg' => 'image/jpeg','png' => 'image/png','gif' => 'image/gif',),true)) {
		$yuklemeHatalari[]='Dosya uzantısı kabul edilebilen tipte değil.';
        throw new RuntimeException('Dosya uzantısı kabul edilebilen tipte değil.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.!move_uploaded_file($_FILES['upfile']['tmp_name'],sprintf('%s%s%s.%s',SITE_REAL_PATH,$target_path,sha1_file($file['tmp_name']),$ext))
    if (!move_uploaded_file($file[ "tmp_name" ], SITE_REAL_PATH. $target_path .$file['name'])) {
		$yuklemeHatalari[]='Dosyanın sunucuda taşınması anında hata oluştu.';
		throw new RuntimeException('Dosyanın sunucuda taşınması anında hata oluştu.');
	}

    //echo 'Dosya(lar) sorunsuz sunucuya yüklendi.';

} catch (RuntimeException $e) {

    echo $e->getMessage();

}

*/	
	
	
	//kontrol değişkeni ve ekran mesajı tanımlanıyor
	$yukleme_onayi = false;
	$mesaj = "Dosyanız yüklenemedi";
	//parametredeki dosyanın türü değişkene atanıyor
	echo $yuklenen_dosyanin_turu = pathinfo( $file[ 'name' ], PATHINFO_EXTENSION );
	//Yüklenen dosyanın dosya türünün istenilen biçimlerde olduğu test ediliyor
	if ( $yuklenen_dosyanin_turu !=null ) {
		$dosya_istenen_uzantida = array_search( $yuklenen_dosyanin_turu, $file_types_limit );
		if ( $dosya_istenen_uzantida = false || $dosya_istenen_uzantida=null ) {
			echo "Dosya uzantısı istenen tipte değil";
		}else{
			$yukleme_onayi = true;
		}
	}
	//Yüklenecek dosyanın boyutu istenen ölçülerle kontrol ediliyor
	if ( $file[ 'size' ] > $file_size_limit ) {
		echo "Dosya sunucunun izin verdiği boyutlardan daha büyük. Lütfen dosyanızı $file_size_limit baytdan daha küçük bir boyutta yüklemeyi deneyin.";
	}else{
		$yukleme_onayi = true;
	}
	//Bütün sınamalardan geçen YUKLEME_ONAYI anahtarı kontrol ederek dosya sunucuya gönderiliyor
	try {
		if ( $yukleme_onayi == false ) {
			echo $mesaj;
		} else {
			//var_dump($file);
			if ( file_exists( $file[ 'tmp_name' ] ) ) {
				if ( move_uploaded_file( $file[ "tmp_name" ], SITE_REAL_PATH. $target_path .basename($file['name']) ) ) {
					return true;
				}
			} else {
				echo "tmp dosyası ortalıkta yok";
			}
		}
	} catch ( RuntimeException $e ) {
		echo "Hata Yakalandı:" . $e->getMessage();
	}
	
	

return $yukleme_onayi;
}
?>