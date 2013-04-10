<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");	
?>

<link rel="stylesheet" href="css/style.css" />


<div id="contest">
<?php


		if($POOO){

				post_echo($POOO);
			
		}else{
	
			$posts = $db->query("SELECT SQL_CALC_FOUND_ROWS * FROM `".PRF."posts` WHERE blog=".BLOG." ORDER BY por DESC" , true, true);
			
			$P_COUNT = $db->total_count();
					
			foreach($posts as $id => $post)
			
				{post_echo($post);}
						
 			if($P_COUNT > count($posts)) include A_ROOT."page_num.php";

		}
		
	
		 
		if(IS_ADMIN) admin_new('+ 1');
		
?>
</div>


<?php 




function post_echo($post){


				echo '<div class="c_item">';
				
				if(BLOG!=2)echo echoicon($post['icon']);
					
				echo '<var>'.$post['title'].'</var><dfn>'.$post['summary'].'</dfn>';
				
				echo '<div style="clear:both">&nbsp;</div>';

				if($post['data']){
						echo '<a href="#" class="clickable" onclick="sh(\'z'.$id.'\');return false">������ ������...</a>
						<div id="z'.$id.'" class = "fullsize">'.$post['data'].'</div>';
				}

				echo '<div style="clear:both">&nbsp;</div>';

				if(IS_ADMIN) admin_box($id);
				
				echo '</div>';

}
	
?>