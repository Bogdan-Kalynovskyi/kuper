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
    global $lang, $bmc_vars;
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


?>
