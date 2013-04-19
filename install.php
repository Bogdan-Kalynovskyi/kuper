<?php
	error_reporting(E_ALL); 

	define('IN_INSTALL', true);
	define('IN_BMC', true);
  define('HOME_DIR', dirname(__FILE__));
	$CHRST='windows-1251';$dbchrst=$_POST['db_chrst']='cp1251';
	

		header("Cache-Control: no-cache");
		header("Expires: -1");
		header('Pragma: no-cache');
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
		header('Cache-Control: no-store, must-revalidate, post-check=0, pre-check=0', FALSE); 
		header('Content-Type: text/html; charset=windows-1251');


if(file_exists("config.php"))
	include "config.php"; 	// EXISTS AND EMPTY IN INSTALL !!


//bulletproof header
?><!DOCTYPE html>
<html>
<head>
<meta charset=windows-1251>
<meta name="robots" content="noindex,nofollow">
<link rel=stylesheet href="css/bstyle.css">

	<title> Oldo Tools - Easy Installation </title>

	<script>//make it nicer
	<!--
		function db_checker(){//todo
				var width = 400;
				var height = 540;
				var screenX = parseInt(screen.width/2 - width/2);
				var screenY = parseInt(screen.height/2 - height/2);
				var features= "width=" + width + ",height=" + height
				+ ",screenX=" + screenX + ",left=" + screenX + ",screenY=" + screenY  +",top=" + screenY;
				features += ",+toolbar=No,menubar=No,resizable=No,scrollbars=No,status=No,location=No";
				var url = 'check_db_exists.php?install=true&amp;sid=<?php echo md5(sha1(session_id())); ?>'
+'&amp;db_host=' + escape(document.install.db_host.value)
+'&amp;db_name='+ escape(document.install.db_name.value)
+'&amp;db_user='+ escape(document.install.db_user.value)
+'&amp;db_pass='+ escape(document.install.db_pass.value)
+'&amp;db_prefix='+ escape(document.install.db_prefix.value);
//check fields

				var mywin=window.open(url, "popup", features);

				mywin.focus();
		}

		function isBad(sInString) {//empty or non alphanumeric
   			if(sInString == null || sInString == undefined || sInString === '')return true;
   			if( !(sInString.match(/\S/)))return true;
   			var patt1=/[^a-zA-Z0-9_]/;
			return sInString.match(patt1);
		}
		function isBad2(sInString) {//url of db_host
   			if(sInString == null || sInString == undefined || sInString === '')return true;
   			if( !(sInString.match(/\S/)))return true;
   			var patt1=/[^a-zA-Z0-9_\-\/\\\.\:]/;//TODO
			return sInString.match(patt1);
		}

		function check_form(){//trim
			if(isBad2(document.install.db_host.value) ){
                document.install.db_host.focus();
				alert("Please enter valid db_host");
   				return false;
            }
			if(isBad(document.install.db_name.value)){
                document.install.db_name.focus();
				alert("Please enter valid db_name");
   				return false;
            }
            if(isBad(document.install.db_user.value)){
                document.install.db_user.focus();
				alert("Please enter valid db_user");
   				return false;
            }
		if(isBad(document.install.admin_id.value)||document.install.admin_id.value.length<3|| document.install.admin_id.value.length>20){
                document.install.admin_id.focus();
				alert("Login length must be between 0 and 20 symbols");
   				return false;
            }
			if(document.install.admin_pass.value.length <3 || document.install.admin_pass.value.length >20){
                document.install.admin_pass.focus();
				alert("Password length must be between 0 and 20 symbols");
   				return false;
            }
			if(document.install.admin_pass.value !== document.install.admin_pass2.value ){
                document.install.admin_pass2.focus();
				alert("Passwords do not match!");
   				return false;
            }

			return true;
		}
//-->
	</script>	
</head>

<body>
 <div id="align_center">
   <div class="form_fields">







<?php   

//<br><h1>You do not have PHP running on your webserver!</h1><h2>Sorry this site requires PHP5, MySQL5 and preferably Apache running on your hosting</h2> <!--


//test for Apache MySql, other tests...



	/*  FIRST STEP  */

	// Add explanations
	//THIS INCLUDES AUTO PREFIX - CHANGE PREFIXES UNTILL YOU FIND A FREE ONE


