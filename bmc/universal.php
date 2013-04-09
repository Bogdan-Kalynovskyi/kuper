<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");
	
	include A_HOME.'data_functions.php';
	

if(noempty($_POST[FORM_HASH])){


// ==============================
	if($_POST[FORM_HASH]!='delete'){
				
				Required_and_Unique();
				
				if( !$_POST['id'] ){//add;//==0
				   		$sql = sql_from_post('INSERT', $fields, $table);
				   		$db->query("INSERT INTO `".PRF."$table` $sql");
						$_REQUEST['selector'] = mysql_insert_id();
						
							$_result='Successfully added';
			   	}else{
				   		$sql = sql_from_post('UPDATE', $fields, $table);// replace into?
						$db->query("UPDATE `".PRF."$table` SET $sql WHERE id=".a($_POST['id']));
						
							$_result='Successfully updated';
				}



// ==============================
	}elseif(isnumeric($_POST['id'])){
		
				// GARBAGE COLLECTOR	
				switch($table){
					case 'users': 		
						$db->query("REPLACE INTO `".PRF."drafts` SELECT * FROM `".PRF."bids` WHERE user=".a($_POST['id']) );
						$db->query("DELETE FROM `".PRF."answers` WHERE user=".a($_POST['id']));
						$db->query("DELETE FROM `".PRF."mail` WHERE user=".a($_POST['id']));
						$db->query("DELETE FROM `".PRF."bids` WHERE user=".a($_POST['id']));
						break;
					case 'projects': 	
						$db->query("REPLACE INTO `".PRF."drafts` SELECT * FROM `".PRF."bids` WHERE proj=".a($_POST['id']) );
						$db->query("DELETE FROM `".PRF."mail` WHERE proj=".a($_POST['id']));
						$db->query("DELETE FROM `".PRF."bids` WHERE proj=".a($_POST['id']));
						break;
					case 'surveys':	 	
						//answers
						$db->query("DELETE FROM `".PRF."questions` WHERE `survey`=".a($_POST['id']));
						break;
					case 'cats':	 		
						//$db->query("DELETE FROM `".PRF."bids` WHERE `cat`=".a($_POST['id']));//DOHUJA ROPOTY.PIZDETS
						$db->query("DELETE FROM `".PRF."projects` WHERE `cat`=".a($_POST['id']));//todo delete
						break;
				}


				$db->query("DELETE FROM ".PRF."$table WHERE id=".a($_POST['id']));

		
				//TODO UNLINK?//NEWS
				unset($_REQUEST['selector']);
					$_result='Successfully deleted';
	}
	
	
// ==============================
		//UP-DOWN?
		
		
// ==============================
}	




		$raw = $db->query("SELECT * FROM `".PRF."$table` $order_by");
		$count = count($raw);


		if(!isnumeric($_REQUEST['selector']) && $raw) 
			$_REQUEST['selector'] = $raw[0]['id'];



// VSE PLOHO
?>






	<h1 style="text-transform: capitalize"><?php echo $table ?></h1>
	
<form accept-charset="<?php echo $CHRST ?>"  method="post" id="frm" 
	action="<?php echo $_SERVER['SCRIPT_NAME'];?>" enctype="multipart/form-data" onsubmit="return verify_form()">

	<fieldset class="form_fields" style="width:760px">

		<br/>

	
	<input type="hidden" name="<?php echo FORM_HASH; ?>" id="to_do" />
	<input type="hidden" name="id" id="id" />
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />

	
<table style="border:0;  margin: 0 auto; width:720px" cellpadding="0" cellspacing="10">
	<tr>
		
		
	<td style="vertical-align:top;text-align:center;border-right:1px solid #999;padding-right:30px;">
		
		<input type="text" id="qs" value="Search..." onfocus="s1();" onblur="s2();" onkeyup="s3();" style="opacity:0.4;width:184px; height:16px; position:relative;top:-21px; padding-right:22px;background:url(img/search_submit.gif) no-repeat top right"/>
		
		<select style="width:210px;font-size:15px;position:relative;top:-16px;" name="selector" id="selector" size="<?php echo ($count<16)?($count+1):17; ?>" onchange="select_changer()">
			<option value="0" style="color:#aaa">     -----   New   -----    </option>
			<?php 
			$ii = 0;//critical
			foreach($raw as $i => $val){
				
				if($val['id'] == $_REQUEST['selector'])
					$ii = $i+1;//critical
					
				echo "<option value=\"{$val['id']}\"  title=\"{$val['name']}\">{$val['name']}</option>";
			}
			?>	
		</select><br/>
		<small><?php echo "$table count = $count"?></small>
		<br/><br/><br/>
		<span id="a_add" onclick="new1();return false" style="color:#119;cursor:poiner;text-decoration:underline;font-weight:bold"> Add New </span>

	</td>