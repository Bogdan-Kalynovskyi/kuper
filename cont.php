<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
?>
<style>
#fon{
	position:fixed;
}
</style>

<br><br>
<br>

<h1>Êîíòàêòû</h1>
<br>
<br>
<br>

<?php
					
		
				echo "
				<big>Òåëåôîí <a href=\"callto:{$bmc_vars['phone']}\">{$bmc_vars['phone']}</a><br><br>
				<big>Email <a href=\"email:{$bmc_vars['email']}\">{$bmc_vars['email']}</a><br><br>
				{$bmc_vars['contacts']}</big>";
				
				</big>;
				

					echo echoicon($POOO['icon']);

					echo  	' <span class="date">'.bmc_date($POOO['date'], 'j F').'</span>';
					
					echo   	' <div style="width:400px;float:left;clear:right"><var>'.$POOO['title'].'</var>';
					echo 	' <dfn>'.$POOO['summary'].'</dfn></div>';		

				echo '</div><!-- c_item -->';
					
					
				//	if(IS_ADMIN) admin_box($POOO);
				//	if(IS_ADMIN) admin_new('+ 1');


		 		 		

?>     
