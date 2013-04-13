<?php

/*
if(isempty($_COOKIE['BMC_redirect'])){
	
////////////
	if(isempty($_GET['account'])){
	//redirect1
		
			if(strpos($_SERVER['REQUEST_URI'], $DIFFR) === 0)
			   $c = substr($_SERVER['REQUEST_URI'], strlen($DIFFR));
			
			if(isset($c) && $c != 'install.php' ){
				
				setcookie("BMC_redirect", $c, 1000000,COOKIE_PATH,COOKIE_DOMAIN);
				$_COOKIE['BMC_redirect'] = $c;
				
			}
			
	//redirect1
			
	}else{
		
	//redirect2
		
			if(noempty($_SERVER['HTTP_REFERER'])
			&& (basename($_SERVER['HTTP_REFERER'])!='install.php')
			&& strpos($_SERVER['HTTP_REFERER'], $MY_URL) ===0){
				
				setcookie("BMC_redirect", $_SERVER['HTTP_REFERER'],1000000,COOKIE_PATH,COOKIE_DOMAIN);
				$_COOKIE['BMC_redirect'] = $_SERVER['HTTP_REFERER'];
				
			}
			
	//redirect2
	
  	}
  	
}		
*/
include_once A_ROOT . "login.php";


?>