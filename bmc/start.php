<?php
	require HOME_DIR."/main.php";
// for unlogged user or user having nothing special to do


	include_once A_HOME."/fun_viewer.php";
	if(mt_rand(0,120)==10) include A_HOME."/core/reset_drafts.php";
	// ================== Full view mode (permalink)************************************************


	if($POOO){
// 1
		if(isset($_GET['print'])){
			
			bmc_printPost($POOO, true, null, true);
			
		}
		else{
// 2
			bmc_Template('page_header', BLOG_NAME." :: ".strip_all($POOO['title']), $POOO['keyws'], true);
				bmc_printPost($POOO, true, null);
			bmc_Template('page_footer');
		
		}
	}
	else
	{
//3
		include A_HOME."/core/multi_view.inc.php";
	
	}
?>
