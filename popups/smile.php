<?php
include "../bmc/main.php"; //bodya
header("Content-type: text/html; charset={$lang['ENCODING']}");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang['lang']; ?>" lang="<?php echo $lang['lang']; ?>">
<head>
	<title>Smilies</title>
	<meta charset=utf-8" />
	<base href="<?php echo $MY_URL; ?>/" />
	
	<style type="text/css">
	<!--
<style>
*{
	margin:0;
	padding:0;
	border:0;
		font-family: verdana;
		font-size: 10px;
		background: #F7F7F7;
 }
</style>
</head>

<body>

<?php
include "../bmc/users/smile.php"; //bodya
bmc_getSmiles('a','a',2);

// Print out all the smilies in the directory
/*$ar=bmc_getSmileFiles();

	for($n=0;$n<=count($ar)-1;$n++) {
		$name=explode(".",$ar[$n]);
		$name=$name[0]; $name=":".strtolower($name).":";

echo <<<EOF
<img alt="$name" src="{$MY_URL}/images/smilies/$ar[$n]" />&nbsp;&nbsp;&nbsp;$name
EOF;
if($n%2)echo" <br />";

	}*/
/*
echo <<<EOF
</table>
<hr width="200" align="left" size="1" color="black">
<table border="0" cellpadding="2" cellspacing="0" width="169">
EOF;

// Print out the symbols from .pak file
$sm=fread(fopen(A_ROOT."/smilies/smiles.pak", "r"), 100000);
$sm=explode("\n",$sm);

	for($i=0;$i<=count($sm);$i++) {

		if(isset($sm[$i]) && strpos(trim("-$sm[$i]"),"#") != 1) {
		list($file, $smil) = explode("=", $sm[$i]);

echo <<<EOF
<img alt="$name" src="{$MY_URL}/smilies/$file" />&nbsp;&nbsp;&nbsp;$smil <br />
EOF;

		}
	}

*/
?>

</body>
</html>
