<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_errors', 'On');
/*function archiveloader ($class){
	if(is_file(dirname(__FILE__)."/archive/$class/$class.php"))
	{
	include dirname(__FILE__)."/archive/$class/$class.php";
	}else{
		//error_log("Failed to load Class $class");
		//dirname(__FILE__)."/$class/$class.php\n";
	}
}
spl_autoload_register("archiveloader");*/

$archiveconfig = array(
	"archivedbserver"=>'sjcthearchive.cb1qb4plxjpf.us-east-1.rds.amazonaws.com',
	"archivedbuser"=>'abEasyCatalog',
	"archivedbpass"=>'15bentonroad!',
	"archivedb"=>'alphabrodermaster',
	"archiveUrl"=>'http://localhost/archive/',
	"ApiLogPath"=>"/archive_library/archive_logging/archive_logs/api_logs",
	"SysLogPath"=>"/archive_library/archive_logging/archive_logs/sys_logs",
	"archive_user"=>isset($_POST['email'])?$_POST['email'] : NULL,
	"archive_pass"=>isset($_POST['pass'])?$_POST['pass'] : NULL,
	"archive_file_storage_path"=>"/var/www/html/sjcPimitArchive/archive/archive_files/storage",
	"archive_file_tmp"=>"/tmp"
	);


?>
