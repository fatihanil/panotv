<?php 
include_once("site_path.php");

//DATABASE INFORMATION 
//define("MYSQL_HOST","85.95.231.48");
define("MYSQL_HOST","localhost");
define("MYSQL_USER","denizlimkal_tvpa");
define("MYSQL_PASS","Hzz2ELDDdee7z7XJeNgZ");
define("MYSQL_DATABASE","denizlimkal_tvpano");
define("DB_PREFIX","tvpano_");
//DATABASE TABLE NAMES
define("ADMIN_DB_TABLE",DB_PREFIX."yetkilileri");
define("APP_DATA_DB_TABLE",DB_PREFIX."data");
define("DUYURULAR_DB_TABLE",DB_PREFIX."duyurular");
define("NOBETLER_DB_TABLE",DB_PREFIX."nobetler");
define("YEMEKLER_DB_TABLE",DB_PREFIX."yemekler");
define("SLIDER_DB_TABLE",DB_PREFIX."slider");
define("ULUSALSINAVLAR_DB_TABLE",DB_PREFIX."ulusalsinavlar");

//APP PATH CONSTANTS
define("SITE_URL","http://denizlimkal.k12.tr/");
//define("SITE_URL","http://85.95.231.48/~denizlimkal/");//define("SITE_URL","http://fatihanil.net.tr/mkal/");
define("SHARED_LIBS",$_SERVER['DOCUMENT_ROOT']."/shared_libs/");
define("APP_IMAGE_DIR","img/");

define("SITE_REAL_PATH",$_SERVER['DOCUMENT_ROOT']);//define("SITE_REAL_PATH",$_SERVER['DOCUMENT_ROOT']."/");
//define("SITE_REAL_PATH",$_SERVER['DOCUMENT_ROOT']);//define("SITE_REAL_PATH",$_SERVER['DOCUMENT_ROOT']."/mkal");
//define("SITE_URL","http://fatihanil.net.tr/tvpano/");
//define("SITE_REAL_PATH",$_SERVER['DOCUMENT_ROOT']."/tvpano/");
define("SITE_CONF_FILE",SITE_URL."conf.php");
define("FILE_UPLOAD_DIR","/uploads/");
define("FILE_UPLOAD_PATH",SITE_REAL_PATH.FILE_UPLOAD_DIR);
define("FILE_UPLOAD_URL",SITE_URL.FILE_UPLOAD_DIR);

define("SITE_CSS_DIR",SITE_URL."css/");
define("SLIDER_MEDIA_PATH","slider/media/");
//APPLICATION CONST
define("APP_TITLE","TV PANO 1.0");
define("MANAGEMENT_LOGO",SITE_URL.APP_IMAGE_DIR."logo-tvpano.png");
// test constants
//echo $_SERVER['DOCUMENT_ROOT']."\n";
//echo SITE_REAL_PATH;

?>