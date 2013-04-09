<?php
$dbs[1] = 	$db->query("SELECT icon FROM `".PRF."photo`");
$dbs[2] = 	$db->query("SELECT fon FROM `".PRF."photo`");
$dbs[5] = 	$db->query("SELECT icon FROM `".PRF."posts`");

foreach($dbs[1] as $k => $d){
	if(substr($d, 0, 7) == 'http://')
		unset($dbs[1][$k]);
	$dbs[3][$k] = str_replace('photo/', 'fullsize/', $d);
	$dbs[4][$k] = str_replace('photo/', 'thumb/', $d);
	
}

foreach($dbs[0] as $d){
	if(substr($d, 0, 7) == 'http://')
		unset($dbs[0][$k]);
}
foreach($dbs[5] as $d){
	if(substr($d, 0, 7) == 'http://')
		unset($dbs[5][$k]);
}
$dbs[6] = $bmc_vars;
foreach($dbs[6] as $d){
	if(substr($d, 0, 7) == 'http://')
		unset($dbs[6][$k]);
	if(substr($d, 0, 8) == 'kartiny/')
		unset($dbs[6][$k]);
}

$dbs[0] = array_merge($dbs[1], $dbs[2], $dbs[3], $dbs[4], $dbs[5], $dbs[6])



?>