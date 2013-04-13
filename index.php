<?php

header("Content-Type: text/html; charset=Windows-1251");

define('A_ROOT', dirname(__FILE__) . '/');


require_once A_ROOT . 'bmc/main.php';

if (IS_ADMIN) {
    include_once A_HOME . "fun_admin.php";
}


//////////////////////////////////////////////////////////////////////


if (isnumeric($_GET['id'])) {

    $POOO = $db->query("SELECT * FROM " . PRF . "posts WHERE id=" . a($_GET['id']), false);

    if ($POOO) {
        define('BLOG', $POOO['blog']);
    }


}
elseif (isnumeric($_GET['blog'])) {

    if ($BLOGS[$_GET['blog']]) {
        define('BLOG', $_GET['blog']);
    }

}
elseif (isnumeric($_GET['page'])) {

    if ($BLOGS[$_GET['page']]) {
        define('BLOG', $_GET['page']);
    }

}
else {

    define('BLOG', min(array_keys($BLOGS)));

}
//else...


if (!defined("BLOG")) {
    error_msg('����� ������� �� ����������'); //bmc_go(-1);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


include A_ROOT . "header3.php";


if (!empty($POOO)) {

    if ($POOO['gallery']) {
        include A_ROOT . 'foto.php';
    }
    else {
        include A_ROOT . 'blog.php';
    }

}
else {

    switch (BLOG) {

        case '1':
            if (!isnumeric($_GET['id'])) { //gluk2
                $_GET['id'] = $db->evaluate("SELECT id FROM " . PRF . "posts WHERE blog=" . BLOG);
                $POOO = $db->query("SELECT * FROM " . PRF . "posts WHERE id=" . a(@$_GET['id']), false);
            }
            if (!$POOO) { /*error*/
            }
            echo '<img src="' . imgsrc($bmc_vars['zastavka']) . '" id="loading" alt="������� ���������">';
            include A_ROOT . "gallery.php";
            break;

        case '4':
            include A_ROOT . "foto.php";
            break;

        case '5':
            if (isset($_GET['go'])) {
                include A_ROOT . "foto.php";
            }
            else {
                include A_ROOT . "photo1.php";
            }
            break;

        case '6':
            include A_ROOT . "guestbook.php";
            break;

        case '7':
            include A_ROOT . "email_send.php";
            break;

        default:
            include A_ROOT . "blog.php";
            break;

    }
}

include A_ROOT . "footer3.php";

?>