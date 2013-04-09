<?php

//-----------------------------------------------//
	function NonCachePlusEncoding(){
		global $CHRST;
		
		header("Content-Type: text/html; charset=$CHRST");	//н1яких лапок 1 н1яких проб1л1в?

		header('Expires: -1');//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
		header('Cache-Control: no-store, no-cache, must-revalidate', false); 
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
		//+1 ???? see current situation and older posts 98%
		
		//todo: does this really work?
	}

	
//------------------------------------------------//
	function echonone(){//todo more and more sexy
		echo '<div style="padding:3px;text-align:center">none</div>';
	}
	function backButton(){/*id = back_button??? title="back"*/echo<<<EOF
		<input type="button" id="error_button" value="        O K        " onclick="document.location='./'" title="Назад" style="
		display:block;
		margin:0 auto;
		font-size:15px;
		background:B0B0E0;
		color:#000;
		cursor:pointer;
		padding:2px;
		border:2px solid #bbb !important;
		margin:33px auto;
		-moz-border-radius:9px;
		border-radius:9px;
		-moz-box-shadow:3px 4px 4px #ddf;
		-webkit-box-shadow:4px 3px 4px #ddf;
		box-shadow:4px 3px 4px #ddf;
		" />
		
		<script type="text/javascript">
			//document.getElementById('error_button').focus();
		</script>
EOF;
	}

	
//todo function draw_grey_button(){}
	
//------------------------------------------------//
	function echoicon($src){
					if(noempty($src))
						return '<img class="icon" src="'.$src.'" alt="" />';
					else
						return '<div class="icon">&nbsp;</div>';
	}


//------------------------------------------------//
/////////////////////////////// заборонены нейм з пыдкресленням
function addUserToProjectLink($u, $p){
		$x=completeGetRequest();
		echo<<<EOF
			 <a name="_$u" 
			 href="?action=add_user_to_project&user=$u&proj=$p{$x}#_$u" 
			 class="kitten" 
			 onclick="return confirm('Add user to project?')" />Add user to project</a>
EOF;
	}

	function addProjectToUserLink($p, $u){
		$x=completeGetRequest();
		echo<<<EOF
			 <a name="_$p" 
			 href="?action=add_project_to_user&user=$u&proj=$p{$x}#_$p" 
			 class="kitten" 
			 onclick="return confirm('Add project to user?')" />Add project to user</a>
EOF;
	}
	function removeUserFromProjectLink($u, $p){
		$x=completeGetRequest();
		echo<<<EOF
			 <a name="_$u" 
			 href="?action=remove_project_from_user&user=$u&proj=$p{$x}#_$u" 
			 class="kitten" 
			 onclick="return confirm('Remove user from project?')" />Remove user from project</a>
EOF;
	}
	function removeProjectFromUserLink($p, $u){
		$x=completeGetRequest();
		echo<<<EOF
			 <a name="_$p" 
			 href="?action=remove_project_from_user&user=$u&proj=$p{$x}#_$p" 
			 class="kitten" 
			 onclick="return confirm('Remove project from user?')" />Remove project from user</a>
EOF;
	}
	
	function completeGetRequest(){
		/*$str='';
		foreach($_GET as $key=>$value)
			$str .= "&$key=".myurlencode($value);
		return $str;*/
		if(isset($_GET['id']))
		return '&id='.rawurlencode($_GET['id']);
	}
	function completePostRequest(){/*for autometic login/delogin redirection*//*so you shouldfollow this function with automatical javascriot that fill in the form fith all the fields have been selected!*/}
//////////////////////////////	





//-----------------------------------------------------------------------------------------------------//
function bulk_message($msg, $color){
	if(is_array($msg))
		$msg = implode('<br/>', $msg);
		
	echo <<<EOF
		<h2 style="
			color:$color;
			margin:140px auto 25px auto;
			text-align:center;
			font:20px bold Arial, sans-serif;
			line-height:114%
		">
			$msg
		</h2>
EOF;
//font-size
	backButton();
}

//error logging це круто

function error_page($msg){
 	include A_VIEW."header_1.php";
	bulk_message($msg, 'red');
 	include A_VIEW."footer.php";
 	exit;
}

function info_page($msg){
 	include A_VIEW."header_1.php";
	bulk_message($msg, '#999');
 	include A_VIEW."footer.php";
 	exit;
}
function error_msg($msg){
	bulk_message($msg, 'red');
 	include A_VIEW."footer.php";
 	exit;
}

function info_msg($msg){
	bulk_message($msg, '#999');
 	include A_VIEW."footer.php";
 	exit;
}

function good_page($msg){
 	include A_VIEW."header_1.php";
	bulk_message($msg, '#0b0');
 	include A_VIEW."footer.php";
 	exit;
}

function good_msg($msg){
	bulk_message($msg, '#0b0');
 	include A_VIEW."footer.php";
 	exit;
}

function plus_minus($plus){
	$str='';
	
	if($plus)$str=<<<EOF
	<script>
		function plus_minus(plus, name){
			var z = prompt('Amount, $: ');
			if(!/*isNumeric*/(z) ) return;

			document.location.href = '?action=' + ((plus)? 'add_money' : 'remove_money') + '&ammount=' + z
			+ '&user={$_REQUEST['user']}&proj={$_REQUEST['proj']}' + ((name)? ('#'+name) : '');
		}
	</script>
EOF;

	$str .= '<input type="button" class="btn" value=" '.($plus?'+':'-').' " onclick="plus_minus('.$plus.', \'\')" />';
	
	return $str;
}
function inline_plus($u, $p, $n){
	return<<<EOF
			var z = prompt('Place amount, $: ');
			if(!/*isNumeric*/(z) ) return;
			
			document.location.href = '?action=add_money&ammount=' + z
			+ '&user=$u&proj=$p#___$n';
EOF;
	
}
?>