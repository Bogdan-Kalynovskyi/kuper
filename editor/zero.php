<?php //auto margin -> center!
	if(!defined('IN_BMC')) 
		die("Access Denied!");
	if(!defined('IS_ADMIN')) 
		die("Access Denied!");
	
?>


<style>

.baba{
	display:inline-block;padding-right:36px;padding-left:4px;
	-moz-border-radius:5px;
	border-radius:5px;
}
.baba:hover{
	background:#f0f0f0;
}
.baba:hover a{
	color:#f00;
}

._eye_ img{
	top:3px !important;
	padding-left:10px;
}

#pink_floyd{
	background:#fdf;font-weight:bold
}

</style>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



<?php

foreach($BLOGS as $key => $b){
 	
 	if($key == 6){
		echo 	"<br/><a href=\"./?page=$key\"><big><b>$b</b></big></a><br/><br/>";
		continue;
 	}
 	
 	if($key == 7){
		echo 	"<br/><a href=\"?subject=other\"><big><b>$b</b></big></a><br/><br/>";
		continue;		
 	}
 	
	echo "<big style=\"display:inline-block;padding:6px 0;line-height:1.7em\"><a style=\"color:black;text-decoration:none;font-weight:bold\" href=\"./?blog=$key\" title=\"Ê ñòðàíèöå\">$b</a></big><br/>\n";

	$r = $db->query("SELECT * FROM `".PRF."posts` WHERE blog=$key ORDER BY por ASC");

//////////////////////////////////////
	foreach($r as $i){
		
		$floyd = ((isset($_POST['id']) && $_POST['id']==$i['id']) || (isset($_POST['gallery'])&&$_POST['gallery']==$i['id']))?' id="pink_floyd" onload="this.focus()"':'';

		if(strlen($i['title'])>52) 
			$i['title']=substr($i['title'],0,50).'&#133;';

		$gala = ($i['gallery'])?
			"<a href=\"?gallery={$i['id']}\" class=\"_eye_\" title=\"ê ãàëåðåå\"><img src=\"img/gallery.gif\" alt=\"&rarr;\"></a>&nbsp;"	
			:'<span style="display:inline-block;width:30px"></span>';

		echo "
		<div class=\"baba\"$floyd>
		
			 &nbsp; &nbsp; <a href=\"./?id={$i['id']}\" class=\"_eye_\" title=\"ïðîñìîòðåòü\"><img src=\"img/eye_small.gif\" alt=\"View\"></a>
		
			 $gala
			 
			<a href=\"?id={$i['id']}\" class=\"list_a\" ".
				(($i['draft'])?'style="opacity:0.3" title="ýòî ÷åðíîâèê!"':'title="ðåäàêòèðîâàòü"').">".
		
			(($i['title'])?$i['title']:'( áåç çàãîëîâêà )')."</a>

				 <a href=\"?up={$i['id']}\" title=\"ââåðõ\"><img src=\"img/up.png\" alt=\"ââåðõ\"></a> 
				 <a href=\"?down={$i['id']}\" title=\"âíèç\"><img src=\"img/down.png\" alt=\"âíèç\"></a>
				 <a href=\"?del={$i['id']}\" title=\"ñòåðåòü\" onclick=\"if( confirm('  !!! Âíèìàíèå !!! \\n\\n Óíè÷òîæèòü ýòó ñòàòòþ?\\n\\n  &ldquo;".(($i['title'])?tojs($i['title']):'(ïóñòàÿ)')."&rdquo;')) document.location='?del={$i['id']}'; return false\"><img src=\"img/del.png\" alt=\"ñòåðåòü\"></a>
		</div>
	";
	}
	
	if($key != 1)
		admin_new('+1', $key);
	echo "<br/>\n";
}

 
?>

<script>
try{$('pink_floyd').focus()}catch(e){}//todo âèïàäàéêà//scroll to
</script>