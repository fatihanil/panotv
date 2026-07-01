<?php
include_once( "../conf.php" );
include_once(SHARED_LIBS."database.php");

include_once("functions.php");
include_once("upload-a-file-to-server.php");



$url = apache_request_headers();
$gonderen_sayfa = basename( $url[ 'Referer' ] );


switch ($_POST['form-button']) {
	case "EXCEL'İ YÜKLE":
                if( $sorgu_islendi = excelden_nobet_yukle($_FILES['excel-dosyasi'],$gonderen_sayfa,FILE_UPLOAD_DIR,1024 * 1024 * 2, array( "csv" ))){
			header("Location" . SITE_URL . "turns.php");
		}
		break;
	case "SINAV ALANI EKLE":
		if ( $sorgu_islendi = sinavEkle( "", "2017-09-28", $gonderen_sayfa ) ) {
			//echo "Yeni kayıt eklendi";
			header( "Location:" . SITE_URL . $gonderen_sayfa );
		}
		break;
	case "SINAVI SİL":
		if ( $sorgu_islendi = sinaviSil( $_POST[ "sinav_id" ], $gonderen_sayfa ) ) {
			//echo "Seçili kayıt silindi";
			header( "Location:" . SITE_URL . $gonderen_sayfa );
		}
		break;
	case "SINAVI GÜNCELLE":
		$secilen_id = $_POST[ "sinav_id" ] ?? null;
		if ( $secilen_id && $sorgu_islendi = sinaviGuncelle( $secilen_id, $_POST[ "sinav_adi" ][$secilen_id], $_POST[ "sinav_tarihi" ][$secilen_id], $gonderen_sayfa ) ) {
			//echo "Seçili kayıt güncellendi";
			header( "Location:" . SITE_URL . $gonderen_sayfa );
		}
		break;
	case "LOGOYU GÜNCELLE":
		$resim_yuklendi = sunucuyaDosyaKaydet( $_FILES[ "okulun-logosu" ],FILE_UPLOAD_DIR,  1024 * 1024 * 2, array( "jpg", "png", "gif","jpeg" ) );
		if ( $resim_yuklendi==true ) {
			$sorgu_islendi = logoyuGuncelle( $_FILES[ 'okulun-logosu' ], $gonderen_sayfa );

		}
		break;
	case "RENKLERİ DEĞİŞTİR":
		$expected_colors = ["Duyuru Zemin", "Duyuru Metni", "Başlık Zemini", "Başlık Metni"];
		
		$database = new mayeSQL();
		$colors_db = $database->sentQuery("select dataname from ".APP_DATA_DB_TABLE." where dataproperty=\"color\";");
		
		if (is_array($colors_db)) {
			foreach ($colors_db as $color) {
				if (!in_array($color['dataname'], $expected_colors)) {
					$expected_colors[] = $color['dataname'];
				}
			}
		}

		foreach ($expected_colors as $db_isim) {
			// PHP form isimlerindeki boşluk ve noktaları alt çizgiye çevirir
			$post_isim = str_replace(array(' ', '.'), '_', $db_isim); 
			
			if(isset($_POST[$post_isim])){
				// Veritabanına # işareti olmadan kaydediliyor, bu yüzden # işaretini kaldırıyoruz
				$yeni_renk = ltrim($_POST[$post_isim], '#');
				renkleriDegistir($db_isim, $yeni_renk, $gonderen_sayfa);
			}
		}
		
		header( "Location:" . SITE_URL . $gonderen_sayfa );
		break;
	case "DUYURU EKLE":
		if ( $sorgu_islendi = duyuruEkle( $gonderen_sayfa ) ) {

			//header("Location:".SITE_URL."announcement.php");
		}
		break;
	case "DUYURUYU SİL":
		if ( $sorgu_islendi = duyuruyuSil( $_POST[ "duyuru-id" ], $gonderen_sayfa ) ) {
			//header("Location:".SITE_URL."announcement.php");
		}
		break;
	case "DUYURUYU GÜNCELLE":
		$secilen_id = $_POST[ "duyuru-id" ] ?? null;
		if ($secilen_id) {
			$sorgu_islendi = duyuruyuGuncelle( $secilen_id, $_POST[ "duyuru-metni" ][$secilen_id], $_POST[ "duyuru-sonu" ][$secilen_id], $gonderen_sayfa );
		}
		break;
	case  "YEMEKLERİ KAYDET":
		/* @var $_POST type */
	$sorgu_islendi = yemekleriKaydet( $_POST[ 'tarih' ], $_POST[ "yemek1" ], $_POST[ "yemek2" ], $_POST[ "yemek3" ], $_POST[ "yemek4" ], $gonderen_sayfa );
		break;
	case "NÖBET YERİNİ SİL":
		$sorgu_islendi = nobetYeriniSil( $_POST[ 'nobetyeri_id' ], $gonderen_sayfa );
		break;
	case "NÖBET YERİ EKLE":
		$sorgu_islendi = nobetYeriEkle( $gonderen_sayfa );
		break;
	case "NÖBET YERİNİ GÜNCELLE":
		$secilen_id = $_POST[ 'nobetyeri_id' ] ?? null;
		if ($secilen_id) {
			$sorgu_islendi = nobetiYeriniGuncelle( $secilen_id, $_POST[ 'nobet_yeri' ][$secilen_id], $gonderen_sayfa );
		}
		break;
	case "NÖBETÇİLERİ KAYDET":
		$sorgu_islendi = nobetcileri_kaydet( $_POST['id'],$_POST[ 'nobet_yeri' ], $_POST[ 'nobetci' ], $_POST[ 'nobet_gunu' ], $gonderen_sayfa );
		break;
	case "YAYINI SİL":
		//var_dump( $_POST );
	$sorgu_islendi = medyayiSil( $_POST[ 'medya_id' ], $_POST[ 'medya' ], $gonderen_sayfa );
		break;
	case "YENİYİ YAYINLA";
	$sorgu_islendi = yeniMedyaEkle( $_FILES[ 'medya' ],$_POST['medya-basligi'],$_POST[ 'medya-metni' ], $_POST[ 'yayin-sonu-tarihi' ], $gonderen_sayfa, SITE_REAL_PATH.SLIDER_MEDIA_PATH, 1024 * 1024 * 8, array( "jpg", "jpeg","png", "gif","JPG","JPEG","PNG","GIF" ) );
		break;
	case "SLIDER SÜRESİNİ KAYDET":
		$sure_ms = floatval($_POST['slider-suresi']) * 1000;
		$sorgu_islendi=sliderSuresiniGuncelle($sure_ms,$gonderen_sayfa);
		break;
	case "VİDEOYU GÜNCELLE";
		videoyuGuncelle($_POST['video-url'],$gonderen_sayfa);
		break;
	case "NÖBETÇİLERİ TEMİZLE":
		$sorgu_islendi=nobetcileriTemizle($gonderen_sayfa);
		break;
	default:
		echo 'hiç bir fonksiyon çalıştırılamadı...';
		break;
}

?>