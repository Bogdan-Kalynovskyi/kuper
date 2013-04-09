<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");



//=========================== End user config =======================
$user_online_timeout=250; // Time in minutes when the 'online users' list is to be reset// TODO INTO GLOBAL VARS
//=========================== End user config =======================




if(!@$bmc_vars['users_online']) return;
if(isset($users_online)) {//?????????????????????

/*	$db->query("DELETE FROM ".MY_PRF."users_online WHERE time_stamp < ".(time()-$user_online_timeout));
	$users_online=$db->query("SELECT * FROM ".MY_PRF."users_online ");
*/
//але створення інтуксу по тайм і апдейт його при кожному вході користувача це просто жопа тому відмовляємось. розділення таблиць блять! ось вихід!!!!
//подумати


	$users_online=$db->query("SELECT id, ip, user_name, user_login, user_showid FROM ".MY_PRF."users WHERE time > ".(time()-$user_online_timeout)." AND user_show_pic = 1 ");

	foreach($users_online as $user) {
		//if(IS_ADMIN) 
		echo echoip( long2ip($user['ip']) );

		echo " <a href= \"profile.php?user={$user['id']}\">".simplewrap(bmc_dispuser1($user))."</a> <br />";

		}






}//else{
/*	
	if($USER && $USER['user_show_pic']){


	$online_ip="INET_ATON('{$_SERVER['REMOTE_ADDR']}')";

	$online_name = a(bmc_dispUser1($USER));
	
	$online_user= $USER['id'];

	if(!$db->query("SELECT user FROM ".MY_PRF."users_online WHERE user='{$online_user}' LIMIT 1", false)) 
	{

		$db->query("INSERT DELAYED INTO ".MY_PRF."users_online (time_stamp,ip,user,name) VALUES('".time()."',$online_ip,'{$online_user}', $online_name)");
		
	}else{
		$db->query("UPDATE DELAYED ".MY_PRF."users_online SET time_stamp= '".time()."' WHERE 
		user = $online_user ");
//		$db->query("REPLACE DELAYED ".MY_PRF."users_online SET time_stamp= '".time()."', ip='{$online_ip}' 
//		user='{$online_user}' ,name=$online_name ");
			
	}

}*/


?>
