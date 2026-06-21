<?php

// Include PhpSpreadsheet library autoloader 
// 06.04.2024 fanil
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

/* SINAV AYARLARI İÇİN GEREKLİ FONKSİYONLAR */

function sinavEkle($sinav_adi, $sinav_tarihi, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "insert into " . ULUSALSINAVLAR_DB_TABLE . " (sinavadi,sinavtarihi) values(\"$sinav_adi\",'$sinav_tarihi');";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function sinaviSil($sinav_id) {
    $database = new mayeSQL();
    $sql = "delete from " . ULUSALSINAVLAR_DB_TABLE . " where id=$sinav_id;";
    if ($database->sentQuery($sql)) {
        return $sorgu_islendi = true;
    }
}

function sinaviGuncelle($sinav_id, $sinav_adi, $sinav_tarihi, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "UPDATE " . ULUSALSINAVLAR_DB_TABLE . " SET sinavadi=\"$sinav_adi\", sinavtarihi='$sinav_tarihi' WHERE id=$sinav_id;";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function nobetSayisiniGuncelle($nobet_sayisi, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "UPDATE " . APP_DATA_DB_TABLE . " SET datavalue=$nobet_sayisi where dataname='nöbet sayısı';";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function logoyuGuncelle($okulun_logosu, $gonderen_sayfa) {
    $database = new mayeSQL();
    $kayit_varmi = false;
    $kayit_varmi = $database->sentQuery("SELECT datavalue FROM " . APP_DATA_DB_TABLE . " WHERE dataname='logo';");

    if ($kayit_varmi[0] == null) {
        $sql = "INSERT INTO " . APP_DATA_DB_TABLE . " (dataname,datavalue) VALUES ('logo', '" . $okulun_logosu['name'] . "');";
    } else {
        $sql = "UPDATE " . APP_DATA_DB_TABLE . " SET datavalue='" . $okulun_logosu['name'] . "' WHERE dataname='logo';";
    }
    //echo $sql;
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function renkleriDegistir($neyin_rengi, $renk, $gonderen_sayfa) {
    $database = new mayeSQL();
    if ($database->sentQuery("UPDATE " . APP_DATA_DB_TABLE . " SET datavalue=\"$renk\" WHERE dataname=\"$neyin_rengi\";")) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function duyuruEkle($gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "INSERT INTO " . DUYURULAR_DB_TABLE . " (duyurumetni,duyurusonu) VALUES(\"\",'2017-09-29')";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
        //return $sorgu_islendi=true;
    }
}

function duyuruyuSil($duyuru_id, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "DELETE FROM " . DUYURULAR_DB_TABLE . " WHERE id=$duyuru_id;";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
        //return $sorgu_islendi=true;
    }
}

function duyuruyuGuncelle($duyuru_id, $duyuru_metni, $duyuru_sonu, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "UPDATE " . DUYURULAR_DB_TABLE . " SET duyurumetni=\"$duyuru_metni\", duyurusonu='$duyuru_sonu' WHERE id=$duyuru_id;";
    if ($database->sentQuery($sql)) {
        //return $sorgu_islendi=true;
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function yemekleriKaydet($tarih, $yemek1, $yemek2, $yemek3, $yemek4, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "SELECT * FROM " . YEMEKLER_DB_TABLE . " WHERE tarih=\"$tarih\";";
    $kayit_varmi = $database->sentQuery($sql);
    if (is_null($kayit_varmi)) {
        $sql = "UPDATE " . YEMEKLER_DB_TABLE . " SET yemek1=$yemek1,yemek2=$yemek2,yemek3=$yemek3,yemek4=$yemek4 WHERE tarih=\"$tarih\";";
    } else {
        $sql = "INSERT INTO " . YEMEKLER_DB_TABLE . " (tarih,yemek1,yemek2,yemek3,yemek4) VALUES(\"$tarih\",\"$yemek1\",\"$yemek2\",\"$yemek3\",\"$yemek4\");";
    }
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
        //return $sorgu_islendi=true;
    }
}

function nobetYeriEkle($gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "INSERT INTO " . APP_DATA_DB_TABLE . " (dataname,dataproperty,datavalue) VALUES('nobet yeri','varchar','');";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function nobetYeriniSil($nobetyeri_id, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "delete from " . APP_DATA_DB_TABLE . " where id=$nobetyeri_id;";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function nobetiYeriniGuncelle($nobetyeri_id, $nobet_yeri, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "UPDATE " . APP_DATA_DB_TABLE . " SET datavalue='$nobet_yeri' WHERE id=$nobetyeri_id;";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function nobetcileri_kaydet($nobet_id = null, $nobet_yeri, $nobetci, $nobet_gunu, $gonderen_sayfa) {
    $database = new mayeSQL();
    if (is_null($nobet_id)) {
        $i = 0;
        $sorgu_islendi = false;
        foreach ($nobet_yeri as $deger) {
            $sql = "INSERT INTO " . NOBETLER_DB_TABLE . " (nobetyeri,nobetci,nobetgunu) VALUES('$deger','$nobetci[$i]','$nobet_gunu');";
            $i++;
            if ($database->sentQuery($sql)) {
                $sorgu_islendi = true;
            }
        }
    } else {
        $sorgu_islendi = false;
        $sql = "DELETE FROM tvpano_nobetler WHERE nobetgunu='$nobet_gunu';";
        $database->sentQuery($sql);
        $i = 0;
        foreach ($nobet_yeri as $deger) {
            $sql = "INSERT INTO " . NOBETLER_DB_TABLE . " (nobetyeri,nobetci,nobetgunu) VALUES('$deger','$nobetci[$i]','$nobet_gunu');";
            $i++;
            if ($database->sentQuery($sql)) {
                $sorgu_islendi = true;
            }
        }
        /* foreach ( $nobet_id as $deger ) {
          if ( $sql = "UPDATE ".NOBETLER_DB_TABLE." SET nobetci='' WHERE id=$deger;" ) {
          $sorgu_islendi = true;
          }
          $i++;
          } */
    }
    if ($sorgu_islendi == true) {

        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function medyayiSil($medya_id, $medya, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "DELETE FROM " . SLIDER_DB_TABLE . " WHERE id=$medya_id;";
    if (realpath($medya)) {
        unlink(realpath($medya));
    }
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function yeniMedyaEkle($medya, $medya_header, $medya_text, $medya_expired, $gonderen_sayfa, $upload_path, $file_size_limit, $file_types_limit) {
    if ($d_kayit_adi = sunucuyaDosyaKaydet($medya, "tvpano", $file_size_limit, $file_types_limit)) {
        $database = new mayeSQL();
        $sql = "INSERT INTO " . SLIDER_DB_TABLE . " (itemname,itempath,itemtext,itemheader,itemexpired) VALUES('" . $d_kayit_adi . "','" . SLIDER_MEDIA_PATH . "','$medya_text','$medya_header','$medya_expired');";
        if ($database->sentQuery($sql)) {
            header("Location:" . SITE_URL . $gonderen_sayfa);
        }
    }
}

//2024-03-01 fatih anıl
function excelden_nobet_yukle($excel, $gonderen_sayfa, $upload_path, $file_size_limit, $file_types_limit) {
    $database = new mayeSQL();

    // Allowed mime types 
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    // Validate whether selected file is a Excel file 
    if (!empty($_FILES['excel-dosyasi']['name']) && in_array($_FILES['excel-dosyasi']['type'], $excelMimes)) {

        // If the file is uploaded 
        if (is_uploaded_file($_FILES['excel-dosyasi']['tmp_name'])) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['excel-dosyasi']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet_arr = $worksheet->toArray();

            echo $_FILES['excel-dosyasi']['tmp_name'];

            // Remove header row 
            unset($worksheet_arr[0]);

            // nöbetler tablosunu boşalt
            $prevQuery = "DELETE FROM tvpano_nobetler;";

            if ($prevResult = $database->sentQuery($prevQuery)) {
                foreach ($worksheet_arr as $row) {
                    $id = $row[0];
                    $nobetyeri = $row[1];
                    $nobetci = $row[2];
                    $nobetgunu = $row[3];

                    // Insert member data in the database 
                    $database->sentQuery("INSERT INTO tvpano_nobetler (id, nobetyeri, nobetci, nobetgunu) VALUES ('" . $id . "', '" . $nobetyeri . "', '" . $nobetci . "', '" . $nobetgunu . "')");
                    echo "sorgu işlendi";
                }
            }
            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
    }

    // Redirect to the listing page 
    //!!!! header("Location: index.php" . $qstring);
    header("Location:" . SITE_URL . $gonderen_sayfa);
}

function sliderSuresiniGuncelle($sure, $gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "UPDATE " . APP_DATA_DB_TABLE . " SET datavalue=$sure WHERE dataname='slidertime';";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function videoyuGuncelle($video_id, $gonderen_sayfa) {
    $database = new mayeSQL();
    //$url_baslangic=strpos($url,"http");
    //$url_bitis=strpos($url," frameborder");
    //$url_karakter_sayisi=$url_bitis-$url_baslangic-1;
    //$video_url=substr($url,$url_baslangic,$url_karakter_sayisi);
    //$id_baslangic=strpos($video_url,"embed/")+6;
    //$video_id=substr($video_url,$id_baslangic,strlen($video_url)-$id_baslangic);
    //$video_url=$video_url."?autoplay=1&loop=1&modestbranding=1&rel=0&playlist=".$video_id;
    $kayit_var_mi = $database->sentQuery("SELECT datavalue FROM " . APP_DATA_DB_TABLE . " WHERE dataname='video';");
    if (is_array($kayit_var_mi)) {
        $sql = "UPDATE " . APP_DATA_DB_TABLE . " SET datavalue='$video_id' WHERE dataname='video';";
    } else {
        $sql = "INSERT INTO " . APP_DATA_DB_TABLE . " (dataname,dataproperty,datavalue) VALUES('video','url','$video_id');";
    }
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    }
}

function nobetcileriTemizle($gonderen_sayfa) {
    $database = new mayeSQL();
    $sql = "TRUNCATE TABLE " . NOBETLER_DB_TABLE . ";";
    if ($database->sentQuery($sql)) {
        header("Location:" . SITE_URL . $gonderen_sayfa);
    } else {
        echo 'sorgu çalıştırılamadı';
    }
}

/* ----------------------------------------------------- FONSKİYON TANIMLAMALARI BURADA BİTTİ---------------- */
?>