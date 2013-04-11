<?php 
	if(!defined('IN_BMC'))
		die("Access Denied!");



	header("Content-Type: text/html; charset=$CHRST");
		header("Cache-Control: no-cache");
		header("Expires: -1");
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0', FALSE); 
		header('Pragma: no-cache');

		
?><!DOCTYPE html>
<html>
<head> 
<meta charset=<?php echo $CHRST; ?>>
<title><?php if(LEVEL<3 && LEVEL > 0)echo 'User area'; else echo 'Admin area'?></title>
<link rel=stylesheet href="css/layout.css">
<link rel=stylesheet href="css/style.css">





</head>





<body>
<?php if(LEVEL<3 && LEVEL > 0)echo '<div style="background:#aaF"><h3>User area</h3></div>'; elseif(LEVEL==3) echo '<div style="background:orange"><h3>Admin area</h3></div>'?>
<div id="header" style="padding-left:133px; min-height:140px">
	<div style="height:30px;*height:20px">&nbsp;</div>
	
<?php if(!empty($USER)){?>
<h2>Logged In</h2><br/><br/>
<?php } ?>


<?php

	if(LEVEL<3 && LEVEL > 0) {?>

<a href="cabinet.php"><b>Cabinet</b></a>&nbsp;&nbsp;
<a href="user_area.php"><b>Profile</b></a>&nbsp;&nbsp;
<a href="view_projects.php"><b>Browse projects</b></a>&nbsp;&nbsp;
		
	<?php }elseif(LEVEL==3){ ?>
		
<a href="admin_create_user.php"><b>New user</b></a>&nbsp;&nbsp;
<a href="manage_users.php"><b>Manage users</b></a>&nbsp;&nbsp;
<a href="admin_create_project.php"><b>New project</b></a>&nbsp;&nbsp;
<a href="manage_projects.php"><b>Manage projects</b></a>&nbsp;&nbsp;
<a href="settings.php"><b>Settings</b></a>&nbsp;&nbsp;

		
	<?php } ?>
	
	
&nbsp;&nbsp;
<a href="?action=logout"><b>Logout</b></a>&nbsp;&nbsp;

<div class="logo"><a href="index.php" style="text-decoration:none;"><h1></h1></a></div>
</div>		
	