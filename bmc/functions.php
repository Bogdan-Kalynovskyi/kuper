<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
	
function net_location_ary(){
	return  array('ip'=>$_SERVER['REMOTE_ADDR'], 'user_agent'=>md5($_SERVER['HTTP_USER_AGENT']), 'time'=>time());
}
// ====================================================================================================
function bmc_hash($data, $alg=null, $salt=null){
global $USER;

	if(!$alg)$alg = $USER['algo'];
	if(!$salt)$salt = $USER['salt'];
	
	if(function_exists('hash') && function_exists('hash_algos') && in_array($alg, hash_algos())){//and is compatible version of php?
		$x = hash($alg, $salt.$data);
		if($x) return $x;
	}
	return sha1($salt.$data);
}

function random_algo(){
	if(function_exists('hash') && function_exists('hash_algos')){
		$s = hash_algos();
		$s = $s[mt_rand(0, count($s)-1)];
		if($s) return $s; 
	}
	return 'sha1';
}


function set_form(){
global $USER, $db;	
	$x = uuidv4();
	$res = $db->q('INSERT INTO', 'formlog', array_merge(array('user'=>$USER['id'], 'hash'=>$x), net_location_ary()), 0, 0);
	return '<input type="hidden" name="'.SEARCH_HASH.'" value="'.$x.'" />';
}

function get_form(){
global $USER, $db;	
	$x = $_POST[SEARCH_HASH];
	unset($_POST[SEARCH_HASH]);
	return $db->q('DELETE FROM', 'formlog', array_merge(array('user'=>$USER['id'], 'hash'=>$x), net_location_ary()), 0, 0);
}


/*
class Login{
	create db
	login_cookie
	login_post
	logout
	create_new_user
	delete_user
	update_user
	
	level
}
*/


function bmc_Logout() {
global $db, $USER;

		if(isset($_SERVER['HTTP_REFERER'])){
			$_COOKIE['BMC_redirect'] = $_SERVER['HTTP_REFERER'];
			setcookie("BMC_redirect", $_SERVER['HTTP_REFERER'] ,time()+604800);
		}
		//else $_COOKIE['BMC_redirect'] = $_SERVER['HTTP_REFERER'];
		
		setcookie("BMC_sid", "" ,time()-604800);
		setcookie("BMC_remember", "" ,time()-604800);
		//per-page//all cookies
		
		$db->query("DELETE FROM `".PRF."login` WHERE `sid` = ".a(@$_COOKIE['BMC_sid']) );

				unset($_COOKIE['BMC_sid']);
				unset($_COOKIE['BMC_remember']);

		$USER = null;
///then go redirected///
}
	


