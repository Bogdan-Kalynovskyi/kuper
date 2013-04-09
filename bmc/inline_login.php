<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");


if(!isset($_GET['account']) || empty($_GET['account'])){
//redirect1

	if(strpos($_SERVER['REQUEST_URI'], $DIFFR) === 0)
	   $c = substr($_SERVER['REQUEST_URI'], strlen($DIFFR));
	
	if(isset($c) && isempty($_COOKIE['BMC_redirect']) && $c != 'install.php' ){
		setcookie("BMC_redirect", $c, 1000000,COOKIE_PATH,COOKIE_DOMAIN);
		$_COOKIE['BMC_redirect'] = $c;
	}
//redirect1
}

	
	include A_ROOT."login.php";
	
	
?>