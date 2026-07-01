<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<div class="col-md-2">
	<fieldset>
		<legend>TV PANO </br>Yönetim Paneli</legend>
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php echo ($current_page == 'options.php') ? 'active' : ''; ?>"><a href="options.php">Temel Ayarlar</a></li>
			<li class="<?php echo ($current_page == 'gallery.php') ? 'active' : ''; ?>"><a href="gallery.php">Galeri</a></li>
			<li class="<?php echo ($current_page == 'turns.php') ? 'active' : ''; ?>"><a href="turns.php">Nöbetler</a></li>
			<li class="<?php echo ($current_page == 'lunchs.php') ? 'active' : ''; ?>"><a href="lunchs.php">Yemek</a></li>
			<li class="<?php echo ($current_page == 'announcement.php') ? 'active' : ''; ?>"><a href="announcement.php">Duyuru</a></li>
			<li class="<?php echo ($current_page == 'exams.php') ? 'active' : ''; ?>"><a href="exams.php">Sınavlar</a></li>
		</ul>
	</fieldset>	
</div>

