<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
	
		
		$POOO = $db->query("SELECT * FROM `".PRF."posts` WHERE id=".a(@$_GET['id']), false);

		if(!$POOO)							die ('ýòîé çàïèñè óæå íå ñóùåñòâóåò');
		if(!isset($BLOGS[$POOO['blog']]))	die( 'ýòîãî ðàçäåëà óæå íå ñóùåñòâóåò');

//..ïåðåâ1ðêà ö1ë1ñíîñò1 öå ãóò
?>





<style>
.tooltip {color:#81c5ff !important; padding:0 10px; cursor:pointer; font-size:9px}
#tt {position:absolute; display:block;}
#tttop {display:block; height:5px; margin-left:5px;overflow:hidden}
#ttcont {display:block; padding:2px 12px 3px 7px; margin-left:5px; background:#666; color:#FFF}
#ttbot {display:block; height:5px; margin-left:5px; overflow:hidden}
form{
		padding:15px;
}


	fieldset{
		position:relative;
	}
	label, .jobaniradio{
		font-size:110%;
		display:block;
		height:41px;
		position:relative;
	}
	.jobaniradio label{
		display:inline;
		height:auto;
		position:static;
		font-size:100%;
	}
	input, select, textarea, #_icon, #_fon{
		position:absolute;
		left:160px;
		width:506px;
	}
	#_icon,#_fon{
		width:36px;
		height:26px;
	}
	#icon,#fon{
		left:229px;
		width:131px;
	}
	#__icon,#__fon{
		left:413px;width:auto;
	}
	#_1_icon,#_2_icon,#_3_icon,
	#_1_fon ,#_2_fon ,#_3_fon {
		top:2px;
		font-size:13px;
		position:absolute;
	}
	#_1_icon,#_1_fon{
		left:211px;
	}
	#_2_icon,#_2_fon{
		left:377px;
	}
	#_3_icon,#_3_fon{
		left:621px;
	}

	input[type=submit], input[type=button], input[type=radio]{
		position:static;
		width:auto;
		padding-bottom:4px;
		padding-top:4px;
	}
	input[type=button]{
		width:114px;
		margin-left:94px;
	}
	input[type=submit]{
		margin-left:-2px;
		background-color:#d0d0d0;
		width:159px;
	}
	input[type=submit]:hover{
		background-color:#dfdfdf;
		border-color:#c3c3c3;
		color:#000
	}
	input[type=button]:hover{
		border-color:#c3c3c3;
	}
	input[type=checkbox]{
		width:auto;
	}

	
	
	#clickable{
		/*color:#21759B;*/
		position:relative;
		left:403px;
		font-size:13px;
	}
	#gallery_button{
		/*left:506px;top:-5px;display:block;position:absolute;z-index:10;*/
		letter-spacing:3px;color:#333
	}
	
</style>




<h2> Ïðàâèì çàïèñü â ðàçäåëå <a href="./?page=<?php echo $POOO['blog'] ?>"><b>"<?php echo @$BLOGS[$POOO['blog']] ?>"</b></a> </h2>


<form method="post" action="user.php"  accept-charset="<?php echo $CHRST ?>"  enctype="multipart/form-data">
<fieldset>
	<input type="hidden" name="id" value="<?php echo @$_GET['id']; ?>">
	<input type="hidden" name="por" value="<?php echo $POOO['por'] ?>">
	<input type="hidden" name="<?php echo FORM_HASH; ?>" value="1">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
	<input type="hidden" name="blog" value="<?php echo $POOO['blog'] ?>">



