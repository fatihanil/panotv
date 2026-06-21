<?php
if($_POST['form-button']==="KURULUMU TAMAMLA"){
	$sql="INSERT INTO ".ADMIN_DB_TABLE." (isim,parola,eposta,rolu) VALUES('".$_POST['user-name']."','".$_POST['user-pass']."','".$_POST['user-email']."','".$_POST['user-role'].");";
	$transaction=$database->sentQuery($sql);
	if($transaction!=null){
		echo "Süper Kullanıcı oluşturuldu ve kurulum tamamlandı.<a href='".SITE_ROOT."/login.php'> Buradan devam edin.</a>";
	}
		
}
?>