if(empty($_POST['data_sent']) ) {


		$db = false;
		if(isset($my_db) && isset($my_host) && isset($my_user) && isset($my_pass)) {
			$conn = @mysql_connect($my_host, $my_user, $my_pass);
			$db=@mysql_select_db($my_db, $conn);
			@mysql_close();
		}
?>








<h1>Easy Installation</h1>
<h1 style="font-size:8pt;padding-bottom:22px">Oldo's Global Admin Tool Wise Installation</h1>


<form accept-charset="<?php echo $CHRST ?>" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="install" onsubmit="return check_form()">
<input type="hidden" name="data_sent" value="true">
<input type="hidden" name="c_url">
MySQL server : <input type="text" name="db_host" class="low" value="<?php if(isset($my_host)) echo $my_host; else echo 'localhost';?>"><br>
MySQL database : <input type="text" name="db_name" class="low" value="<?php if(isset($my_db)) echo $my_db; else echo 'demo'; ?>"><br>
MySQL tables prefix : <input type="text" class="low" name="db_prefix" value="<?php if(isset($my_prefix)) echo $my_prefix; else echo '<auto>';?>" onblur="if(this.value==' ')this.value='<auto>';"onfocus="if(this.value=='<auto>')this.value=' ';"><br><br>


MySQL user : <input type="text" name="db_user" value="<?php if(isset($my_user)) echo $my_user; ?>"><br>
MySQL password : <input type="password" name="db_pass" value="<?php if(isset($my_pass)) echo $my_pass; ?>"><br>
<input type="button" onclick="db_checker()" value=" Check MySQL settings " id="bt1"><br><br>


Create a new database? &nbsp; <input type="checkbox" name="new_db" <?php if(!$db)echo 'checked="checked"'; ?>><br>
Overwrite tables if exist? &nbsp; <input type="checkbox" name="ow" <?php if(isset($my_db))echo 'checked="checked"'; ?>><br><br>


Admin Username : <input type="text" name="admin_id"><br>
Create password : <input type="password" name="admin_pass"><br>
Retype password : <input type="password" name="admin_pass2"><br><br>


<?php

	// Check whether bm is already installed хуйовий дизайн =)
	if($db) {

		echo '
		<span style="color:#490000">Warning! Site seems to be already installed. <b>Proceeding can destroy current data!</b></span><br>
		<a href="index.php" target=_blank style="text-decoration:underline;font-size:109%;padding-right:1px;">&nbsp;View existing installation&nbsp;</a>';

	}else{
		echo "<i style=\"color:#838\">System requirements: MySQL5, PHP5, Apache, FTP</i>";
	}
	
	// MICROSOFT IIS FUCKS AWAY
?>
<br><br>
<input type="submit" value= "  <<<  Continue  >>>  " id="bt2">
</form>

<br><a href="mailto:mybodya@gmail.com">&copy; Oldo Production, 2009</a>


<script>
	try{document.install.c_url.value=document.location;}catch(e){}
	<?php if($db) echo'try{document.install.admin_id.focus();}catch(e){}'; ?>
</script>
<noscript>
	<h1>Please enamble JavaScript and reload the page. Thank you!</h1>
</noscript>

<?php
footer(); 
		echo "<br><i style=\"color:#838\">You have: PHP".phpversion().phpinfo().print_r($_SERVER)."</i>";// mysql_get_server_info() //GD
exit();
}
?>














































	
<?php

		/*  SECOND STEP  */
		



/***************************************  Verifying the form *******************************************/
echo '<div style="text-align:center; 	font-family:Georgia; margin-top:-20px; margin-bottom:9px">--- Installation ---</div>';
echo "Checking form data...  ";

//strong check;
	$err = array();

	if(isset($_POST['db_prefix']) && ($_POST['db_prefix'] == '<auto>')) $_POST['db_prefix']='';
	foreach($_POST as &$p)$p = trim($p);

	// replace non-alphanumeric for MySql //
	foreach($_POST as $key=>$el) if($key!='c_url'&&$key!='admin_pass'&&$key!='admin_pass2')
	{
			if(!($key=='db_host' && preg_match('/[^a-zA-Z0-9\-_\:\\\\\/\.\-]/', $el) ))
				continue;
			elseif(! preg_match('/[^a-zA-Z0-9\-_]/', $el) )
				continue;
		
			$err[] = "<h1>Ooops!</h1>\n<b>$key</b> contains non-alphanumeric symbols";	
	}
	

	if(empty($_POST['db_host'])) 
		$err[] = ( "<h1>Ooops!</h1>\nPlease enter your MySQL host name");
	if(empty($_POST['db_name'])) 
		$err[] = ( "<h1>Ooops!</h1>\nPlease enter your MySQL database name");
	if(empty($_POST['db_user'])) 
		$err[] = ( "<h1>Ooops!</h1>\nPlease enter your MySQL user name");
	if(!isset($_POST['db_pass']) || strlen($_POST['db_pass']) < 5)echo '<b><br><small style="color:#900">Using DB pasword shorter than 5 symbols is security risk!</small></b><br>...';
