<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


if (noempty($_POST[SEARCH_HASH])) {


    function nice_output ($table) {
        global $db;
        if (!$table) {
            return;
        } //all?


        if ($table == 'mail') {
            $sq0 = 'atname AS ';
        } //poisk ne tolko po name|desc no i attach
        else {
            $sq0 = '';
        }

        if ($table == 'mail' && LEVEL < 3) {
            $sq1 = ' AND	user=' . a($USER['id']);
        }
        else {
            $sq1 = '';
        }


        $x = mysql_real_escape_string(htmlspecialchars($_POST[SEARCH_HASH]));
        //BECAUSE OF UNIVERSAL

        if ($table != 'mail') {
            $res = $db->query("SELECT id, name, desc FROM " . PRF . "$table
						WHERE name LIKE '%$x%' ORDER BY date DESC LIMIT 10");
            //pageview here
        }
        else {
            $res = $db->query("SELECT u.id, u.$sq0name, u.desc FROM " . PRF . "$table u INNER JOIN " . PRF . "bids b  ON  1 $sq1
					WHERE u.atname LIKE '%$x%' ORDER BY u.date DESC LIMIT 10");
        }


        if (noempty($_POST['deep'])) {

            $res1 = $db->query("
							SELECT id, $qs0name, desc ,
								MATCH(desc)	AGAINST ('$x') AS rel
	        				FROM " . PRF . "$table
	        					WHERE MATCH(desc) AGAINST ('$x') $sq1
	        				LIMIT 10 
	        					ORDER BY rel DESC
	        		");
        }
        else {
            $res1 = false;
        }
        //TODO PAGEVIEW

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        echo '<br/><div  style="text-transform: capitalize" class="line">' . $table . '</div>';

        if ($res || $res1) {
            if ($res && $res1) {
                $res = array_merge($res, $res1);
            }
            elseif (!$res && $res1) {
                $res = $res1;
            }

            foreach ($res as $r) {
                echo '<a href="' . short_name($table) . '.php?id=' . $r['id'] . '">' . $r['name'] . '</a>';
                echo '<pre>' . substr($r['desc'], 0, 100) . '</pre><br/>';
            }
        }
        else {
            echo '<h4>No results</h4>';
        }


    }


//----------------------------------------------------------------------------------------- 


//----------------------------------------------------------------------------------------- 


    echo '<div class="container search_container">
	<h1>Search</h1>';
    if (!isset($_POST['where']) || !is_array($_POST['where'])) {
        $_POST['where'] = $table;
    }


    if (!$_POST['where'] || in_array('All', $_POST['where'])) //...
    {

        foreach ($STA as $s) {
            nice_output($s);
        }

    }
    else //if( in_array($_POST['where'], $STA))
    {

        foreach ($_POST['where'] as $pw) {
            nice_output($pw);
        }

    }

    echo '</div>';
}






















?>
