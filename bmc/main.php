<?php
define('IN_BMC', true); 	// = HOLY PLACE =-)

require  HOME_DIR."/config.php";

//==============================================================================
if(empty($my_db)) die('Site is not properly installed! <a href="install.php">Click here to install</a>');
/*if( file_exists("$root/install.php")) {OK � ����� ����1 1��1 ����� ��������1 �����1���.
	����� ������������ ������ �1� ������������ ������
	die("Please delete the file <strong>install.php</strong> from your root directory after installation. <br />
	If you haven't installed the site yet, please proceed to the <a href=\"install.php\">installation process</a>.");

//���� magic quotes register globals
}*/
//==============================================================================

	$TIME_START = microtime(TRUE);
	
	session_start();


	define("A_ROOT", $root.'/');
	define("A_VIEW", $root.'/view/');
	define("A_ADMIN", $root."/backend/");
	define("A_HOME", $root."/bmc/");
	define("PRF", 	 $my_prefix);//unset all config.php???
	$MY_URL = $MY_URL;	//$CHRST

	include_once A_HOME."db_mysql.php";
	include_once A_HOME."functions.php";
	include_once A_HOME."output_functions.php";//classes and 

	$db = new bDb;

//globals	
	$FILE = str_replace('.php', '', basename($_SERVER['SCRIPT_NAME']));

//forms
	define("LOGIN_HASH", 'Aewf2s20dGfs3d7'); 	define("LOGIN_HASH_VALUE", mt_rand(0,100000));
	define("SEARCH_HASH", 'Aewf2s2dGfs3d7');  	define("SEARCH_HASH_VALUE", mt_rand(0,100000));
	define("FORM_HASH",   'B323fd3fFs3471'); 	define("ADMIN_HASH", 'mt_rand(0,100000)');
	define("USER_HASH",   'B323fd3fFs3471'); 	define("BOT_HASH", 'sfdsfvsd|#$$#^#%^#%4634');
//logout-hash!? actions!?

//security	
	define('LOGIN_TIME_LIMIT', 60*60*24*7);		define('SECURITY2_LIMIT', 60*60*24*7);
	

//////////////////////////      secific part       ///////////////////////////////


	bmc_getSets();//use file config.php and caching


///////////////////////////		 fixes	all 	///////////////////////////////////


if(get_magic_quotes_gpc()){//����� ��� ��1 ���������//tut mae butu we wos
	$_GET = stripslashes_deep($_GET);
	$_POST = stripslashes_deep($_POST);
	$_COOKIE = stripslashes_deep($_COOKIE);
}//� �� ����� ���� �� �������� ��� ���� ������ ����������



///////////////////////////////////////////////////////////////////////////////////
/////////					ALL JOB DONE								///////////
///////////////////////////////////////////////////////////////////////////////////










//***************************** - ajax - ************************************

		include A_HOME.'lang/'.$bmc_vars['lang'].'.php';

























/////////////////////////////////////////////////
///////////  accout management //////////////////	
/////////////////////////////////////////////////



	include A_HOME."_account.php";



/////////////////////////////////////////////////
///////////  authentification  //////////////////
/////////////////////////////////////////////////


//// USER ////
/*	$USER = null;

	$USER  = bmc_getLogged();	MOVED TO ACCOUNT! */


	if($USER && is_array($USER) && isset($USER['level']))
		define('LEVEL', $USER['level']);
	else
		define('LEVEL', 0);




		
	if(defined('REQUIRED') && REQUIRED > LEVEL){


		if($USER && !is_array($USER))//cant login//������ ���������
				$user_message[] = 'Session expired or IP cahanged. Please retype password';


		if(is_array($USER))//can't access
				$user_message[] = "You don't have enough permissions to view this page";

		//ghj��������� ��������� ���� ��� ����� cookies

		include A_ROOT."login.php";
		
					
	}
	

	
	define("IS_ADMIN", LEVEL==3);
	












	


//	include_once A_HOME."/reflog.php";
//	include_once A_HOME."/users_online.php";

?>
