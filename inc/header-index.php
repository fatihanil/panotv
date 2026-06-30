<!DOCTYPE html>
<html lang="tr">
<?php

include_once( SHARED_LIBS."database.php" );
?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Refresh" content="900">
	<title>
		<?php echo APP_TITLE; ?>
	</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/slider.css" rel="stylesheet">
	<link href="css/video.css" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="/img/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Font AWesom icons-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">
	<?php
	$database_for_colors = new mayeSQL();
	$colors_db = $database_for_colors->sentQuery("SELECT dataname, datavalue FROM " . APP_DATA_DB_TABLE . " WHERE dataproperty='color';");
	$css_vars = [];
	if (is_array($colors_db)) {
		foreach ($colors_db as $color) {
			$css_vars[$color['dataname']] = '#' . $color['datavalue'];
		}
	}
	?>
	<style>
		:root {
			--duyuru-zemin: <?php echo $css_vars['Duyuru Zemin'] ?? '#D3A625'; ?>;
			--duyuru-metni: <?php echo $css_vars['Duyuru Metni'] ?? $css_vars['Duyuru Başlık'] ?? '#990000'; ?>;
			--baslik-zemin: <?php echo $css_vars['Başlık Zemini'] ?? '#69343e'; ?>;
			--baslik-metni: <?php echo $css_vars['Başlık Metni'] ?? $css_vars['Başlık Yazısı'] ?? '#f0f8ff'; ?>;
		}
	</style>
</head>

<body>
	