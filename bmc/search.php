<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
//shorter than four characters are omittted


$srch_msg='';
if(strlen($_REQUEST['key']) > 3) {


	
	
	
//	$key = html_entity_decode($key, ENT_QUOTES, $lang['ENCODING']);//? nahuya?
	$key = strtolower(trim(substr($_REQUEST['key'],0,75)));	
	$key = a(trim(
		preg_replace("/\s+/", ' ',
		preg_replace("/\s(\S{1,3})\s/", ' ',
		str_replace(' ','  ',
		preg_replace("/\p{P}(?<!')/",' ', 
		str_replace('&nbsp;',' ',
		str_replace("\t",' ',
				$key
				)
			)))))));
					
//	$key = strtr($key, ',/\*&()$%^@~`?;', '               ');
//	$key = str_replace('#180', '', $key);

	
    //           ereg_replace(" +", "  "," $key "));
   



	$item="(MATCH (`search`) AGAINST ($key) + 2*MATCH (`title`) AGAINST ($key))";
	if(noempty($_REQUEST['item'])){
		switch($_REQUEST['item']){	
			case 'title':		
				$item="MATCH (`title`) AGAINST ($key)";
				break;
			case 'content':		
				$item="MATCH (`search`) AGAINST ($key)";
				break;
			//case author///		
		}
	}
	



//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	include_once A_HOME."query.php";
	$limit = '';
	$query_str = '';

	$q = get_query($query_str, $limit, false, $srch_msg, false, true);
	if($q) $q = " AND $q";

	
	$qq = "SELECT id,title,summary,author,date,blog, cat,icon,x,y,data, $item AS rel  FROM ".MY_PRF."posts WHERE $item $q";

//	echo $qq;


	$posts=$db->query($qq);
//print_r($posts);
//die($qq);

	if(!IS_ADMIN)
	$db->query("INSERT INTO ".MY_PRF."stat (time, search, ip) VALUES 
					('".time()."', ".a($key).", INET_ATON('{$_SERVER['REMOTE_ADDR']}')) ");















}
else $srch_msg = $lang['search_key'];// <4

	$key = htmlspecialchars($key);
	if($posts){
		$srch_msg .= str_replace("%key%",$key,$lang['search_reslut_msg']).'<br/>'.count($posts); 
	}else{
			$srch_msg .= "<div class=\"bold_red\">{$lang['search_resut_no']}  $key</div>";
		}



//		include A_THEME."/search_form.php"; 
?>