<?php if($POOO['blog']==1 || $POOO['blog']==4 || $POOO['blog']==5){?>

	<label><!-- Ýòî ãàëåðåÿ<span class="tooltip" title="Ñ ïîìîùüþ îäíîé è òîé æå ôîðìû ðåäàêòèðóåòñÿ êàê áëîã, òàê è ãàëåðåÿ. Â ñëó÷àå ñ ãàëåðååé ñþäà ïèøåòñÿ åå íàçâàíèå è îïèñàíèå">(?)</span>
		<input type="checkbox" name="gallery"<?php if(@$POOO['gallery']) echo ' checked="checked"'; ?> style="margin-top:5px" onchange="changer()" value="1">--><input type="hidden" name="gallery" value="1">
		<input type="submit" name="nesegalavodu" value="Àëüáîì"  id="gallery_button"> &nbsp; &nbsp; <span class="tooltip" title="Ñïèñîê êàðòèí, ôîòîãðàôèé è îïèñàíèé ê íèì íàõîäèòñÿ çà ýòîé êíîïêîé">(?)</span>
		
		&nbsp; <small style="color:#AAA">Ýòîò ïîñò ñîäåðæèò âíóòðè àëüáîì<?php if($tonia = $db->evaluate("SELECT count(*) FROM `".PRF."photo` WHERE post=".a($POOO['id']))) echo ". $tonia èçîáðàæåíèé"; else echo ". Àëüáîì ïóñò" ?></small>
		
	</label><br/>
<?php }  ?>
 

