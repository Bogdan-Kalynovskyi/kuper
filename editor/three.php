<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");

?>


<h2> Ïðàâèì ìåíþ... </h2>


<form method="post" action="user.php" accept-charset="<?php echo $CHRST ?>" enctype="multipart/form-data">
<fieldset>
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
	<input type="hidden" name="<?php echo FORM_HASH; ?>" value="3">
<br/>
<div id="__key">
<?php
$k = 0;

foreach($BLOGS as $key=>$val){

		$f = htmlspecialchars(rawurldecode($FONS[$key]));

		if(!trim($FONS[$key]))$FONS[$key]='blank.gif';
	
		echo <<<EOF
		<div class="baba" id="_$k">
		
			<a href="index.php?page=$key" target=_blank class=_eye_ title="ïðîñìîòðåòü"><img src="img/eye_small.gif" alt="View"></a> &nbsp;
			
			<input type="text" name="v[$key]" value="$val" id="v$k" style="width:301px"> &nbsp;&nbsp;
			
				 <a href="#" title="ââåðõ" onclick="up($k); return false"><img src="img/up.png" alt="ââåðõ"></a> 
				 <a href="#" title="âíèç" onclick="down($k); return false"><img src="img/down.png" alt="âíèç"></a>
				 <a href="#" title="ñòåðåòü" onclick="del($k); return false"><img src="img/del.png" alt="ñòåðåòü"></a>
			
				<p><img src="{$FONS[$key]}" alt="ôîí" id="_f$k"> &nbsp;
					<a href="#" onclick="cl($k);return false">...</a>
					<b id="x$k">
					URL<input type="text" name="f[$key]" id="f$k" value="{$f}"> èëè ôàéë<input type="file" id="__f$k" name="f$key">&nbsp; <a onclick="clrnpt('f$k');return false">Óáðàòü</a>
					</b>
				</p>			
				
		</div>

EOF;
$k++;
}

?>
</div>
<br/>
	<img src="images/plus.gif" title="äîáàâèòü" alt="äîáàâèòü" onclick="add()" style="margin-top:-10px;margin-left:40px; cursor:pointer"> &nbsp; Â ñâÿçè ñ ãëþêàìè áðàóçåðîâ ðåêîìåíäóåòñÿ ñíà÷àëà ÇÀÃÐÓÇÈÒÜ êàðòèíêè, à çàòåì ÏÅÐÅÌÅÙÀÒÜ èõ ââåðõ-âíèç
	<br/>
	<br/>
	
	<input type="submit" value="      Ñîõðàíèòü      " style="margin-left:30px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<input type="button" value="      Îòìåíà      " onclick="document.location='user.php'">

</fieldset>
</form>


<script>

		var n = <?php echo (string)(int)$k ?>;
		var nn = <?php echo (string)(int)max(array_keys($BLOGS)) ?>;
	
		lightbox();

		inject();
				
		function up(i){
			var a=i;
			do{
				 a = (a>0)?a-1:n-1;
			}while(isNull('_'+a));

			swap('v', i, a);
			swat('f', i, a);

		}
		
		function down(i){
			var a=i;
			do{
				 a = (a<n-1)?a+1:0;
			}while(isNull('_'+a));
				
			swap('v', i, a);
			swat('f', i, a);
			
		}
		
		function del(i){
		//todo test ie	
			if(confirm('       !!! Âíèìàíèå !!! \n\n Óíè÷òîæèòü ýòî ìåíþ?\n\n')){
				var element = $('_'+i);
  				element.parentNode.removeChild(element);
 				___changer();	
 			}
		}

		function add(){
			nn++;
			___changer();	
			var link = document.createElement('div');
			
			link.innerHTML = 
				
		'<div class="baba"  id="_'+n+'"><a class="_eye_" title="ïîêà íå÷åãî ñìîòðåòü"><img src="img/eye_small.gif" alt="View"></a> &nbsp; <input type="text" name="v['+nn+']" id="v'+n+'" style="width:301px"> &nbsp;		 <a href="#" title="ââåðõ" onclick="up('+n+'); return false"><img src="img/up.png" alt="ââåðõ"></a> 			 <a href="#" title="âíèç" onclick="down('+n+'); return false"><img src="img/down.png" alt="âíèç"></a>	 <a href="#" title="ñòåðåòü" onclick="del('+n+'); return false"><img src="img/del.png" alt="ñòåðåòü"></a>				<p><img src=""blank.gif alt="ôîí" id="_f'+n+'"> &nbsp;			<a href="#" onclick="cl('+n+');return false">...</a>	<b id="x'+n+'">URL<input type="text" name="f['+nn+']" id="f'+n+'"> èëè ôàéë<input type="file" id="__f'+n+'" name="f'+nn+'">&nbsp; <a onclick="clrnpt(\'f'+n+'\');return false">Óáðàòü</a>		</b>	</p></div>';
 		
		$('__key').appendChild(link);

		n++;
		}
</script>