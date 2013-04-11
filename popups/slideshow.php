<?php
require('config.inc.php');

///////
require('../vars/config.php');
////////////

$startdir = $leadon = '../pics/';
$slideurl = 'pics/';
$cache = 'cache/';
$m_size = 60;



function swap(&$a, &$b)
{ $c=$a;$a=$b; $b=$c;} 
function bmc_fuckfilename($text = ''){
    $file = preg_replace('/[^0-9a-z\.\_\-]/i','',$text);
	if (empty($file)) $file = 'slide'.mt_rand(0,10000);
	return 		$file;
}
function isnumeric(&$str){
	if (!isset($str) || is_array($str))return false;
  	$str = trim($str);
	return preg_match("/^(\d|[1-9]\d*)$/",$str);
}
function stripslashes_deep($value){
	if(is_array($value))
		return  array_map('stripslashes_deep', $value);
	else
		return  stripslashes($value);
}
if(get_magic_quotes_gpc()){
	stripslashes_deep($_GET);
	stripslashes_deep($_POST);
	stripslashes_deep($_COOKIE);
}



function make_thumbnail($f2){
global $leadon, $m_size, $cache;
	
			include_once "image.class";
			$img = new Zubrag_image;
			
			$img->max_x = $m_size;
			$img->max_y = $m_size;

			$img->GenerateThumbFile($f2, $leadon.$cache.basename($f2));
}





//*************************************************************************************
//*************************************************************************************
//*************************************************************************************

if(isset($_POST['dir'])){
	//if we are redirected from insert_image, gets data from its form andgives them to us
	
	if(!isempty($_POST['src'])){

		if(!((substr($_POST['src'],0,7) == 'http://') || (substr($_POST['src'],0,6) == 'ftp://')))		{
			$_POST['src']=$MY_URL.$imagebaseurl.$_POST['src'];
		}
		
		//print_r($_POST); die('');
		if(!isempty($_FILES[$f]['name'])){
	 		$_POST['task'] = 'add_pic';
 		}else
	 		$_POST['task'] = 'add_url';

		$_POST['desc'] = $_POST['alt'];
 	}
}

//*************************************************************************************
//*************************************************************************************
//*************************************************************************************



		 
/////
	$_POST['desc'] = htmlspecialchars(@$_POST['desc']);
	$_POST['slideshow'] = bmc_fuckfilename(@$_POST['slideshow']);





	if(!isempty($_POST['slideshow'])){
		$_POST['slideshow'] = str_replace('lytebox[','',$_POST['slideshow']);
		$_POST['slideshow'] = str_replace(']','',$_POST['slideshow']);
	}






////////////////////////////////////////////////////////////////////////////////////////

	$_POST['max_x'] = isnumeric($_POST['max_x']) ? $_POST['max_x'] : 100;	
	$_POST['max_y'] = isnumeric($_POST['max_y']) ? $_POST['max_y'] : 100;	
	
////////////////////////////////////////////////////////////////////////////////////////





	$file_name = $leadon . $_POST['slideshow'].".txt";

	$rd_file = @file($file_name, FILE_IGNORE_NEW_LINES); 
	if(!$rd_file)$rd_file = array();
	$n = count($rd_file)/2;

	if(isset($_POST['new_desc']) && isset($_POST['src'])){
		foreach($_POST['new_desc'] as $key=>$val){ 
			
			$t_var = get_file($_POST['src'][$key]);
			if($t_var && $rd_file[$key*2] != $t_var){
					$rd_file[$key*2] = $t_var;// CHECK FOR ERROR
					make_thumbnail($rd_file[$key*2]);	
			}
			
			$rd_file[$key*2+1] = $_POST['new_desc'][$key];
		}
	}



//######################################################################################################
if(!isempty($_POST['task'])){
	switch ($_POST['task']){
	
		case 'add_pic' :	
			$f2 = upload_file(true);
			if($f2){

				
				make_thumbnail($f2);

				$rd_file[] = $f2;
				$rd_file[] = $_POST['desc'];
				$n++;

			}
			
		break;

		case 'add_url' :	
			if(!isempty($_POST['src'])){

				make_thumbnail($_POST['src']);
				
				$rd_file[] = $_POST['src'];
				$rd_file[] = $_POST['desc'];
				$n++;
				
			}
			
		break;


		case 'ren_pic' :	
			if(!isnumeric($x = $_POST['pic_num']) )  break;
 
			$f='file1';//hack reload
			$f2 = upload_file(true);
			if($f2){

				unlink($rd_file[$x*2]);

				make_thumbnail($f2);
				
				$rd_file[$x*2] = $f2;
			}

		break;


		case 'move_up': 
		case 'move_down' :	
			if(!isnumeric($x = $_POST['pic_num']) )  break;

			if($_POST['task'] == 'move_up')
				 $y = $x-1;
			else
				 $y = $x+1;

			if($y < 0)	$y = $n-1;
			if($y > $n-1)	$y = 0;
				 
			swap($rd_file[$x*2], $rd_file[$y*2]);
			swap($rd_file[$x*2+1], $rd_file[$y*2+1]);
	
		break;



		case 'del_pic' :	
			if(!isnumeric($x = $_POST['pic_num']) ) break;

			unlink($rd_file[$x*2]);

			array_splice($rd_file, $x*2, 2);
			$n--;
			
		break;



		case 'change_name' :
			$_POST['new_name']	= bmc_fuckfilename($_POST['new_name']);
			$new_name = $leadon.$_POST['new_name'].".txt";
			if(file_exists($new_name) ) break;

			@rename($file_name, $new_name);
			
			$_POST['slideshow'] = $_POST['new_name'];
			
		break;			



		case 'go' :

			include_once "image.class";
			$img = new Zubrag_image;
			$str='';

			for($i=0; $i < $n; $i++)
			{
				$f2 = str_replace($leadon,$slideurl,$rd_file[$i*2]);
				$f3 = 'small_'.basename($f2);
		
				$img->max_x = $_POST['max_x'];
				$img->max_y = $_POST['max_y'];
	
				$img->GenerateThumbFile($rd_file[$i*2], $leadon.$f3);

				$alt = $rd_file[$i*2]+1;//bodya addslashes slideshow
				$str .= <<<EOF
					<a href="{$f2}" rel="lytebox[{$_POST['slideshow']}]" title="$alt"><img src="{$slideurl}{$f3}" style="width:{$img->max_x}px;height:{$img->max_y}px;" alt="$alt" /></a>
EOF;
			}
		//	die($str);
			
	}
	
}


