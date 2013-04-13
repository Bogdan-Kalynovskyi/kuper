<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}

//NonCachePlusEncoding();

?><!DOCTYPE html>
<html>
<head>
    <meta charset=<?php echo $CHRST ?>>
    <title>Управление сайтом</title>

    <link rel=stylesheet href="./editor/a.css">
    <link rel=stylesheet href="./editor/b.css">

    <script src="js/jslib.js"></script>
</head>

<body class="wp-admin no-js  index-php">

<div id="wpwrap">
    <div id="wpcontent">
        <div id="wphead" style="padding:1px 2px">

            <div id="header-logo">&nbsp;</div>
            <h1 id="site-heading"><a href="./<?php if (@$_GET['id']) {
                    echo '?id=' . $_GET['id'];
                }
                if (@$_GET['page']) {
                    echo '?page=' . $_GET['page'];
                } ?>" title="Просмотреть сайт"><span id="site-title">&nbsp;</span> <em id="site-visit-button"
                                                                                                                        style="padding:4px 5px;width:152px;text-align:center; border-radius:5px">
                        Просмотреть сайт </em></a></h1>

            <div id="wphead-info">
                <div id="user_info">
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="border:1px dotted #666;padding:5px 10px; margin-right:-8px; -moz-border-radius:6px;border-radius:6px"><a
                                href="?_account_=pass_request" title="Профиль">Администратор</a> &nbsp; | &nbsp; <a href="?_account_=logout" title="Выйти">Выйти</a></span>&nbsp;&nbsp;
                    </p>
                </div>
                <!-- <span style="color:#5a5a5a; font-size:26px;padding:20px 0  0 70px;position:relative;top:10px">Адміністрування</span> -->
                <!--
                <div id="favorite-actions">
                    <div id="favorite-first"><a href="?id=0&blog=4" style="padding-left:20px;padding-right:10px;font-size:12px">Новая запись</a></div><div id="favorite-toggle"><br></div> </div>
                </div>-->
            </div>
            <!-- wphead -->

            <div id="wpbody">

                <ul id="adminmenu">


                    <li class="wp-first-item current menu-top menu-top-first menu-top-last" id="menu-dashboard" style="margin:2px 0">
                        <div class="wp-menu-image"><a href="http://www.google.com/analytics/"><br></a></div>
                        <div class="wp-menu-toggle"><br></div>
                        <a href="http://www.google.com/analytics/" class="wp-first-item current menu-top menu-top-first menu-top-last" style="font-size:13px"
                           tabindex="1">Аналитика</a></li>

                    <li style="height:19px"></li>

                    <li class="wp-has-submenu menu-top" id="menu-posts-1">
                        <div class="wp-menu-image"><a href="?subject=menu"><br></a></div>
                        <div class="wp-menu-toggle"><br></div>
                        <a href="?subject=menu" class="open-if-no-js menu-top" tabindex="2">Главное меню</a></li>

                    <br>

                    <li class="wp-has-submenu menu-top" id="menu-posts0">
                        <div class="wp-menu-image"><a href="user.php"><br></a></div>
                        <div class="wp-menu-toggle"><br></div>
                        <a href="user.php" class="open-if-no-js menu-top" tabindex="3">Наполнение</a>

                        <div style="display:none"></div>
                    </li>

                    <!--	<br>

                        <li class="wp-has-submenu menu-top" id="menu-posts-4">
                        <div class="wp-menu-image"><a href="?subject=galery"><br></a></div><div class="wp-menu-toggle"><br></div><a href="?subject=galery" class="open-if-no-js menu-top" tabindex="4">Albums</a></li>-->

                    <!--<DIV STYLE="POSITION:ABSOLUTE;TOP:56PX;LEFT:12PX;FONT-WEIGHT:BOLD;FONT-SIZE:16PX">&bull;</DIV>-->

                    <br>

                    <li class="wp-has-submenu menu-top" id="menu-posts1">
                        <div class="wp-menu-image"><a href="?subject=other"><br></a></div>
                        <div class="wp-menu-toggle"><br></div>
                        <a href="?subject=other" class="open-if-no-js menu-top" tabindex="5">Другое</a></li>

                </ul>


                <div id="wpbody-content">

                    <div id="the_main_bar">

                        <img src="blank.gif" id="one_prev">
		