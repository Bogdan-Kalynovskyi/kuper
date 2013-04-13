<?php header("Content-Type: text/html; charset=windows-1251");


require_once dirname(__FILE__) . '/bmc/main.php';
$x = $db->query("INSERT INTO 1posts (title) values('')");
$x = $db->evaluate("SELECT LAST_INSERT_ID() ");
$x = $db->query("DELETE FROM 1posts WHERE id=$x");

print_r($x);

?>