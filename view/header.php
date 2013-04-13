<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}
global $FILE, $CHRST, $table, $USER;//...

NonCachePlusEncoding();


?><!DOCTYPE html>
<html>
<head>
    <meta charset=<?php echo $CHRST; ?>>
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="robots" content="noindex, nofollow">
    <meta name="webmaster" content="mybodya@gmail.com">

    <?php

    if (defined('LEVEL') && LEVEL) {
        $title = ' - ' . str_replace('_', ' ', $FILE);
        if (LEVEL == 3) {
            echo "<title>Admin area$title</title>";
        }
        else {
            echo "<title>User area$title</title>";
        }
    }
    else {
        echo "<title>Welcome!</title>";
    }

    ?>
    <link rel=stylesheet href="css/reset.css">
    <link rel=stylesheet href="css/layout.css">
    <link rel=stylesheet href="css/style.css">
    <link rel=stylesheet href="css/clear.css">
    <link rel=stylesheet href="css/specific.css">


</head>


<body><?php
if (LEVEL) {
    if (LEVEL < 3) {
        echo '<h3 class="toph3" style="background:#99F">User area&nbsp; - &nbsp;<a href="user_home.php" title="Go to profile...">' . $USER['name'] . '</a></h3>';
    }
    else {
        echo '<h3 class="toph3" style="background:orange">Admin area <!-- - find more! --></h3>';
    }
}

?>




<div class="header">





<?php

if (LEVEL) { ///////
    //*** 1 ***

    include A_HOME . "logout_box.php";

    //*** 2 ***
    include A_HOME . "box_search.php";


    //*** 3 *** //include menu.php
    $s1 = $s2 = $s3 = $s4 = $s5 = $s6 = 'style="background:';
    $s1 .= '#aee"';
    $s2 .= '#eae"';
    $s3 .= '#eea"';
    $s4 .= '#bfb"';
    $s5 .= '#fbb"';
    $s6 .= '#bbf"';

    switch ($table) {
        case '':
        case 'users':
        if ($FILE == 'index' || $FILE == 'user_home' || $FILE == 'inbox') {
            $s1 = 'class="menu_active"';
        }
        else {
            $s4 = 'class="menu_active"';
        }
            break;
        case 'news':
            $s2 = 'class="menu_active"';
            break;
        case 'projects':
            $s3 = 'class="menu_active"';
            break;
        case 'surveys':
            $s5 = 'class="menu_active"';
            break;
        case 'payments':
            $s6 = 'class="menu_active"';
            break;
    }


    ///*** 4 *** //print menu
    echo <<<EOF
		<i class="loggedin">Logged In</i>
		
		<div class="menu">
			<a $s1 href="user_home.php">Profile</a><a $s2 href="view_news.php">News</a><a $s3 href="view_projects.php">Projects</a><a $s4 href="view_users.php">Users</a><a $s5 href="view_surveys.php">Surveys</a><a $s6 href="view_payments.php">Payments</a>
		</div>
		
	</div>	
EOF;


///* 5 *///search results if any
    include A_HOME . "search_results.php";


///* - *///container
    echo '<div class="container">';


///* 6 *///STICKER
    echo '<div class="wrapper">';

    if ($table && LEVEL == 3 && strpos($FILE, 'edit') !== 0 && !(isset($_GET['selector']) && $_GET['selector'] === 0)) {
        echo '<a class="newer1" href="edit_' . $table . '.php?selector=0">New ' . short_name($table) . '</a>';
    }

    if ($table && LEVEL == 3 && strpos($FILE, 'edit') !== 0) {
        echo '<a class="editer1" href="edit_' . $table . '.php' . (isnumeric($_GET['id']) ? ('?selector=' . $_GET['id']) : '') . '">Edit ' . $table . '</a>';
    }

    if ($table && strpos($FILE, 'view') !== 0) {
        echo '<a class="viewer1" href="view_' . $table . '.php">View ' . $table . '</a>';
    }

    if (LEVEL == 3 && in_array($FILE, array('user', 'project', 'survey', 'bid', 'payment'))) {
        echo '<br><a class="noter1" href=# onclick="js_note(); return false;">Make a note</a>';
        echo '<a class="noter1" href=# onclick="js_find(); return false;">Find a note</a>';
    }

    echo '</div>';
///* 6 *///STICKER

    //echo '<br><br>';

}//////

?>