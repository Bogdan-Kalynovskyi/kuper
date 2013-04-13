<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


$unr = $db->evaluate("SELECT count(*) FROM " . PRF . "mail
							WHERE user='{$USER['id']}' AND NOT (read LIKE '% {$USER['id']}%')");

$tmp = '<b>' . (int) $unr . '</b> <img src="img/e1.png">';

?>



<div class="logout">
    <a href="./?account=logout">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="inbox.php"><big>Inbox <?php echo $tmp; ?></big></a>
</div>
