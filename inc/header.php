<!doctype html>
<html lang="tr">
<?php
include_once( SHARED_LIBS."database.php" );
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	
	<title>
		<?php echo APP_TITLE; ?>
	</title>
</head>

<body>
	<?php
	include_once( "inc/session-bar.php" );
	?>
	<a href="index.php"><i id="pencerenin-ust-kenarina-sabitle" class="fa fa-windows fa-2x"></i></a>
	<a href="yardim.php"><i id="pencerenin-ust-kenarina-sabitle-yardim" class="fa fa-question-circle fa-2x"></i></a>
	<main class="row">
		<?php
		include_once( "admin-menu.php" );
		?>
		<div class="col-md-10">