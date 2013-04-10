<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");



	if(!isnumeric($_GET['gallery']))bmc_go(-1);

	$PHOTO = $db->query("SELECT * FROM `".PRF."photo` WHERE post=".a($_GET['gallery'])." ORDER BY por ASC");

	$nme =$db->evaluate("SELECT title FROM `".PRF."posts` WHERE id=".a($_GET['gallery']));
	$max =$db->evaluate("SELECT max(id) FROM `".PRF."photo`");

	$db->query("UPDATE `".PRF."posts`  SET	ok=1	WHERE id=".a($_GET['gallery']));

/************************************************************/
if($db->evaluate("SELECT blog FROM `".PRF."posts` WHERE id=".a($_GET['gallery']))==5){
				include A_ROOT.'editor/five.php';
return;
}
/************************************************************/

?>


<h2> ������ ������� <a href="./?id=<?php echo htmlspecialchars($_GET['gallery']) ?>"><b>"<?php echo $nme ?>"</b></a>. <?php echo count($PHOTO) ?> ������</h2>

<form method="post" action="user.php" accept-charset="<?php echo $CHRST ?>" enctype="multipart/form-data">
<fieldset>
	<input type="hidden" name="<?php echo FORM_HASH; ?>" value="4" />
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	<input type="hidden" name="post" value="<?php echo @$_GET['gallery'] ?>" />

<br/>
<div id="__key">
<?php
$k = 0;
$s=$_GET['gallery'];
foreach($PHOTO as $ph){
	
	$key = $ph['id'];
	$val = $ph['title'];
	$text = $ph['summary'];
	$image = htmlspecialchars(rawurldecode($ph['icon']));
	$fon = htmlspecialchars(rawurldecode($ph['fon']));

	if(!trim($ph['icon']))$ph['icon']='blank.gif';
	if(!trim($ph['fon']))$ph['fon']='blank.gif';

		echo <<<EOF
		<div class="baba" id="_$k">
		
			<label><span>
			
				<a href="./?id=$s" target="_blank" class="_eye_" title="�����������"><img src="img/eye_small.gif" alt="&bull;"/></a>���������</span> 
				<input type="text" name="v[$key]" value="$val" id="v$k" class="title" />
	
			<b>
			
				 <a href="#" title="�����" onclick="up($k); return false"><img src="img/up.png" alt="�����" /></a> 
				 <a href="#" title="����" onclick="down($k); return false"><img src="img/down.png" alt="����" /></a>
				 <a href="#" title="�������" onclick="del($k); return false"><img src="img/del.png" alt="�������" /></a>
				
			</b>

			</label> 
			
			<label><span>�������</span>
		
			<img src="{$ph['icon']}" alt="���" id="_i$k" /> 
			URL<input type="text" name="i[$key]" id="i$k" value="$image" />  ��� ����<input type="file" id="__i$k" name="i$key" />
		   &nbsp;<a onclick="clrnpt('i$k');return false">������</a>
		    
			</label>

			<label><span>���</span>
		
			<img src="{$ph['fon']}" alt="���" id="_f$k" /> 
			URL<input type="text" name="f[$key]" id="f$k" value="$fon" /> ��� ����<input type="file" id="__f$k" name="f$key" />
		   &nbsp;<a onclick="clrnpt('f$k');return false">������</a>
		    
			</label>

			<label>
 			<span style="float:left">��������</span>
	 		<textarea name="t[$key]" id="t$k">$text</textarea>
			</label>

		</div>
		<hr/>

EOF;
$k++;
}

?>
</div>
	<img src="images/plus.gif" title="��������" alt="��������" onclick="add()" style="margin-left:30px; cursor:pointer" /> &nbsp; � ����� � ������� ��������� ������������� ������� ��������� ��������, � ����� ���������� �� �����-����
	<br/>
	<br/>
	
	<input type="submit" value="      ���������      " style="margin-left:40px" /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<input type="button" value="      ������      " onclick="document.location='user.php'" />

</fieldset>
</form>


<script>

		var n = <?php echo (string)(int)$k ?>;
		var nn = <?php echo (string)(int)$max ?>;
		
		lightbox();
		
		inject();
		
		function up(i){
			var a=i;
			do{
				 a = (a>0)?a-1:n-1;
			}while(isNull('_'+a));

			swap('v', i, a);
			swat('i', i, a);
			swat('f', i, a);
			swap('t', i, a);

		}

		
		function down(i){
			var a=i;
			do{
				 a = (a<n-1)?a+1:0;
			}while(isNull('_'+a));
			
			swap('v', i, a);
			swat('i', i, a);
			swat('f', i, a);
			swap('t', i, a);
			
		}

		
		function del(i){
		//todo test ie	
			if(confirm(' ������� �������?\n\n' + $('v'+i).value)){
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
				
'	<div class="baba" id="_'+n+'">			<label><span><a class="_eye_" title="���� ������ ��������"><img src="img/eye_small.gif" alt="&bull;"/></a>���������</span> 		<input type="text" name="v['+nn+']" id="v'+n+'" class="title" />	<b>				 <a href="#" title="�����" onclick="up('+n+'); return false"><img src="img/up.png" alt="�����" /></a> 	 <a href="#" title="����" onclick="down('+n+'); return false"><img src="img/down.png" alt="����" /></a>				 <a href="#" title="�������" onclick="del('+n+'); return false"><img src="img/del.png" alt="�������" /></a>			</b>			</label>			<label><span>�������</span>			<img src="blank.gif" alt="���" id="_i'+n+'" /> 	URL<input type="text" name="i['+nn+']" id="i'+n+'" /> ��� ����<input type="file" id="__i'+n+'" name="i'+nn+'" /> &nbsp;<a onclick="clrnpt(\'i'+n+'\');return false">������</a>		</label>			<label><span>���</span>			<img src="blank.gif" alt="���" id="_f'+n+'"/> 		URL<input type="text" name="f['+nn+']" id="f'+n+'" /> ��� ����<input id="__f'+n+'" type="file" name="f'+nn+'" />	&nbsp;<a onclick="clrnpt(\'f'+n+'\');return false">������</a>	</label>			<label> 			<span style="float:left">��������</span>	 		<textarea name="t['+nn+']" id="t'+n+'"></textarea></label>		</div><hr/>';

		$('__key').appendChild(link);

		n++;
		}
</script>