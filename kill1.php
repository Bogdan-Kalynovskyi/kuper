s<?
include dirname(__FILE__) . '/bmc/main.php';

header('');
$new_name = 'óôàôûâàôûâsdasdf.asdf';
var_dump(!ereg('^[^./][^/]*$', $new_name) || strpos($new_name, '..') !== false);
include dirname(__FILE__) . '/header.php';
?>