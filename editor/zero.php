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
 	
	echo "<big style=\"display:inline-block;padding:6px 0;line-height:1.7em\"><a style=\"color:black;text-decoration:none;font-weight:bold\" href=\"./?blog=$key\" title=\"� ��������\">$b</a></big><br/>\n";

	$r = $db->query("SELECT * FROM `".PRF."posts` WHERE blog=$key ORDER BY por ASC");

//////////////////////////////////////
	foreach($r as $i){
		
		$floyd = ((isset($_POST['id']) && $_POST['id']==$i['id']) || (isset($_POST['gallery'])&&$_POST['gallery']==$i['id']))?' id="pink_floyd" onload="this.focus()"':'';

		if(strlen($i['title'])>52) 
			$i['title']=substr($i['title'],0,50).'&#133;';

		$gala = ($i['gallery'])?
			"<a href=\"?gallery={$i['id']}\" class=\"_eye_\" title=\"� �������\"><img src=\"img/gallery.gif\" alt=\"&rarr;\" /></a>&nbsp;"	
			:'<span style="display:inline-block;width:30px"></span>';

		echo "
		<div class=\"baba\"$floyd>
		
			 &nbsp; &nbsp; <a href=\"./?id={$i['id']}\" class=\"_eye_\" title=\"�����������\"><img src=\"img/eye_small.gif\" alt=\"&bull;\" /></a>
		
			 $gala
			 
			<a href=\"?id={$i['id']}\" class=\"list_a\" ".
				(($i['draft'])?'style="opacity:0.3" title="��� ��������!"':'title="�������������"').">".
		
			(($i['title'])?$i['title']:'( ��� ��������� )')."</a>

				 <a href=\"?up={$i['id']}\" title=\"�����\"><img src=\"img/up.png\" alt=\"�����\" /></a> 
				 <a href=\"?down={$i['id']}\" title=\"����\"><img src=\"img/down.png\" alt=\"����\" /></a>
				 <a href=\"?del={$i['id']}\" title=\"�������\" onclick=\"if( confirm('  !!! �������� !!! \\n\\n ���������� ��� ������?\\n\\n  &ldquo;".(($i['title'])?tojs($i['title']):'(������)')."&rdquo;')) document.location='?del={$i['id']}'; return false\"><img src=\"img/del.png\" alt=\"�������\" /></a>
		</div>
	";
	}
	
	if($key != 1)
		admin_new('+1', $key);
	echo "<br/>\n";
}

 
?>

<script>
try{$('pink_floyd').focus()}catch(e){}//todo ���������//scroll to
</script>