<?php
include_once( "system/database.php" );
$database = new mayeSQL();

$sql = "DROP TABLE IF EXISTS " . ULUSAL_SINAVLAR_DB_TABLE . ";
	CREATE TABLE IF NOT EXISTS `" . ULUSAL_SINAVLAR_DB_TABLE . " (
  `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sinavadi` VARCHAR(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sinavtarihi` DATE DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;";
$transaction = $database->sentQuery( $sql );
if ( $transaction != null ) {
	$sql = "DROP TABLE IF EXISTS" . APP_DATA_DB_TABLE . ";
			CREATE TABLE IF NOT EXISTS " . APP_DATA_DB_TABLE . " (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dataname` VARCHAR(255) COLLATE utf8_turkish_ci NOT NULL,
  `dataproperty` VARCHAR(255) COLLATE utf8_turkish_ci NOT NULL,
  `datavalue` VARCHAR(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
";
	$transaction = $database->sentQuery( $sql );
	if ( $transaction != null ) {
		$sql = "DROP TABLE IF EXISTS " . DUYURULAR_DB_TABLE . ";
			CREATE TABLE IF NOT EXISTS " . DUYURULAR_DB_TABLE . " (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `duyurumetni` VARCHAR(255) COLLATE utf8_turkish_ci NOT NULL,
  `duyurusonu` DATE DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
";
		$transaction = $database->sentQuery( $sql );
		if ( $transaction != null ) {
			$sql = "DROP TABLE IF EXISTS " . NOBETLER_DB_TABLE . ";
				CREATE TABLE IF NOT EXISTS " . NOBETLER_DB_TABLE . " (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nobetyeri` VARCHAR(255) COLLATE utf8_turkish_ci NOT NULL,
  `nobetci` VARCHAR(255) COLLATE utf8_turkish_ci NOT NULL,
  `nobetgunu` VARCHAR(9) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
";
			$transaction = $database->sentQuery( $sql );
			if ( $transaction != null ) {
				$sql = "DROP TABLE IF EXISTS " . SLIDER_DB_TABLE . ";
					CREATE TABLE IF NOT EXISTS " . SLIDER_DB_TABLE . " (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `itemname` TEXT COLLATE utf8_turkish_ci,
  `itempath` TEXT COLLATE utf8_turkish_ci,
  `itemtext` TEXT COLLATE utf8_turkish_ci,
  `itemheader` TEXT COLLATE utf8_turkish_ci,
  `itemexpired` DATE DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
";
				$transaction = $database->sentQuery( $sql );
				if ( $transaction != null ) {
					$sql = "DROP TABLE IF EXISTS " . YEMEKLER_DB_TABLE . ";
						CREATE TABLE IF NOT EXISTS " . YEMEKLER_DB_TABLE . " (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tarih` DATE NOT NULL,
  `yemek1` VARCHAR(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `yemek2` VARCHAR(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `yemek3` VARCHAR(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `yemek4` VARCHAR(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
";
					$transaction = $database->sentQuery( $sql );
					if ( $transaction != null ) {
						$sql = "CREATE TABLE `".ADMIN_DB_TABLE."` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `isim` VARCHAR(100) CHARACTER SET utf8 NOT NULL,
  `parola` VARCHAR(200) CHARACTER SET utf8 NOT NULL,
  `sonoturum` DATETIME DEFAULT NULL,
  `eposta` VARCHAR(200) CHARACTER SET utf8 NOT NULL,
  `rolu` VARCHAR(2) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;";
						$transaction = $databasel->sentQuery( $sql );
						if ( $transaction != null ) {
							$hata = false;
						} else {
							$hata = true;
						}
					} else {
						$hata = true;
					}
				} else {
					$hata = true;
				}
			} else {
				$hata = true;
			}
		} else {
			$hata = true;
		}
	} else {
		$hata = true;
	}
} else {
	$hata = true;
}

if ( $hata == false ) {
	echo "Web app VERİTABANI kurulumu tamamlandı...<a href='install/create-su.php'>Sonraki Adıma Devam Edin</a>";
} else {
	echo "Kurulumda sorun yaşandı";
}

?>
?>