// ====================================================================================================
function bmc_getLogged() {
global $db;


	if(isset($_COOKIE['BMC_sid']) && strlen($_COOKIE['BMC_sid']) >= 22){

			include_once A_HOME.'ip_fun.php';
			
			$sid =  a($_COOKIE['BMC_sid']); 
			$_ip = a( $ip = ip2long( get_real_ip() ));
			$user_agent = a( sha1($_SERVER['HTTP_USER_AGENT']) );
			$time = time();
			
			
		////////////////////
		
		  
/*				$res = $db->query("
				SELECT u.*, l.`id` as `i` FROM `".PRF."users` u 
					INNER JOIN `".PRF."login` l ON    u.`id` = l.`user` 
				WHERE l.`sid` = $sid  AND l.`ip` = $admin_ip  AND l.`user_agent` = $user_agent
	 				LIMIT 1", false);
*/
				$res = $db->query("
					SELECT `id`, `user`, `time`, `ip` FROM `".PRF."login`  
					WHERE `sid` = $sid  AND ABS(`ip` - $_ip)<256 AND `user_agent` = $user_agent
	 				LIMIT 1", false);//order by time desc
					
// RETURN USERNAME AND WRITE SESSION EXPIRED
				if(!$res) return null;
				
				$result = $db->query("
					SELECT * FROM `".PRF."users`  
					WHERE `id` = {$res['user']}
	 				LIMIT 1", false);

		  		if(!$result) return false;
				
				/*if($result['login'] != trim($_COOKIE['BMC_login']))*/
				if(  ( $time - $res['time']) > LOGIN_TIME_LIMIT
				   || ($res['ip'] != $ip)  ){
				  
					$res = $db->query("
					DELETE FROM `".PRF."login`  
					WHERE id = {$res['id']}");
					return $result['login'];
				  }

		  		
		  		$result['time'] = $res['time'];
		  
		  
				if(($time - $res['time']) > 1060
				|| (isset($_COOKIE['BMC_time']) && ($time-$_COOKIE['BMC_time']>60)) ){
					
					$sid = uuidv4();
					$rem =  noempty($_COOKIE['BMC_remember']) ? $time + LOGIN_TIME_LIMIT : 0;
					setcookie('BMC_remember', $_COOKIE['BMC_remember'], $rem);
					setcookie('BMC_sid', $sid, $rem);
					$sid = a($sid);
	
					$db->query("UPDATE `".PRF."login` SET `time`='$time', `sid`= $sid, `ip`=$_ip 
					WHERE `id`={$res['id']}");
				  	
				}					
					 	  	

				setcookie('BMC_time', $time, 0);
			//	here CHECK ACCESSIBILLITY !!!
				return $result;
		
	}
	// час тривалосты сесыъ встановлюэться тут, він моде бути обмеженим
	//max session time	
	
	return null;
	
}






//perfect php redirector
// ====================
// ====================================================================================================

function bmc_Go($goto = null){//(FEATURE -1)//зберыгати даны пост ы гет ы выдправляти ъх буз ред1ректу. серыелызувати пост////////наша задача щоби коли при в1дправц1 форми вилоговувало, форма пысля успышного логування залишалась 1 в1дправляласяю // GET POST COOKIE REQUEST
global $MY_URL, $CHRST;	


	if((!$goto || $goto=="?nul=0" || $goto=="?reg=1") && noempty($_COOKIE['BMC_redirect'])){
//		 s fuckin shit works only is referer is on. use javascript also!! to set redirector on each page ********//
//********
			setcookie("BMC_redirect",'', time()-100000);
			$goto = $_COOKIE['BMC_redirect'];
			unset($_COOKIE['BMC_redirect']);
			
	}
	
	
	//OR javascript browser go -1
	if($goto == -1){
		if(noempty($_SERVER['HTTP_REFERER']) &&  basename($_SERVER['REQUEST_URI']) != basename($_SERVER['HTTP_REFERER']) && basename($_SERVER['SCRIPT_NAME']) != basename($_SERVER['HTTP_REFERER']))
			$goto = $_SERVER['HTTP_REFERER'];//prevent looping
		else
			$goto='';
	}

if(!$goto)$goto = 'index.php';//history unfinished
	
	$goto=trim(str_replace('Location:', '', $goto));
	$goto=trim(str_replace('Refresh: 0; URL=', '', $goto));

	
	$x = substr($goto, 0, 7); 
	if($x !='http://' && $x !='https:/')
		$goto = $MY_URL.'/'.$goto;


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
	// Fix for IIS servers+cookies
	if(!(stripos( $_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') === false) ) {
		$str="Refresh: 0; URL=$goto";
	} else {
		$str="Location: $goto";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////		


//use other headers if needed//htaccess
@header('HTTP/1.1 301 Moved Permanently');
if(!@header($str)) {
//encoding
$goto=htmlspecialchars($goto);//addslashes?
echo <<<EOF
<HTML><HEAD><meta name=”robots” content=”noindex”><script>
<!--
document.location="$goto";
//-->
</script><meta http-equiv="Content-Type" content="text/html; charset=$CHRST"/><meta http-equiv="Refresh" content="0; $goto"></HEAD>
<BODY><noscript>Redirection<br/><a href="$goto">Follow this link to get proceed</a></noscript> <a href="$goto"> &rarr; </a></BODY></HTML>
EOF;

}

exit();

}//perfect redirector



//////////////////bad
function wasEdited(&$post)
{
	return 
		(isset($post['edited_by']) && ($post['edited_by']!=0) && ($post['edited_by']!=$post['author']));
		
}





// ====================/////////////////////////////////////////////////////////////////////

function bmc_getSets() {
global $db, $bmc_vars, $BLOGS, $FONS, $IDS;
    $res = @mysql_query("SELECT name, val FROM ".PRF."vars", $db->link);
	while ( $row = @mysql_fetch_array($res, MYSQL_ASSOC) ) 
			$bmc_vars[$row['name']]=$row['val'];
			
	$BLOGS = array();	
		
	$u = explode("\n", $bmc_vars['blogs']);
	$i = explode("\n", $bmc_vars['blog_ids']);
	foreach($u as $key=>$val){
		$BLOGS[$i[$key]] = $val;
	}

	$u = explode("\n", $bmc_vars['blog_fons']);
	foreach($u as $key=>$val){
		$FONS[$i[$key]] = $val;
	}
	
	$IDS = $i;
/*
	$u = explode("\n", $bmc_vars['blog_types']);
	foreach($u as $key=>$val){
		$TYPES[$i[$key]] = $val;
	}
*/
}





// ====================
// Date conversion from Timestamp [total seconds] to readable one (3.1)
// with TimeZone conversion


function bmc_Time($str){

	if(!$str)return;
	
	$x=explode('/',$str);
	$y=$x[0];
	$x[0] = $x[1];
	$x[1] = $y;
	$z=implode('/',$x);
	
	return strtotime($z);
}


function bmc_Date($time_stamp=0, $format=false, $alpha = false) {
global $lang,$bmc_vars;

	if(!$time_stamp) $time_stamp=time();
	if(!$format) $format=$bmc_vars['date_str'];


		reset($lang['date']);//bodya optimize;
		$translate_date=null;

		// Scan the Date/Time language array and put the strings into a new array
		$alpha = ($alpha)? $lang['d1'] : $lang['date'];
		while (list($str_original, $str_replace) = each($alpha))
			$translate_date[$str_original] = $str_replace;
			

	if(!empty($translate_date)) {
		// Do the translation and return the time
		return strtr(gmdate($format, $time_stamp + (3600 * $bmc_vars['gmt_diff'])), $translate_date);
	} else {
		return gmdate($format, $time_stamp + (3600 * $bmc_vars['gmt_diff']));
	}
}

// =================== ISO8601 date (xml feeds) ==========
function bmc_iso8601_date($time_stamp) {
	$tzd = bmc_date($time_stamp,'O');
	$tzd = substr(chunk_split($tzd, 3, ':'),0,6);
	return bmc_date($time_stamp,'Y-m-d\TH:i:s') . $tzd;
}






function stripslashes_deep($value){
	if(is_array($value))
		return  array_map('stripslashes_deep', $value);
	else
		return  stripslashes($value);
}


function a($value){
        return "'" . mysql_real_escape_string($value) . "'";// ?  о пользе кавычек в цифрах мускула
}






// ======================= A modded htmlentities() function ==============
// used to process Chinese and other such special characters
function strip_all($str){
	global $CHRST;
	return htmlspecialchars( strip_tags($str), ENT_QUOTES, $CHRST);
}


	




















//link type, array tipe, file type
function isnumeric(&$str)
{
	if (!isset($str) || is_array($str))return false;// || what??
  	$str = trim((string)$str);
	return ctype_digit($str);//preg_match("/^(\d|[1-9]\d*)$/",$str);
}
function isalphanumeric(&$str)
{
	if (!isset($str) || is_array($str))return false;
  	$str = trim((string)$str);//whatelse?
	return preg_match("/[^(\w)|(\s)]/",$str);
}
function isempty(&$str)
{
	if (!isset($str) || is_array($str))return TRUE;
  	$str = trim($str);
	return ($str==='');
}
function noempty(&$str)
{
	if (!isset($str) || is_array($str))return false;
  	$str = trim($str);
	return ($str!=='');
}
function isemail(&$str)
{
	if (!isset($str) || is_array($str))return false;
  	$str = strtolower(trim($str));
	return preg_match("/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9_\-]*\.)+[a-z]{2,4}$/i", $str);
}
function imgsrc(&$src){
	if(!($src = trim($src)))
		return 'blank.gif';
	else 
		return $src;
}





function my_strip($a, $c){
	if(strpos($c, $a) !== 0)
		return $c;
	return trim(substr($c, strlen($a) ));
}




// ======================= Send out mails ======================== (3.1)
function bmc_Mail($to, $subject="", $message="", $from="") {
global $bmc_vars, $MY_URL, $CHRST;

	if(empty($from)) {
		$from=$bmc_vars['email'];
	}

		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=$CHRST\r\n";
		$headers .= "From: \"$MY_URL\" <{$from}>\r\n";
		$headers .= "Reply-To: <{$from}>\r\n";
		$headers .= "Return-Path: {$from}\r\n";
        $headers .= "X-Priority: 1 (Higuest)\n";
        $headers .= "X-MSMail-Priority: High\n";
        $headers .= "Importance: High\n";
		
	return mail(trim($to), $subject, $message, $headers);
}


	
	 


function str_replace_once($search, $replace, $subject) {
    $firstChar = strpos($subject, $search);
    if($firstChar !== false) {
        $beforeStr = substr($subject,0,$firstChar);
        $afterStr = substr($subject, $firstChar + strlen($search));
        return $beforeStr.$replace.$afterStr;
    } else {
        return $subject;
    }
}


 function tojs($str){
   return  str_replace("\n",'\n',(str_replace("\r",'\r', addslashes($str))));
 }

 function fromjs($str){
   return stripslashes(str_replace('\n',"\n",(str_replace('\r',"\r", $str ))));
 }
 
 function myurlencode($str){
	$str = rawurlencode($str);
	//&? ;
	$str = str_replace('%2F', '/', $str);
	return str_replace('%3A', ':', $str);
 }
 
 function mbsubstr($s){
 	if(strlen($s) < 200)return $s;
 	
 	if(function_exists('mb_substr'))
	 	$r= mb_substr($s, 0, 200);
	else
		$r= substr($s, 0, 200);
										//caret returns count <5!!!!!	
	if(strlen($r) != strlen($s))
		$r.='...';
	return $r;
 }
 
function sukaseek($u, $mixed){
	foreach($mixed as $m){
		if($m['id'] == $u['id']) return true;
	}
	return false;
} 





function  simplewrap($str, $cut="- ", $cols=20) {
	return $str;
	$len = strlen($str);
	
if($len <= $cols)return $str;

	$wordlen=0;
	$result=null;

	for ($i = 0; $i < $len; $i++) {
		$chr = $str[$i];
		if($chr==' ' || $chr=="\n" || $chr=="\r")
			$wordlen = 0;
		$wordlen++;

		$result .= $chr;
		if ($wordlen > $cols){ 
			$result .= $cut;
			$wordlen = 0;
		}
	}
	return $result;
}


function number_ending($number, $ending0, $ending1, $ending2) {
	$num100 = $number % 100;
	$num10 = $number % 10;
	if ($num100 >= 5 && $num100 <= 20) {
		return $ending0;
	} else if ($num10 == 0) {
		return $ending0;
	} else if ($num10 == 1) {
		return $ending1;
	} else if ($num10 >= 2 && $num10 <= 4) {
		return $ending2;
	} else if ($num10 >= 5 && $num10 <= 9) {
		return $ending0;
	} else {
		return $ending2;
	}
}

?>