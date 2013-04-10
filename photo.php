<?php
	if(!defined('IN_BMC'))
		die("Access Denied!");



	if(isnumeric($_GET['page']) || isnumeric($_GET['blog'])){
		$om = false;
		$data = $db->query("SELECT * FROM `".PRF."posts` WHERE blog=".BLOG." ORDER BY por ASC", true, true);
		if(!$data) die ("error1");
	}
	
	elseif(isnumeric($_GET['id'])){
		$om = false;
		$one = $db->query("SELECT * FROM `".PRF."posts` WHERE id=".a($_GET['id']), false);
		$data = $db->query("SELECT * FROM `".PRF."photo` WHERE post=".a($_GET['id'])." ORDER BY por ASC", true, true);
		if(!$one) die ("error2");
		if(!$data) die ("error3");
	}else
		die ("error4");

	
	$ABS = false;
	
?>

<style>


	#gal{
		position:relative;
		z-index:30;	
	}


	h1{
		text-align:center;
		font-size:22px;
	}
	h2{
		text-align:center;
		font-size:15px;
		/*font-weight:normal;*/
		color:#777;
	}
</style>



<br/>
<h1>
<?php
/*
	if($om){
		echo '������ ������� ';
	}else{
		echo '��������� ������� '.$one['title'];
	}
	*/
?>
</h1>

<?php

	if(!$om && isset($one['summary']))
		echo '<h2>'.$one['summary'].'</h2>';
	
?>

<style>

<?php
	if($om){
		$wdth = 95/count($data);
		echo <<<EOF
			#fon{ opacity:0.5}
			ul#gal{
				margin: 20px auto;
				width:96%;
			}

			ul#gal li{
				display:inline-block;
				width:{$wdth}%;
				text-align:center;
			}
			ul#gal li a{
				color:#449;
			}

			ul#gal li a img{
				display:block;
				height:{$bmc_vars['thumb_y']}px;
				margin:0 auto;
			}

EOF;
	}else{
		echo <<<EOF
			ul#gal li a{
				display:inline-block;
				padding:10px;
				margin:5px;
				color:brown;
				height:{$bmc_vars['thumb_y']}px;
				color:#008;
				text-decoration:none;
			}
			ul#gal li a img{
				float:left;
				height:{$bmc_vars['thumb_y']}px;
				opacity:0.9;
			}
			h3,h4{
				margin-left:200px;
			}
			h3{
				margin-bottom:7px
			}
			
			ul#gal li a:active{
				outline:1px dotted grey
			}
			ul#gal li a:hover{
				color:#D52A2A;
			}
			ul#gal li a:hover img{
				opacity:1;
			}


EOF;
	}
?>

		ul#gal li a h3{
			font-size:19px;
			font-weight:normal;
		}
		ul#gal li a h4{
			font-weight:normal;
		}
</style>



	<ul id="gal">
<?php
	
	$k=0;
	foreach($data as $i=>$d){
		
		if(!$om){
			$longtext = 'href="#" onclick="z('.$k.');return false"';
			$d['icon'] = 'thumb/'.basename($d['icon']);
		 }else{
		 	$longtext="href=\"?id=$i\"";
		 }
		 
		echo <<<EOF
			<li>
			<a $longtext>
				<img src="{$d['icon']}" alt="" />
				<h3>{$d['title']}</h3>
				<h4>{$d['summary']}</h4>
			</a>
			</li>
		
EOF;

		$k++;
	}
			
?>
	</ul>








<?php if(!$om){
	include A_ROOT."gallery.php"; ?>



<script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>

<script>

    jQuery.noConflict();
	var mol = $('molbert');
		
		 	jQuery(mol).click(function(event){
		    	event.stopPropagation();
		 	});
		
		 	jQuery('a').click(function(event){
		    	event.stopPropagation();
		 	});



	function b(){
			TINY.alpha.set(mol, 0, 10);
			clearTimeout(slideshow.lt);
			clearTimeout(slideshow.at);
			
			jQuery('body').unbind('click');
	}
	

	function z(x){
			TINY.alpha.set(mol, 100, 10);
			slideshow.is(x, 0);
			
			document.getElementById('container').onclick =function() {
				b();
			};
	}


	slideshow.auto = 0;
	



</script>	
<?php } ?>

