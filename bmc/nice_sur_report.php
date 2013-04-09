<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
	




/////////////////////////////////////////////////////////////////////////////////////////////


	if(noempty($_POST[FORM_HASH])){
		$str='<style>pre{padding:2px 10px 2px 20px;border-bottom:1px #EEE dotted} strong{width:200px;font-weight:bold;padding-bottom:4px;display:inline-block}</style><div class="border" style="width:300px;padding:24px;border:4px dotted #446">';
		
		
		foreach($qqq as $i=>$q){$key=$q['id'];
			/*if(isset($_POST['b'.$key]) && $_POST['b'.$key]==$q['correct'])$i++;	*/


			$str.="
					<big>$i)</big>
					<strong>{$q['caption']}</strong>";
			
			
				if(noempty($_POST['b'.$key]))
				{

					if($q['mode'])
					{
							$rows=explode("\n", $q['answers']);
							$str .= '<pre><i>('.htmlentities($_POST['b'.$key].')</i> - '.@$rows[$_POST['b'.$key]]).'</pre>';
					}
					else
					{
							$str .= '<pre>'.htmlentities($_POST['b'.$key]).'</pre>';
					}
				
				}
				else
				{
					$str .= '<pre> <small class="date">empty...</small> </pre> ';
				}
				
			$str.='<br/>';	
			
		}
			

			$str.='</div><small class="date">'.date($bmc_vars['date_format'], time()).'</small>
				<br/><br/><br/>';
				
			$str2="
				<h2>Survey <b><a href=\"$MY_URL/survey.php?id={$sss['id']}\">
					{$sss['name']}
				</a></b></h2><br/>
				<h2>User <b><a href=\"$MY_URL/user.php?id={$USER['id']}\">
					{$USER['name']}
				</a></b></h2><br/>";
		
		
		/*$count = count($qqq);
		$percent = round($i/$count*100);
		
		echo<<<EOF
			<h2><br/>Survey {$sss['name']}<br/><br/></h2>
			<h1>You have given $i correct answers to $count questions<br/></h1>
			<h3><b>Your level is $percent%</b></h3> <br/><br/><br/>
EOF;*/


	echo  $str2.$str;





/////////////////////////////////////////////////////////////////////////////////////////////



		$a=array(
			'survey'	=>$_GET['id'],
			'answer'	=>$str,
			'time'		=>time(),
			'user'		=>$USER['id']
		);
		
		$sql = $db->sql_from_array('INSERT', $a);

		$db->query("INSERT INTO `".PRF."answers` $sql");
	
		bmc_mail($bmc_vars['email'], 'Survey from user '.$USER['name'], $str2.$str);


		backButton();
 		include A_VIEW."footer.php";
 		exit;

	}



	
?>