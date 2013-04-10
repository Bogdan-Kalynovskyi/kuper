<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
	
	$name =  array('site_title','site_keywords','site_desc','email','phone','vk','lj',  'contacts', 'def_fon', 'inline');
	$title = array('��������� �����','����� ��� �����������','�������� �����','Email', '�������', '���������', 'LiveJournal', 'E�� �������� &nbsp;<small><small>(�������������. &nbsp;�������� ��� HTML)</small></small> ', '��� �� ��������� &nbsp;<small><small>(����� ��� "�������� ������". &nbsp;������ - ������ ��� ����)</small></small>', '����������� �������������� ��� ��������� �������� &nbsp;<small><small>(������ ���� �������������)</small></small> ');
	$type = array(0,0,0,0,0,0,0,1,2,3);

?>
<style>
label{font-weight:bold}
label a{font-weight:normal}
small{font-weight:normal}
</style>

<h2> �������������� ����������... </h2>
	
<form method="post" action="user.php" accept-charset="<?php echo $CHRST ?>" enctype="multipart/form-data">
<fieldset>
	<input type="hidden" name="<?php echo FORM_HASH; ?>" value="2" />

<?php
	
	foreach($name as $i=>$n){
		
		$x = htmlspecialchars(@$bmc_vars[$n]);
	
		switch($type[$i]){
			case 0:
			echo <<<EOF
			<label>{$title[$i]}<br />
				<input type="text" name="$n" value="$x" size="94" />
			</label><br/><br/>
EOF;
			break;
			
			case 3:
			$ch = ($x)?'checked="checked" ':'';
			echo <<<EOF
			<label>{$title[$i]}<br />
				<input type="checkbox" name="$n" value="1" $ch/>
			</label><br/><br/>
EOF;
			break;

			case 1:
			echo <<<EOF
			<label>{$title[$i]}<br />
				<textarea name="$n"  cols="78" rows="4">$x</textarea>
			</label><br/><br/>
EOF;
			break;

			case 2:
			if(!trim($x))$x='blank.gif';
			echo <<<EOF
			<label>{$title[$i]}<br /> 
				<img src="$x" width="50" height="50" id="_$n" alt="" />&nbsp; &nbsp;
				URL <input type="text" id="$n" name="$n" value="$x" /> &nbsp;&nbsp;
				��� ���� <input type="file" name="$n" id="__$n" /> &nbsp; <a href="#" onclick="clrnpt('$n');return false"><small>������</small></a>
			</label><br/><br/>
EOF;
			break;
		}

	}
	
?>
<br/>
	<input type="submit" value="      ���������      " style="color:#222" />&nbsp; &nbsp; &nbsp;
	<input type="button" value="       ������       " onclick="document.location='user.php'" />


</fieldset>
</form>


<script>

	lightbox();
	
</script>
