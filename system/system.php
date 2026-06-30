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
		if ( $sorgu_islendi = sinaviGuncelle( $_POST[ "sinav_id" ], $_POST[ "sinav_adi" ], $_POST[ "sinav_tarihi" ], $gonderen_sayfa ) ) {
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
		if ( $sorgu_islendi = renkleriDegistir( $_POST[ "" ], $gonderen_sayfa ) ) {

		}
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
		$sorgu_islendi = duyuruyuGuncelle( $_POST[ "duyuru-id" ], $_POST[ "duyuru-metni" ], $_POST[ "duyuru-sonu" ], $gonderen_sayfa );
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
		$sorgu_islendi = nobetiYeriniGuncelle( $_POST[ 'nobetyeri_id' ], $_POST[ 'nobet_yeri' ], $gonderen_sayfa );
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
		$sorgu_islendi=sliderSuresiniGuncelle($_POST['slider-suresi'],$gonderen_sayfa);
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