//********************************//
	if($rd_file){
		$file = fopen($file_name, 'wb');
		fputs($file, implode("\n", $rd_file)."\n");
	}
//********************************//



//clear cache folder
//clear all on cansel






















	


header("Content-type: text/html; charset=windows-1251"); 
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<meta charset=windows-1251" >
<title> ������ �������� </title>

<script src="../scripts/wysiwyg-popup.js"></script>
<script src="slideshow.js"></script>
<script language="JavaScript">

function loader(){
<?php
//*************************************************************
	if(isempty($_POST['task'])&& !isset($_POST['dir'])){
			echo "loadImage();";
	}
	
	
	if($_POST['task']=='go' && !isempty($str)){
echo <<<EOF
		var n = WYSIWYG_Popup.getParam('wysiwyg');
		WYSIWYG.insertHTML('$str', n);
	  	window.close();\n
EOF;
	} ?>
}
</script>

<link rel=stylesheet href="slideshow.css" type="text/css">
</head>



<body onload="loader()">
<form method="post" name="myform" action="<?php echo $_SERVER['PHP_SELF'];?>?wysiwyg=<?php echo $wysiwyg; ?>" enctype="multipart/form-data">
<input type="hidden" name="task" value="go">
<input type="hidden" name="slideshow" value="<?php echo $_POST['slideshow'];?>">
<input type="hidden" name="pic_num" value="">

<?php //if(isset($errormsg))echo '<br><b>'.$errormsg.'</b>'; // PRINT_R($_REQUEST); ?>
<br>
<table border="2" cellpadding="2" cellspacing="2" style="border: 1px solid #ff8930;">
<?php 
	for($i=0; $i < $n; $i++){

		$desc = $rd_file[$i*2+1];
		$f2 = $rd_file[$i*2];
		$f3 = $slideurl.$cache.basename($f2);

		echo <<<EOF
<tr>
<td><a onclick="do_('del_pic', $i)" title="Del" href="#"><img src="{$MY_URL}images/cross-red.png"  alt="��������"></a></td>
<td><a onclick="do_('move_up',$i)" title="�����"><img src="{$MY_URL}images/arrow-up.png" alt="�����"></a><br><a onclick="do_('move_down',$i)" title="����"><img src="{$MY_URL}images/arrow-down.png" alt="����"></a></td>
<td><a href="#" onclick="popwin('{$f2}'); return false;"><img src="{$MY_URL}{$f3}" alt=""></a></td>
<td><span id="aaa$i">URL:&nbsp; <input type="text" name="the_url[$i]" size = 34 value="$f2"/></span></td>
<td><nobr>����:&nbsp;<input type="text" name="new_desc[$i]" value="$desc"></nobr></td>
<td><input type="button" value=" ��������������� " onclick="clear_f1(this, $i)"></td>
</tr>

EOF;
	}
//	<tr><td colspan="4">&nbsp;</td></tr><tr>
				//	print_r($rd_file);

?>




<td colspan="3"><nobr>� URL: <input type="text" name="new_url"></nobr></td>
<td><nobr>� �����: <input type="file" name="file"></nobr></td>
<td><nobr>����:&nbsp;<input type="text" name="desc"></nobr></td>
<td><br><input type="button" value="    *    ������    *   " onclick="myform.task.value='add_pic'; myform.submit();"><br><br></td>

</tr>
</table>







<div class="block" style="float:left">
	<span class="text">��������� ��������</span>
	<input type="text" name="new_name" style="width:128px" value="<?php echo $_POST['slideshow'];?>">
	<div style="height:5px"></div>
	<span class="text">����� �������</span>
	X:				<input type="text" size="2" name="max_x" value="<?php echo $_POST['max_x'];?>">
	&nbsp; &nbsp;Y:	<input type="text" size="2" name="max_y" value="<?php echo $_POST['max_y'];?>">
</div>

<div class="block" style="float:right">
	<div style="height:12px"></div>
	<input type="submit" value="    �������� ��������    "> &nbsp; &nbsp; &nbsp;
	<input type="button" value="    ³����    " onclick="window.close();">&nbsp;
	<div style="height:13px"></div>
</div>





</form>
</body>
</html>
