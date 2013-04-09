<?

	include dirname(__FILE__).'/bmc/main.php';

print_r($bmc_vars);die;
 $x = $db->query("select * FROM `".PRF."photo");
 
 foreach($x as $p){
 	$i = str_replace('photos','photos/',$p['fon']);
 	$j = str_replace('photos','photos/',$p['icon']);
 	$o = $p['id'];
 	$x = $db->query("update  `".PRF."photo`  set icon = '$j', fon = '$i' where id=$o ");
 
 	
 	}

?>