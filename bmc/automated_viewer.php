<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
						

	$aaa = $db->query("SELECT `".implode('`, `', $fields)."` FROM `".PRF."$table` $order_by");
	if(!$aaa) info_msg("No $table");
	//todo pageview
?>



<h1 class="view_heading"><?php echo $table; /**/if(isset($cat))echo $cat;/**/ ?></h1>


<div class="window" style="width:680px"> 

<form onsubmit="return seekfound()">
<div class="quick_search">
		Instant search: 
		<input type="text" id="go2" onkeyup="quick_search(this.value)"/> <input type="submit" value="Go" /> 
</div>
</form>



<?php
$mh=$bmc_vars['th_y']-24;
	echo<<<EOF
		<style>
			div.ramka{
				padding:4px 0 12px 0;
				width:{$bmc_vars['th_x']}px;
				height:{$bmc_vars['th_y']}px;
				float:left;margin:0 23px 0 0;
				line-height:{$bmc_vars['th_y']}px;
			}
			dfn p{margin-top:3px; max-height:{$mh}px;overflow:hidden}
		</style>
EOF;


	foreach($aaa as $p){
		
		
////////////////////////////////////////////////////////		
		if(isset($funcs))
		foreach($funcs as $i){
				switch($i){
					case 'money_earned':
						$p[$i] = (int)$db->evaluate("SELECT SUM(`money`) FROM `".PRF."bids` WHERE user=".a($p['id']));
					break;
					case 'total_money':
						$p[$i] = (int)$db->evaluate("SELECT SUM(`money`) FROM `".PRF."bids` WHERE proj=".a($p['id']));
					break;
					case 'projects_completed':
						$p[$i] = (int)$db->evaluate("SELECT count(*) FROM `".PRF."bids` WHERE `complete` > 0 AND user=".a($p['id']));
					break;
					case 'projects_in_action':
						$p[$i] = (int)$db->evaluate("SELECT count(*) FROM `".PRF."bids` WHERE `complete` = 0 AND user=".a($p['id']));
					break;
				}
		}
////////////////////////////////////////////////////////		
		
		
			
		$id =  reset($p);
		$ite = next($p);
		

////////////////////////////////////////////////////////
		if(isset($p['closed']) && $p['closed']){
			$stl = ' style="*color:#777;opacity:0.5"';
			$dot = '<span title="Closed" style="color:grey"> *</span>';
		}
		else{
			$stl='';
			$dot='';	
		}



/*******************************/	
	
			echo '<div class="termit" name="'.FORM_HASH.'"'.$stl.' id="_'.$id.'">
			
						<div class="ramka">';
								if(noempty($p['pic'])){
									echo '<img src="thumbs/'.basename($p['pic']).'" width="'.$bmc_vars['th_x'].'" height="'.$bmc_vars['th_y'].'" alt=""/>';
									unset($p['pic']);
								}
								else{
									echo '<div></div>';
								}
					 echo "</div>
		
				 				<var><b><big><a href=\"".short_name($table).".php?id={$id}\" id=\"__{$id}\" title=\"More details\">$ite</a>$dot</big></b></var><br/>
				 				
				 	   <div style=\"margin-left:{$bmc_vars['th_x']}px;margin-top:1px\">";
	

			
			next($p);
			while(list ($key, $val) = each($p)){
				
				
				if($val !== '')
					switch($key){
						
						case 'attach':
							echo "<div class=\"attach\" style=\"float:none\">Attachment:&nbsp; <a href=\"{$p['attach']}\">{$p['atname']}</a></div>";
						break;
						
						case 'desc':
							echo '<dfn><p>'.mbsubstr($val).'<p></dfn>';
						break;
						
						case 'for_admin':
							echo "<pre style=\"color:yellow\">$val</pre>";
						break;
						
						default:	
							echo '<var>'.str_replace('_', ' ', $key).'</var> ';
							
							if(strpos($key, 'money')!==false)
								echo '<dfn class="money">'.(int)$val.'$</dfn><br/>';
							else
								echo "<dfn>$val</dfn><br/>";
					}
			}
		
		echo '</div>
		</div>';
		
/*******************************/		
		
	} 	
?>


</div><br/>



<?php
	backButton();
 	include A_VIEW."footer.php";
?>












<script>

	function seekfound(){
		if(found_div){
			found_div.focus();
	
		  	var selectedPosX = 0;
		  	var selectedPosY = 0;
		  	var theElement=found_div;
		              
		  	while(theElement != null){
			    selectedPosY += theElement.offsetTop;
			    theElement = theElement.offsetParent;
		  	}
		                        		      
		 	window.scrollTo(0,selectedPosY-parseInt(screen.height/3));
		}
		return false;	
	}		


function quick_search(str)
{
	found_div = null;
	var stop = false;
	
	for(var i=0; i<n; i++){
	
			var j = '_'+names[i].id;
		
		if(!stop && str.length>2 && document.getElementById(j).innerHTML.indexOf(str) >= 0)
		{
			//stop = true;
			found_div = names[i];
			names[i].style.background = 'orange';
		}
		else
			names[i].style.background = '';
			
	}
}



	
//////////////////////////
	var names = document.getElementsByName('<?php echo FORM_HASH; ?>');
	var n = names.length;
	var found_div = null;

	
	document.getElementById('go2').focus();
///////////////////////////	
</script>
