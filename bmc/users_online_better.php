<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


if (!@$bmc_vars['users_online']) {
    return;
}
$user_online_timeout = 250; // Time in minutes when the 'online users' list is to be reset
//=========================== End user config =======================


if (isset($users_online)) {

    $db->query("DELETE FROM " . MY_PRF . "users_online WHERE time_stamp < " . (time() - $user_online_timeout));
    $users_online = $db->query("SELECT * FROM " . MY_PRF . "users_online ");

    foreach ($users_online as $user) {
        //if(IS_ADMIN)
        echo echoip(long2ip($user['ip']));


        echo " <a href= \"profile.php?user={$user['user']}\">{$user['name']}</a> <br>";
    }


}
else {

    if ($USER && $USER['user_show_pic']) {


        $online_ip = "INET_ATON('{$_SERVER['REMOTE_ADDR']}')";

        $online_name = a(simplewrap(bmc_dispUser1($USER)));

        $online_user = $USER['id'];

        if (!$db->query("SELECT user FROM " . MY_PRF . "users_online WHERE user=$online_user ", false)) {

            $db->query("INSERT DELAYED INTO " . MY_PRF . "users_online (time_stamp,ip,user,name) VALUES('" . time() . "',$online_ip,$online_user, $online_name)");

        }
        else {
            $db->query("UPDATE DELAYED " . MY_PRF . "users_online SET time_stamp= '" . time() . "' WHERE
		user = $online_user ");
//		$db->query("REPLACE DELAYED ".MY_PRF."users_online SET time_stamp= '".time()."', ip='{$online_ip}' 
//		user='{$online_user}' ,name=$online_name ");

        }

    }
}

?>
