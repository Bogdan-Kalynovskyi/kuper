<title>Admin Area</title>
<link rel=stylesheet href="css/layout.css">
<link rel=stylesheet href="css/style.css">
</head>


<body>
<div id="header" style="padding-left:133px; min-height:140px">
    <div style="height:30px;*height:20px">&nbsp;</div>

    <?php if (!empty($USER)) { ?>
        <h2>Logged In</h2><br/><br/>
    <?php } ?>

    <a href="user_area.php"><b>User profile example</b></a>&nbsp;&nbsp;
    <a href="manage_users.php"><b>Admin users</b></a>&nbsp;&nbsp;
    <a href="manage_projects.php"><b>Admin projects</b></a>&nbsp;&nbsp;
    <a href="view_projects.php"><b>User projects</b></a>&nbsp;&nbsp;
    <a href="settings.php"><b>Settings</b></a>&nbsp;&nbsp;
    &nbsp;&nbsp;
    <!--<a href="account.php?action=logout"><b>Logout</b></a>&nbsp;&nbsp;
    <a href="account.php?action=change_pass"><b>Change pass</b></a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="index.php"><b>View SITE</b></a>-->

    <?php } ?>

    <div class="logo"><a href="index.php" style="text-decoration:none;"><h1></h1></a></div>
</div>		
