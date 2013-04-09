	
if(isset($_GET['action']) && $_GET['action']=='restore_pass'){
	
	$admin_id = htmlspecialchars($db->evaluate("SELECT login FROM ".PRF."users WHERE id = 1"));
//to disable injections
	$admin_pass = mt_rand(0,10000000);
//if email and andmin_id are not checked properly, the script is vulnerable to various injections!!!
//all the vares should be checked properly...

	$db->query("UPDATE ".PRF."users SET pass='$admin_pass' WHERE id = 1");

	$subject = "Oldo email restore";	
	$message = "
				------------------------
				username = $admin_id
				password = $admin_pass
				------------------------";
	
		// Send the mail
	$_GET['restore_success'] = bmc_mail($subject, $message);
	
	unset($admin_pass);unset($message);unset($conf_dat);
	unset($from);	unset($to);	unset($headers);

	
	include A_ROOT."goto_login.php";//critical for adminfph
}
	





