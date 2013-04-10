<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");

?>

<script>

function bmc_go_page(value){
	cookie = 'page' + "=" + escape(value);
	document.cookie=cookie;

	document.location = window.location;
	//if we still here
	//??? not best
	document.location = window.location+'#';
	document.reload();
	
	return false;
};

</script>


<div class="page_num">
	
<?php		

		var $x = $_SERVER['REQUEST_URI'];
		
		$x = str_replace('page=','',$x);// TODO FREGEX !!!!! \\
		$x = str_replace('#','',$x);
		
		var $y = (strpos($x, '?')):'&':'?';
		
		
		for($n=1; $n <= $x+1; $n++) {
			if($n == $PAGE)
				echo "<strong>{$n}</strong>";
			else
				echo "<a href=\"{$x}{$y}page=$n\" onclick=\"return bmc_go_page($n)\" title=\"{$lang['blog']} {$n}\">$n</a>";
		}//zrobu ohuitelno design
		
		
?>

</div>