//<auto...>
	if(empty($_POST['admin_id']) || strlen($_POST['admin_id']) < 3 || strlen($_POST['admin_id']) > 20) 
		$err[] = ( "<h1>Ooops!</h1>\nAdmin username must have from 3 to 20 symbols");
	if(empty($_POST['admin_pass']) || strlen($_POST['admin_pass']) < 3 || strlen($_POST['admin_pass']) > 20) 
		$err[] = ( "<h1>Ooops!</h1>\nAdmin password must have from 3 to 20 symbols");
	if(!isset($_POST['admin_pass2']) || $_POST['admin_pass'] != $_POST['admin_pass2']) 
		$err[] = ( "<h1>Ooops!</h1>\nAdmin passwords do not match!");
		

	if($err)footer(implode('<br>', $err));
	 

// finish verifying form, get clean variables
	$my_host= $_POST['db_host'];$my_user= $_POST['db_user'];$my_pass= $_POST['db_pass'];
	$my_db= $_POST['db_name'];	$my_prefix 	= $_POST['db_prefix']; //$my_extra connection


echo "Done <br>";



		
		
/********************************** check correct installation **********************************/
echo "Verifying if project uploaded correctly...";

	$bmc_dir='bmc';
	
	clearstatcache();
	if(!is_dir($bmc_dir)/* || !is_dir('img') || !is_dir('css') and verify size/.../num files/filetype structure readability*/|| !is_file("vars/config.php"))
		footer( "<h1>Error!</h1>Directory <b>$bmc_dir</b> (or some other file) not found in the folder where install.php runs. Project uploaded incorrectly, not all files present");	

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//TODO ARRRAY UPLOAD FOLDERS//is_readable

	if(!is_writable("upload/") || !is_writable("thumbs/") || !is_writable("pics/"))
	{		
		echo "<br>Ooops. Not writable <b>upload/</b>, <b>pics/</b> and <b>thumbs/</b> folders. Fixing...";
		@chmod("upload/", 0644); @chmod("thumbs/", 0644); @chmod("pics/", 0644);
		if(!is_writable("upload/") || !is_writable("thumbs/") || !is_writable("pics/"))
			{@chmod("upload/", 0666); @chmod("thumbs/", 0666); @chmod("pics/", 0666);}
		if(!is_writable("upload/") || !is_writable("thumbs/") || !is_writable("pics/"))
			footer("Failed! Please go to Cpanel or FTP client and make folders <b>upload/</b>, <b>pics/</b> and <b>thumbs/</b> writable, permission 644 (or 666 if this doesn't help)");

		echo "Fixed!<br>";
		
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	 
	  if(!is_writable("vars/config.php")/* || !is_writable("vars/session.php")*/)
	  {
			echo "<br>Ooops. Files inside <b>vars/</b> <br>directory are not writable. Fixing... <br>" ;
			@chmod("vars/", 0600); @chmod("vars/config.php", 0600);/*!@chmod("vars/session.php", 0600)*/
			if(!is_writable("vars/config.php"))
				{@chmod("vars/", 0600); @chmod("vars/config.php", 0600);}
			if(!is_writable("vars/config.php"))
		/* phpbb chmod */	
				footer("Failed! Please go to your Cpanel or FTP client and make all files inside <b>vars/</b> directory writable, permission 600 (or 666 if this doesn't help)");
			
		echo "Fixed!<br>";//if nothing helps give them file by ftp, let them write it and skip thias step
	
	 }
echo "Done <br>";


/**************************************************************************************************/
echo "Getting site URL...  ";

	$c_url=		dirname($_POST['c_url']);  
	$pageURL=	get_url();
	 	
  	if($pageURL != $c_url)echo '<h1>c_url</h1>'; 

	if( empty($pageURL) ||  !urlexists($pageURL))
		footer( "<h1>Error!</h1>Unable to determine the absolute path to current directory on server");

echo "Done <br>";


/**************************************************************************************************/
//somethin nore needeed to feel myself cool...









/***************************		   Mysql      ************************************************/

	echo "Connecting to Mysql...  ";
	$conn = @mysql_connect($my_host, $my_user, $my_pass) or footer('Could not connect: ' .mysql_error());
	echo "Done <br>";	//
	
	
	if(isset($_POST['new_db'])) {//TODO

		echo "Creating new database... ";//--DROP DATABASE if exists `$my_db`;
		@mysql_query("CREATE DATABASE IF NOT EXISTS `$my_db` DEFAULT CHARACTER SET {$_POST['db_chrst']} COLLATE {$_POST['db_chrst']}_general_ci ") or footer(mysql_error());
		echo "Done <br>";//dochutatu //what about not creating collate? what about rewriting ratabase?		or creating database if not exists?
	}/*else{
		echo "Altering database...";
		@mysql_query("ALTER DATABASE `$my_db` DEFAULT CHARACTER SET {$_POST['db_chrst']} COLLATE {$_POST['db_chrst']}_general_ci ") or footer(mysql_error());
		echo "Done <br>";
	}*/

	echo "Selecting database...  ";
	@mysql_select_db($my_db, $conn) or footer('Could not connect: ' .mysql_error());
	echo "Done <br>";
	
	@mysql_query("SET NAMES $dbchrst") or footer('SET NAMES error: ' .mysql_error());; ///!!!



	include 'install_database.php';



	@mysql_close();










































// The config file THINK OF OTHER SETTINGS YOU RELY ON, YOU CONSIDER SHOULD BE SO OR YOU USE DEFAULTS
echo "Writing data to config file...  ";

$conf_dat=<<<EOF
<?php

if(!defined('IN_BMC')) 
	die();
 
error_reporting(E_ALL);
//error_reporting(0);


\$my_host='$my_host';
	// Your MYSQL server
\$my_user='$my_user';
	// Your MySQL username
\$my_pass='$my_pass';
	// Your MySQL password
\$my_db='$my_db';
	// Your MySQL database name
\$my_prefix='$my_prefix';
	// MySQL tables prefix
\$my_charset='$dbchrst';

//correct url to the root;
\$MY_URL='$pageURL';

//set when installing the database
\$CHRST='$CHRST';
?>
EOF;


	if( !($w=fopen("config.php", "w")) || (! fputs($w,$conf_dat)))
		  	footer("<big style=\"color:#900\">Can't write config file <b>"."config.php</b>!</big> permission not 666?");
	fclose($w);
	
	@chmod("vars/config.php", 0400);


echo "Done <br><br><hr><br>";

?>

<h1 style="font-family:verdana">Congratulations!</h1><br>
<b style="color:#070">
&bull; Site successfully installed on your webserver!<br>
&bull; All the configuration is stored in this file:<br></b><big><i><?php echo HOME_DIR;?>/config.php</i></big>



<?php /*
<br><br>
	<big style="color:#090">
U s e r n a m e : &nbsp;&nbsp; <strong><?php echo $_POST['admin_id']; ?></strong><br>
P a s s w o r d : &nbsp;&nbsp; <strong><?php echo $_POST['admin_pass']; ?> todo show password !!!! </strong>
	
	your usrname and password can now be sent on your email
	
	<INPUT ADMIN EMAIL>
	
</big>*/

	$fname = md5(uniqid('', true).md5(mt_rand()));


?>

<br><br>
<div style="border:2px solid #c66;color:#000;padding:6px;text-align:left">
 <u>Note:</u><br> File <strong>install.php</strong> <?php if($ren){?>renamed to <strong>_install.php**** </strong><?php } ?>. It's a security risk to leave it on your webserer. It's recommended to <a style="text-decoration:underline" href="install_delete.php?id=<?php echo $fname; ?>&amp;sid=<?php echo md5(sha1(session_id())); ?>" target=_blank>delete it by clicking this link</a>. If you ever need to reinstall the site, get install.php out of the installation archive and upload it to the site's root directory
</div>
<br><br>
<input type="button" id="bt3" value="    <<<  Log In  >>>     " onclick="document.location = '<?php echo $pageURL; ?>'"><br>
<script>
try{document.getElementById('bt3').focus();}catch(e){}
</script>
<?php

	footer();


























function footer($fail=null) {
	if($fail){ echo "<strong style=\"color:#d00;\">Failed!</strong> <br><br><strong style=\"color:#a00;\">Error message :</strong> $fail";
	?>
<br><br><input style="border-color:#333" type="button" onclick="history.go(-1)" value="  <-- Back  ">
<?php } ?>
</div></div>
</body></html>
	<?php
		//
}


function get_url(){
		$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 		$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") 
  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	else
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	
  		
	if(!preg_match('/((http(s?))\:\/\/)/i', $pageURL))return null;
	return dirname($pageURL);
	//error todo port!
}

function urlexists($url) {
	$header = @get_headers($url);
	return preg_match('/^HTTP(.*)(200|301|302|303|304|307)(.*)$/i', $header[0]);
}


/*$file = @file_get_contents("http://YOURDOMAINHERE/phpinfo.php");

$start = explode("<h2><a name=\"module_mysql\">mysql</a></h2>",$file,1000);
if(count($start) < 2){
echo "MySQL is not on this server.";
}else{
$again = explode("<tr><td class=\"e\">Client API version </td><td class=\"v\">",$start[1],1000);
$last_time = explode(" </td></tr>",$again[1],1000);
echo "MySQL Version: <b>".$last_time[0]."</b>";
}
*/

?>
