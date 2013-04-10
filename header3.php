<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=<?php echo $CHRST; ?>" /><title><?php echo $bmc_vars['site_title'];?></title><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /><meta name="Keywords" content="<?echo $bmc_vars['site_keywords'];?>" /><meta name="Description" content="<?echo $bmc_vars['site_desc'];?>" />
<link rel=stylesheet href="styles.css" /><!--[if gte IE 7]>
<link rel=stylesheet href="ie.css" /><![endif]--><?php echo
'<style>
#nav h1{width:'.(100/count($BLOGS)).'%}
</style>';
?><!--[if IE 6]><link rel=stylesheet href="ie6.css" /><![endif]-->
<script>
function addLoadEvent(func){var oldonload=window.onload;if(typeof window.onload!='function'){window.onload=func;}else{window.onload=function(){oldonload();func();}}}
var _gaq = [ ['_setAccount', 'UA-20334486-1'], ['_trackPageview'] ];
(function(){
var ga = document.createElement('script'); ga.type='text/javascript'; ga.async=true;ga.src='http://www.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
</head>

<body>
<div id="bg">&nbsp;</div>

<div id="nav">
<?php
	foreach($BLOGS as $i=>$b){

		$active = ( BLOG == $i)? ' id="a_c_t"' : ''; 

		echo '<h1><a href="?page='.$i.'"'.$active.'>'.$b.'</a></h1>';
	}
	
	if(isset($_GET['preview']) && $USER){
		echo '<div style="position:fixed;background:orange;color:red;top:0;width:100%;height:45px;text-align:center;font-size:40px;cursor:pointer" onclick="history.back()">��������������� ��������. ����� ���� ���� ���������</div>';
	}
 ?>
</div>

<div id="container">
	<div id="sux">&nbsp;</div>

<img id="fon" />
<a href="./" id="logo" title="�� �������"><img src="images/logotip.png" alt="��� �������" id="zyx" /></a>