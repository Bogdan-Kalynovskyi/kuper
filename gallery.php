<?php

	$PHOTO = $db->query("SELECT * FROM `".PRF."photo` WHERE post=".a(@$_GET['id'])." ORDER BY por ASC");//optimize?

	if(!$PHOTO){/*error todo*/}

?>

	<table id="molbert" cellpadding="0" cellspacing="0">
		<tr id="top1">
			<td id="left-top">
			<td id="top">
			<td id="right-top">
		</tr>
		<tr>
			<td id="left">
			<td id="center">



	<div id="wrapper">
		<div id="fullsize">
			<div id="imgprev" class="imgnav"></div>
			<div id="imglink"></div>
			<div id="imgnext" class="imgnav"></div>
			<div id="image"></div>
			<div id="information"><h3></h3><p></p></div>
		</div>
		<div id="thumbnails">
			<div id="slidearea">
				<div id="slider"><?php					
				foreach($PHOTO as $ph){
					$th = basename($ph['icon']);
					echo "<img src=\"thumb/$th\" title=\"{$ph['title']}\">";
				}//�� ����� ������ ��1� �/������� - ����������� onload/ ��� - 
?></div>
			</div>
		</div>
	</div>



									
			<td id="right">
		</tr>
		<tr id="bottom1">
			<td id="left-bottom">
			<td id="bottom">
			<td id="right-bottom">
		</tr>
	</table>

	




<script src=comp.js></script>
<script src=FancyZoom.js></script>


<script>

	_7a = new Array(<?php echo count($PHOTO) ?>);
		
<?php
foreach($PHOTO as $i => $ph){
	$th = tojs('fullsize/'.basename($ph['icon']));
	$ph['summary'] = tojs(htmlspecialchars($ph['summary']));
	$ph['title'] = tojs($ph['title']);
	$ph['icon'] = tojs($ph['icon']);
	$ph['fon'] = tojs($ph['fon']);

	echo <<<EOF
	_7a[$i] = {
		t:'{$ph['title']}',
		d:'{$ph['summary']}',
		u:'{$ph['fon']}',
		p:'{$ph['icon']}',
		l:'$th'
	};
EOF;
}
?>


/////////
	var p0 = new Image();
	var p2 = new Image();

	addLoadEvent(function(){
		var auto = <?php echo (int)(BLOG <= 1) ?>;
		slideshow=new slideshow("slideshow", auto);
	})
/////////	

</script>

