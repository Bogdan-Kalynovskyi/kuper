<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}
if (!defined('IN_ADMIN')) {
    die('Access Denied!');
}


function admin_box ($post) {
    global $lang;

    echo <<<EOF

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

( <a href="user.php?id={$post['id']}" title="Редагувати цю статтю">
	 {$lang['edit']}
</a> )

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

( <a href="user.php?delete={$post['id']}" title="Знищити цю статтю" onclick="return confirm('!!! Увага !!! \n\n Знищити цю статтю?')">
	{$lang['del']}
</a> )

EOF;
}


function admin_new ($msg = 'Написати нову публiкацiю в цьому роздiлi') {
    global $lang;

    echo <<<EOF

<br><br>
( <a href="user.php?id=0&amp;blog={$_GET['blog']}">
	$msg
</a> )

EOF;
}


?>