<?php if($POOO['blog']==1){?>
	<br/>
	<label>Çàñòàâêà<span class="tooltip" title="Ýòà êàðòèíêà ïîÿâëÿåòñÿ, ÷òîá ïîñåòèòåëþ áûëî íà ÷òî ïîñìîòðåòü, ïîêà íå çàãðóçèòñÿ ìîëüáåðò">(?)</span>
		<img src="<?php echo @$bmc_vars['zastavka']?$bmc_vars['zastavka']:'blank.gif'; ?>" alt="íåò" id="_icon"> &nbsp;&nbsp;&nbsp; 

		<span id="_1_icon">url</span><input type="text" id="icon" name="icon" value="<?php echo htmlspecialchars(rawurldecode($bmc_vars['zastavka'])) ?>"> &nbsp; &nbsp; &nbsp;

		<span id="_2_icon">ôàéë</span><input type="file" name="icon" id="__icon"> &nbsp;
		
		<a href="#" title="âîîáùå áåç çàñòàâêè" id="_3_icon" onclick="clrnpt('icon');return false">óáðàòü</a>
	</label>
<?php }else{ ?>


<?php if($POOO['blog']==5){ ?>
	<div class="jobaniradio">Ðàçäåë:<span class="tooltip" title="Ôîòîãðàôèè ó íàñ äåëÿòñÿ íà äâà ãëîáàëüíûõ ðàçäåëà">(?)</span>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label><input type="radio" name="switch" value="0" <?php if(!$POOO['switch'])echo 'checked="checked"'?>> Ôîòîãðàôèè ñ âûñòàâîê</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="radio" name="switch" value="1" <?php if(@$POOO['switch'])echo 'checked="checked"'?>> Ðàçíîå</label>
	</div>
<?php 
	echo '<script>document.getElementsByName("switch")['.((@$POOO['switch'])?'1':'0').'].checked=true</script>';
 } ?>

	<label>Çàãîëîâîê<span class="tooltip" title="Ýòî íàçâàíèå ðåïðîäóêöèè èëè ôîòîãðàôèè èëè çàãîëîâîê ïîñòà">(?)</span>
		<input type="text" name="title" value="<?php echo @$POOO['title']; ?>">
	</label>


	<label>Èêîíêà<span class="tooltip" title="Ýòî èêîíêà àëüáîìà èëè èêîíêà â ïîñòå (â äàíííûé ìîìåíò ÿ îòêëþ÷èë  èêîíêè â ïîñòå)">(?)</span>
		<img src="<?php echo @$POOO['icon']?$POOO['icon']:'blank.gif'; ?>" alt="íåò" id="_icon"> &nbsp;&nbsp;&nbsp; 

		<span id="_1_icon">url</span><input type="text" id="icon" name="icon" value="<?php echo htmlspecialchars(rawurldecode(@$POOO['icon'])); ?>"> &nbsp; &nbsp; &nbsp;

		<span id="_2_icon">ôàéë</span><input type="file" name="icon" id="__icon"> &nbsp;
		
		<a href="#" title="óáðàòü èçîáðàæåíèå èç ïîñòà" id="_3_icon" onclick="clrnpt('icon');return false">óáðàòü</a>
	</label>

	<label id="second" style="display:none">Ôîí<span class="tooltip" title="Ôîí êîòîðûé èñïîëüçóåòñÿ â àëüáîìå ïî óìîë÷àíèþ, êîãäà äëÿ êàðòèíû íå îïðåäåëåíà ôîíîâàÿ ôîòîãðàôèÿ. Äðóãîãî íàçíà÷åíèÿ ïîêà íåòó">(?)</span>
		<img src="<?php echo @$POOO['fon']?$POOO['fon']:'blank.gif'; ?>" alt="íåò" id="_fon"> &nbsp;&nbsp;&nbsp; 

		<span id="_1_fon">url</span><input type="text" id="fon" name="fon" value="<?php echo htmlspecialchars(rawurldecode(@$POOO['fon'])); ?>"> &nbsp; &nbsp; &nbsp;

		<span id="_2_fon">ôàéë</span><input type="file" name="fon" id="__fon"> &nbsp;
		
		<a href="#" title="óáðàòü èçîáðàæåíèå èç ïîñòà" id="_3_fon" onclick="clrnpt('fon');return false">óáðàòü</a>
	</label>
	

	<label style="height:101px">Òåêñò (HTML)<span class="tooltip" title="Ýòî ïîäïèñü ê àëüáîìó(íåîáÿçàòåëüíî), ëèáî òåëî ïîñòà">(?)</span><a href="#" id="clickable" onclick="editoronoff();return false">Âêëþ÷èòü ðåäàêòîð</a><br/>
		<textarea name="summary" cols="80" rows="3" id="msg"><?php echo htmlspecialchars(@$POOO['summary']); ?></textarea>
	</label>
	
	
	<label style="height:17px;overflow:hidden;cursor:pointer" id="dabo">Ïîä êàòîì<span class="tooltip" title="Â ðàçäåëå 'Âûñòàâêè' è 'Î ñåáå' ìîæíî îñòàâèòü ÷àñòü òåêñòà ïîä êàòîì. Áóäåò ïîÿâëÿòÿ íàäïèñü `Äàëüøå áîëüøå`, ïðè íàæàòèè íà êîòîðóþ áóäåò ïîÿâëÿòñÿ ðàñøèðåííàÿ ÷àñòü ñòàòüè">(?)</span><br/>
		<textarea name="data" id="msg1" cols="80" rows="3"><?php echo htmlspecialchars(@$POOO['data']); ?></textarea>
	</label>

<?php } ?>
<!--	<label style="opacity:0.7">Ñïðÿòàòü â ÷åðíîâèê<br/>
		<input type="checkbox" name="draft"<?php if(@$POOO['draft']) echo ' checked="checked"'; ?> value="1">
	</label>-->

	<br/><br/>
	<input type="submit" value="    Ñîõðàíèòü    "> 
	<input type="submit" name="preview" value="Ïðåäâàðèòåëüíûé ïðîñìîòð" style="width:auto;margin-left:93px;background:#e0e0e0"> 
	<input type="button" value="      Îòìåíà      " onclick="document.location='user.php'">

		
</fieldset>
</form>



<script src="js/tooltip.js"></script>
<script src="scripts/wysiwyg.js"></script>
<script>

	lightbox();
	
	inject();
	
	changer();
	
	function editoronoff(){
		WYSIWYG.onoff('msg', full1);
		$('clickable').parentNode.style.height = '300px';
		$('clickable').style.visibility = 'hidden';	
    }

	function dalshebolshe(){t=$('dabo');
		if(parseInt(t.style.height) < 100){
			t.style.height='301px';
			t.style.overflow='';
			t.style.cursor='default';
			WYSIWYG.onoff('msg1', full1);
			t.onclick = null;
		}
		return false
	}

<?php if($POOO['blog'] != 1){ ?>

	function changer(){
		if(document.getElementsByName('gallery')[0]/*.checked*/){
			$('dabo').style.display = 'none';
			$('second').style.display = 'block';
		}else{
			$('dabo').style.display = 'block';
			$('second').style.display = 'none';
		}
	}
	$('dabo').onclick = dalshebolshe;

<?php } ?>
	
	
	
</script>