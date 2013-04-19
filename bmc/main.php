<?php
  define('IN_BMC', true); 	// = HOLY PLACE =-)

  require A_ROOT.'bmc/config.php';

	$TIME_START = microtime(TRUE);
	
	define('A_VIEW', A_ROOT.'view/');
	define('A_ADMIN', A_ROOT.'backend/');
	define('A_HOME', A_ROOT.'bmc/');
	define('PRF', 	 $PRF);

	include_once A_HOME.'db_mysql.php';
	include_once A_HOME.'functions.php';
	include_once A_HOME.'output_functions.php';

	$db = new bDb;

//globals	
	$FILE = str_replace('.php', '', basename($_SERVER['SCRIPT_NAME'])); //todo: right

//forms
	define('LOGIN_HASH',  'Aewf2s0dG!s3d7');
	define('SEARCH_HASH', 'Aewf2s2dGfs3d7');
	define('FORM_HASH',   'B323fd3fFs3471');

//security	
	define('LOGIN_TIME_LIMIT', 60*60*24*7);
	

//////////////////////////      secific part       ///////////////////////////////
//	ini_set('session.use_only_cookies', 'on');//todo!!!!!!!!


	bmc_getSets();//use file config.php and caching


///////////////////////////		 fixes	all 	///////////////////////////////////


if(get_magic_quotes_gpc()){//äóìàºì ïðî âñ1 çàáàãàíêò//tut mae butu we wos
	$_GET = stripslashes_deep($_GET);
	$_POST = stripslashes_deep($_POST);
	$_COOKIE = stripslashes_deep($_COOKIE);
}//ÿ íå ïàöàå ÿêùî íå çàâèïèøó òóò âåñü ñïèñîê åêñåïøåíûâ



///////////////////////////////////////////////////////////////////////////////////
/////////					ALL JOB DONE								///////////
///////////////////////////////////////////////////////////////////////////////////










//***************************** - ajax - ************************************

		include A_HOME.'lang/'.$bmc_vars['lang'].'.php';

























/////////////////////////////////////////////////
///////////  accout management //////////////////	
/////////////////////////////////////////////////



	include A_HOME.'_account.php';



/////////////////////////////////////////////////
///////////  authentification  //////////////////
/////////////////////////////////////////////////


//// USER ////
/*	$USER = null;

	$USER  = bmc_getLogged();	MOVED TO ACCOUNT! */


	if($USER && is_array($USER) && is_numeric($USER['level']))
		define('LEVEL', $USER['level']);
	else
		define('LEVEL', 0);




		
	if(defined('REQUIRED') && REQUIRED > LEVEL){


		if($USER && !is_array($USER))//cant login//ðàçðûâ ñåêüþðèòè
				$user_message[] = 'Session expired or IP changed. Please retype password';


		if(is_array($USER))//can't access
				$user_message[] = 'You don\'t have enough permissions to view this page';

		//ghjïðîèçîøåë àïàðàòíûé ñáîé èëè èáðûâ cookies

		include A_ROOT.'login.php';
		
					
	}
	

	
	define('IS_ADMIN', LEVEL==3);
	












	


//	include_once A_HOME.'reflog.php';
//	include_once A_HOME.'users_online.php';

?>
