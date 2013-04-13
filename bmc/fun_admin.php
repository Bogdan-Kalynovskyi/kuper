<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


function admin_box ($id) {
    global $lang, $bmc_vars;
    if (!(basename($_SERVER['SCRIPT_NAME']) == 'user.php') && !@$bmc_vars['inline']) {
        return;
    }

    echo <<<EOF

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

( <a href="user.php?id={$id}" title="Админ">
	 <small>{$lang['edit']}</small>
</a> )

&nbsp;&nbsp;&nbsp;

( <a href="user.php?del={$id}" title="Админ" onclick="return confirm('  Удалить  ?')">
	<small>{$lang['del']}</small>
</a> )

EOF;
}


function admin_new ($msg, $blog = null) {
    global $bmc_vars;
    if (!(basename($_SERVER['SCRIPT_NAME']) == 'user.php') && !@$bmc_vars['inline']) {
        return;
    }

    if ($blog === null && defined('BLOG')) {
        $blog = BLOG;
    }
    if (!$blog) {
        return;
    }
    if (!$msg) {
        $msg = 'Добавить новую';
    } //+ 1;

    echo <<<EOF

<div style="height:3px"></div>&nbsp;&nbsp;&nbsp; ( <a href="user.php?id=0&amp;blog=$blog" title="Админ">$msg</a> )<br>

EOF;
}


function bulk ($c) {
    $my = array();

    if (is_array($_POST[$c])) {
        foreach ($_POST[$c] as $key => $p) {
            if (isnumeric($key) /*range?*/) {
                $my[$key] = simplewrap(htmlspecialchars(htmlspecialchars_decode($p)));
            }
        }
    }
    return $my;
}


function photobulk ($c, $do_thumbs = false) {
    global $bmc_vars, $bodya_x, $bodya_y;

    $my = $bodya_x = $bodya_y = array();

    include_once A_HOME . 'upload_pic.php';

    if (is_array($_POST[$c])) {
        foreach ($_POST[$c] as $key => $p) {
            if (isnumeric($key)) {

                $xxx = $bmc_vars['x'];
                $yyy = $bmc_vars['y'];

                $_POST[$c . $key] = $p;

                if ($do_thumbs) {
                    $my[$key] = myurlencode(up_pic($c . $key, '', '', 'fullsize/', 1200, 800, true)); //uuidv4()

                }
                else {
                    $my[$key] = myurlencode(up_pic($c . $key, '', '', 'photos/', $xxx, $yyy)); //uuidv4()
                    $bodya_x[$key] = $xxx;
                    $bodya_y[$key] = $yyy;
                }
            }
            /*
            $my[$key] = myurlencode(up_pic($c.$key, '', '', 'photos/', $bmc_vars['x'], $bmc_vars['y']));//uuidv4()

            if($do_thumbs && $my[$key]){
                unset($_FILES[$c.$key]);
                $_POST[$c.$key] = rawurldecode($my[$key]);
                $newname = basename($_POST[$c.$key]);

                if(!is_file(A_ROOT.'thumb/'.$newname)){
                    $newname = substr($newname, 0, strrpos($newname, '.'));
                    up_pic($c.$key, '', $newname, 'thumb/', $bmc_vars['thumb_x'], $bmc_vars['thumb_y']);
                }
            }*/


        }
    }
    return $my;
}
?>
