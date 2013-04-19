<?php
  define('A_ROOT', dirname(__FILE__).'/');

	require_once A_ROOT.'bmc/main.php';


	include_once A_HOME.'fun_login.php';


	if(isset($_GET['loop']) && $_GET['loop'] > 3)
		Bmc_Template ('error_message', 'Cookies turned off or not working in your browser');









    if(isempty($_GET['_account_'])){
        $c = $_SERVER['REQUEST_URI'];
				if(basename($c) != __FILE__){
				  	setcookie("BMC_redirect", $c, time()+9992000);
					  $_COOKIE['BMC_redirect'] = $c;
				}
  	}



	//redirect2

			if(noempty($_SERVER['HTTP_REFERER'])
			&& strpos($_SERVER['HTTP_REFERER'], $MY_URL)=== 0
			&& basename($_SERVER['HTTP_REFERER'])!= 'install.php'
			&& basename($_SERVER['HTTP_REFERER'])!= __FILE__
			&& strpos($_SERVER['HTTP_REFERER'], '_account_=')=== false){

				setcookie("BMC_redirect", $_SERVER['HTTP_REFERER'], time()+9992000);
				$_COOKIE['BMC_redirect'] = $_SERVER['HTTP_REFERER'];

			}

	//redirect2















//print_r($_POST);
//print_r($_COOKIE);


//START/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if(
		isempty($_POST['wp_user_login']) || 
		isempty($_POST['wp_user_pass']) || 
		isempty($_POST['wp_'.LOGIN_HASH]) || 
//		(sha1(session_id()) != $_POST['wp_'.LOGIN_HASH]) ||
		bad_cap(false, true)
	)
	{
			include A_VIEW."login_form2.php";
			exit;
	}

	
		if(!isset($_POST['wp_hash']) ||  $_POST['wp_hash'] != 'ok')
			$_POST['wp_user_login'] = md5(strtolower($_POST['wp_user_login']));
		$_POST['wp_user_login'] = a($_POST['wp_user_login']);
			

			
			$USER=$db->query("
				SELECT * FROM `".PRF."users`
				WHERE MD5(`login`) = {$_POST['wp_user_login']} 
				LIMIT 1", false);
						
			if($USER) 
				$_POST['wp_user_pass'] = bmc_hash($_POST['wp_user_pass']);

			if($USER && (empty($USER['pass']) || $USER['pass'] != $_POST['wp_user_pass']))
				$USER = null;



	if(!($USER)) {
			$user_message[] = 'Wrong username or password ';
			include A_VIEW."login_form2.php";
			exit;
	}
	
	
	unset($USER['login']);
	unset($USER['algo']);
	unset($USER['salt']);
	unset($USER['pass']);
	unset($USER['time']);
	unset($_POST);










/////////////////////////////////////////////////////
					include_once A_HOME."ip_fun.php";
					
					$admin_ip = a(ip2long(get_real_ip()));
					$_sid = uuidv4();
					$sid = a($_sid);
					$user_agent = a( sha1($_SERVER['HTTP_USER_AGENT']) );
					$time = time();
//mac address
					$db->query("REPLACE INTO `".PRF."login` 
					
					(`ip`,`sid`,`user_agent`, `time`, `user`)

					VALUES ($admin_ip, $sid, $user_agent, $time, {$USER['id']})");
			 		

					$db->query("DELETE FROM `".PRF."login`  WHERE `time` < ".($time - LOGIN_TIME_LIMIT));


				 	if(noempty($_POST['wp_remember']))
				 	    $time += LOGIN_TIME_LIMIT;
				 	else
              $time  = 0;



	setcookie("BMC_sid", $_sid, $time);
	$_COOKIE["BMC_sid"] = $_sid;
	setcookie("BMC_remember", noempty($_POST['wp_remember']), $time);
	$_COOKIE["BMC_remember"] = noempty($_POST['wp_remember']);





?>
