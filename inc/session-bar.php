<?php

if(isset($_SESSION['yetkili'])){
    ?>
<nav class="navbar navbar-inverse navbar-static-top text-muted">
	<div class="container-fluid">	
		<div class="navbar-header">
			<form class="form-group" action="system/session-manager.php" method="post">
				<input type="submit" name="session-end-button" value="Oturumu Kapat" class="btn btn-danger">
			</form>
		</div>
		<ul class="nav navbar-nav">
			
		</ul>	
		<ul class="nav nav-pills">
			<li class=""><a href="#"><span class="glyphicon glyphicon-cog"></span> Rol:<?php echo $_SESSION['yetkili']['rolu']; ?></a></li>
			<li class=""><a href="#"><span class="glyphicon glyphicon-time"></span> Son Oturum Açma:	<?php echo $_SESSION['yetkili']['sonoturum']?></a></li>
			<li class="active"><a href="#"><span class="glyphicon glyphicon-user"> Merhaba Sayın :<?php echo $_SESSION['yetkili']['ismi']; ?></span></a></li>
		</ul>		
	</div>
 </nav>    
    <?php
}else{
    ?>
    <div class="container">
    	    
			<div class='alert alert-danger'><?php echo APP_TITLE." sistemini kullanabilmek için kayıtlı bir eposta adresiyle yetkili oturum açmalısınız..."; ?></div>	
    	
    </div>
    
    <?php
}
?>