<?php
// phpinfo();
@session_start();
@extract($_POST);
@extract($_GET);
@extract($_SERVER);
@extract($_SESSION);
/*echo '<pre>';
print_r($_SERVER);
echo '</pre>';*/
//@error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(0);
ini_set('register_globals', 'on');
ini_set('memory_limit', '800M');
ini_set('post_max_size',"300M");
ini_set('max_upload_filesize',"800M");
//ini_set('max_input_vars', 10000);
// Define Time Zone //
@date_default_timezone_set('Asia/Kolkata');
if ($HTTP_HOST == "127.0.0.1" || $HTTP_HOST == "localhost" || $HTTP_HOST == "ajay" )
{
define('LOCAL_MODE', true);
} else {
define('LOCAL_MODE', false);
//die('<span style="font-family: tahoma, arial; font-size: 11px">config file cannot be included directly');
}
if (LOCAL_MODE || $HTTP_HOST == 'jugal' || $HTTP_HOST == '192.168.0.1')
{
/*Localhost database detail*/
$ARR_DBS["dbs"]['host'] = 'localhost';
$ARR_DBS["dbs"]['name'] = 'gvsd'; 
$ARR_DBS["dbs"]['user'] = 'root';
$ARR_DBS["dbs"]['password'] = 'maurya@123';
define('SITE_SUB_PATH', '/gvsd/');
} else { 
/* live database connection */
$ARR_DBS["dbs"]['host'] = 'localhost';
$ARR_DBS["dbs"]['name'] = 'rbn1chap_rapture'; 
$ARR_DBS["dbs"]['user'] = 'rbn1chap_rapture';
$ARR_DBS["dbs"]['password'] = 'Shiv@123';
define('SITE_SUB_PATH', '/rapture/');
}

define('tb_Prefix', 'rbn_');
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {$protocol = "https"; } else {$protocol = "http"; }

/* Define Directory file Path */
$tmp = dirname(__FILE__);
$tmp = str_replace('\\' ,'/',$tmp);
$tmp = str_replace('/lib' ,'',$tmp);
define('SITE_FS_PATH', $tmp);
define('_JEXEC', $tmp);

/* Site Path */
define('SITE_PATH', $protocol.'://'.$HTTP_HOST.SITE_SUB_PATH);
 
/* Admin Path */
define('ADMIN_DIR', 'admin/');
define('SITE_PATH_ADM', $protocol.'://'.$HTTP_HOST.SITE_SUB_PATH.ADMIN_DIR);

/*Define Live Site Path*/
define('LIVE_SITE_PATH_ADM', '');
define('LIVE_SITE_PATH', '');

/* plugins Path */
define('PLUGINS_DIR', 'lib/plugins');

/* file upload Path */
define('UP_FILES_FS_PATH', SITE_FS_PATH.'/uploaded_files');
define('SITE_PATH_IMG', SITE_PATH.'images/');
define('PATH_IMG', SITE_PATH.'uploaded_files/');
define('FS_ADMIN', SITE_FS_PATH.'/'.ADMIN_DIR);

// Define Module folder name //
define('_MODS', "modules");

/* Powered Registration */
define('PWDBYL', $protocol.'://www.webinnovativetechnology.com');
define('PWDBY', 'Rapture Broadcasting Network');

/* Site name */
define('SITE_NAME', 'Rapture Broadcasting Network');
define('SITE_TITLE', SITE_NAME);

// pagination defalut limt
define('DEF_PAGE_SIZE', 25);
define('ORDERP', 10000);

// define table name ///
define('tblName', $comp);
define('CUR', '');
define('CURRN', 'Rs ');

// Include files 
require_once(SITE_FS_PATH."/lib/pdo.inc.php");
require_once(SITE_FS_PATH."/lib/function.inc.php");
require_once(SITE_FS_PATH."/lib/adminfunction.inc.php");
require_once(SITE_FS_PATH."/lib/php_image_magician.php");
require_once(SITE_FS_PATH."/lib/sitemap.php");

// Data base class object 
$PDO = new dbc();

// comman function lass object 
$RW = new FuncsLib();

// Admin function file ///
$ADMIN = new FuncsAmd();
$SETNG = $PDO->db_fetch_array($PDO->db_query("select * from #_setting where `pid`='1' "));

$PRECH_BY =array('1'=>'webinnovativetechnology.','2'=>'SHIV','3'=>'');
if($_SERVER['REQUEST_URI']=='/index.html' || $_SERVER['REQUEST_URI']=='/index.php')
{
header('location:'.SITE_PATH);
exit;
}
?>