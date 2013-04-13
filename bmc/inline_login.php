<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


if (isempty($_GET['account'])) {

    $c = $_SERVER['REQUEST_URI'];

    if (isempty($_COOKIE['BMC_redirect']) && $c != 'install.php') {
        setcookie("BMC_redirect", $c, 1000000);
        $_COOKIE['BMC_redirect'] = $c;
    }
}


include A_ROOT . "login.php";


?>