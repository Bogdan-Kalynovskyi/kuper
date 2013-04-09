<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");

	if(!isnumeric($_GET['id']))
		$_SERVER['REQUEST_URI'] .= "&id={$ABS['id']}";//quick fix...
				

	$NOTE_HASH = NOTE_HASH;

echo<<<EOF
	

	<form accept-charset="$CHRST" method="post" action="{$_SERVER['REQUEST_URI']}" onsubmit="">
		<div id="$NOTE_HASH" class="note">
				<div class="close" onclick="js_note_hide()"></div>

					<br/>Admin note <small>(not seen by users)</small>:<br/>
					<textarea name="$NOTE_HASH">{$ABS['for_admin']}</textarea><br/><br/>
					<input type="submit" value=" Save "/>
					<br/><br/>
		</div>
	</form>

EOF;






//////////////////////////////////////////////////////////////////////////////////////////////////////


	$NOTE_SEARCH_HASH = NOTE_SEARCH_HASH;

echo <<<EOF

	<form accept-charset="$CHRST" method="post" action="{$_SERVER['REQUEST_URI']}
	" onsubmit="">
		<div id="$NOTE_SEARCH_HASH" class="note_search">
				<div class="close" onclick="js_find_hide()"></div>
				
				<br/>Search in notes:<br/>
				<input type="text" name="$NOTE_SEARCH_HASH"/>
				<input type="submit" value="find"/>	
				<br/><br/>			
EOF;

	if(noempty($_POST[NOTE_SEARCH_HASH]))
	{

			$res = $db->query("SELECT id,`name`,`for_admin`  MATCH (`for_admin`) AGAINST (".a($_POST[NOTE_SEARCH_HASH]).") AS rel  
						       FROM `".PRF."table` WHERE  MATCH (`for_admin`) AGAINST (".a($_POST[NOTE_SEARCH_HASH]).") ORDER BY rel");
					       	  
			if($res)
				foreach($res as $r){
					echo '<br/><a href="'.short_name($table).'?id='.$r['id'].'">'.$r['name'].'</a>
					<p><pre>'.mbsubstr($r['for_admin']).'</pre></p>';
				}
			else
				echonone();
		
	}

echo <<<EOF
	
		</div>
	</form>

	<script>//document blur
		$NOTE_HASH=document.getElementById('$NOTE_HASH');
		function js_note(){js_find_hide(); $NOTE_HASH.style.display='block'}
		function js_note_hide(){ $NOTE_HASH.style.display='none'}

		$NOTE_SEARCH_HASH=document.getElementById('$NOTE_SEARCH_HASH');
		function js_find(){js_note_hide(); $NOTE_SEARCH_HASH.style.display='block';}
		function js_find_hide(){ $NOTE_SEARCH_HASH.style.display='none'}
	</script>
EOF;
	
?>