<?php
session_start();
include("../conf.php");
include_once(SHARED_LIBS."database.php");
//-------------------------includes end
function oturumSayfasiBaslat(){
	session_start();
}
function oturumAc($user_email,$user_pass){
	$sql="SELECT parola FROM ".ADMIN_DB_TABLE." WHERE eposta='$user_email';";
    $database=new MayeSQL();
    $parola=$database->sentQuery($sql);
	if($parola[0]['parola']===$user_pass){
		$sql="SELECT isim,sonoturum,rolu FROM ".ADMIN_DB_TABLE." WHERE eposta='$user_email';";
		$yetkili_bilgileri=$database->sentQuery($sql);
		$database->sentQuery("UPDATE ".ADMIN_DB_TABLE." SET sonoturum='".date("Y-m-j H:i:s")."' WHERE eposta='$user_email';");
        $isim=$yetkili_bilgileri[0]['isim'];
        $rolu=$yetkili_bilgileri[0]['rolu'];
        $son_oturum_zamani=$yetkili_bilgileri[0]['sonoturum'];
        $eposta=$user_email;
        $_SESSION['yetkili']=array("rolu"=>$rolu,"ismi"=>$isim,"eposta"=>$eposta,"sonoturum"=>$son_oturum_zamani);
        header("Location: ../options.php");
		
	}else{
		//echo "Oturum açılamadı";
		header("Location: ../login.php");
	}
}
function oturumuKapat(){	
    session_destroy();
    header("Location: ../login.php");
}
//--------------------------------function declarations end

if($_POST['form-button']=="OTURUMU AÇ"){
	$parola_MD5=md5($_POST['user-pass']);
    oturumAc($_POST['user-email'],$parola_MD5);
}else{
    header("Location: ../login.php");
}
if(isset($_POST['session-end-button'])){
	oturumuKapat();
}
?>