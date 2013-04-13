<?php

define('REQUIRED', 3);

define('A_ROOT', dirname(__FILE__) . '/');

require_once A_ROOT . 'bmc/main.php';

/*
$x = fopen('1.log','a');
fputs($x,$_SERVER['REQUEST_URI'].'\t\t\t\t'.@$_POST['id'].'\t\t\t\t'.microtime().'\n');
*/


include_once A_HOME . 'fun_admin.php';


if (@$_POST[FORM_HASH] == 1 && @$_POST['blog'] == 1) {
    $_POST['icon'] = myurlencode(up_pic('icon', '', '', 'kartiny/', $bmc_vars['blog_x'], $bmc_vars['blog_y']));
    if ($_POST['icon']) {
        $db->query("REPLACE INTO {$PRF}vars (name, val) VALUES ('zastavka', " . a(@$_POST['icon']) . ')');
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


elseif (@$_POST[FORM_HASH] == 1 && isnumeric($_POST['id']) && isnumeric($_POST['blog'])) { //pin();


    include_once A_HOME . 'upload_pic.php';

    /***********************/
    if ($_POST['blog'] > 3) {
        $bmc_vars['blog_x'] = $bmc_vars['x'];
        $bmc_vars['blog_y'] = $bmc_vars['y'];
    }

    $_POST['icon'] = myurlencode(up_pic('icon', '', '', 'kartiny/', $bmc_vars['blog_x'], $bmc_vars['blog_y']), 1);
    $_POST['fon'] = myurlencode(up_pic('fon', '', '', 'kartiny/', $bmc_vars['x'], $bmc_vars['y']));
    $_POST['title'] = simplewrap(htmlspecialchars(htmlspecialchars_decode(@$_POST['title']))); //no html
    $_POST['summary'] = simplewrap(htmlspecialchars_decode(@$_POST['summary']));
    $_POST['data'] = simplewrap(htmlspecialchars_decode(@$_POST['data']));


    ////////////V//EXCEPTION 1

    if (@$_POST['nesegalavodu']) {
        $_GET['gallery'] = $_POST['id'];
    }

/////////////////////////


    if (@$_POST['preview']) {
        $db->query("INSERT INTO {$PRF}posts SET

            blog = " . a($_POST['blog']) . ',

            title = ' . a($_POST['title']) . ',
            icon = ' . a($_POST['icon']) . ',
            fon = ' . a($_POST['fon']) . ',
            summary = ' . a($_POST['summary']) . ',
            data = ' . a($_POST['data']) . ',
            date = ' . a(@$_POST['date']) . ',
            por = ' . a(@$_POST['por']) . ',
            draft = ' . a(@$_POST['draft']) . ',
            gallery = ' . a(@$_POST['gallery']) . ',
            switch = ' . a(@$_POST['switch']) . ',
        ');

        $_GET['id'] = $db->evaluate('SELECT LAST_INSERT_ID()');
        $_GET['blog'] = $_POST['blog'];
        $_GET['preview'] = true;

        include A_ROOT . 'index.php';

        $db->query('DELETE LOW_PRIORITY FROM ' . PRF . 'posts WHERE id == ' . a(@$_POST['id']));

        exit;
    }

    else {
        $db->query('REPLACE ' . PRF . 'posts SET

            blog = ' . a($_POST['blog']) . ',

            title = ' . a($_POST['title']) . ',
            icon = ' . a($_POST['icon']) . ',
            fon = ' . a($_POST['fon']) . ',
            summary = ' . a($_POST['summary']) . ',
            data = ' . a($_POST['data']) . ',
            date=' . a(@$_POST['date']) . ',
            por=' . a(@$_POST['por']) . ',
            draft=' . a(@$_POST['draft']) . ',
            gallery=' . a(@$_POST['gallery']) . ',
            switch=' . a(@$_POST['switch']) . ',

            id=' . a($_POST['id'])
        );
    }
}


/***********************************************************************************************************/
//33333333333333333333333333333333333333333333333333333333333333333333333333333333333
/***********************************************************************************************************/



elseif (@$_POST[FORM_HASH] == 3 && isnumeric($_POST['id']) && isnumeric($_POST['blog'])) { //pin();

    foreach ($_POST['d'] as $k => $v) {
        if (isnumeric($k) && $v) {
            if ($k == 1) {
                echo('<h1>—тартовую страницу нельз€ удалить</h1>');
                continue;
            }
            unset($_POST['d'][$k]);
            unset($_POST['v'][$k]);
            unset($_POST['f'][$k]);
            $db->query("DELETE FROM {$PRF}posts WHERE blog=$k");
        }
    }

    $v = bulk('v');
    $f = photobulk('f', false);


    $db->query("UPDATE {$PRF}vars SET val=" . a(implode("\n", $v)) . " WHERE name='blogs'");
    $db->query("UPDATE {$PRF}vars SET val=" . a(implode("\n", array_keys($v))) . " WHERE name='blog_ids'");
    $db->query("UPDATE {$PRF}vars SET val=" . a(implode("\n", $f)) . " WHERE name='blog_fons'");

    bmc_getSets();
}


/***********************************************************************************************************/
//33333333333333333333333333334444444444443333333333333333333333333333333333333333333333333333333
/***********************************************************************************************************/

if (@$_POST[FORM_HASH] == 4) { //pin();

    foreach ($_POST['d'] as $k => $v) {
        if (isnumeric($k) && $v) {
            unset($_POST['d'][$k]);
            unset($_POST['v'][$k]);
            unset($_POST['i'][$k]);
            unset($_POST['f'][$k]);
            unset($_POST['t'][$k]);
            $db->query("DELETE FROM {$PRF}photo WHERE id=$k");
        }
    }

    $v = bulk('v');
    $i = photobulk('i', true);
    $f = photobulk('f', false);
    $t = bulk('t');

    $new = array();
    $iii = 0;
    foreach ($v as $j => $a) {
        $new[] = array($j, $v[$j], $i[$j], $f[$j], $t[$j], $_POST['post'], $iii);
        $iii++;
    }

    $db->query("REPLACE INTO{$PRF}photo " . $db->sql_from_array('MULTI_REPLACE', $new, array('id', 'title', 'icon', 'fon', 'summary', 'post', 'por')));
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


elseif (@$_POST[FORM_HASH] == 2) { //pin();

    $name = array('site_title', 'site_keywords', 'site_desc', 'email', 'phone', 'vk', 'lj', 'contacts', 'def_fon', 'inline');
    $type = array(0, 0, 0, 0, 0, 0, 0, 1, 2, 3);

    $str = 'REPLACE INTO {$PRF}vars (name, val) VALUES';

    foreach ($name as $i => $n) {
        switch ($type[$i]) {
            case 1:
                $temp = htmlspecialchars_decode($_POST[$n]);
                break;
            case 2:
                include_once A_HOME . 'upload_pic.php';
                $temp = myurlencode(up_pic($n, '', '', 'kartiny/', $bmc_vars['x'], $bmc_vars['y']));
                break;
            default:
                $temp = @htmlspecialchars(htmlspecialchars_decode($_POST[$n])); //@ for checkboxes
                break;
        }
        $str .= '(' . a($n) . ', ' . a($temp) . '),\n';
    }
    $str .= "('zahlushka', '')"; //this can be done usin' implode

    $db->query($str);

    bmc_getSets();

}


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


elseif (isnumeric($_GET['up']) || isnumeric($_GET['down'])) { //pin();

    $sign = (@$_GET['up']) ? '<' : '>';
    $order = (@$_GET['up']) ? 'DESC' : 'ASC';
    $fallback = (@$_GET['up']) ? 'MAX(por)' : 'MIN(por)';

    $id1 = intval(@$_GET['up']) + intval(@$_GET['down']);

    $row_id1 = $db->query("SELECT blog, por FROM {$PRF}posts WHERE id=$id1", false);
    if ($row_id1) {
        $blog = $row_id1['blog'];
        $por1 = $row_id1['por'];

        $row2change = $db->query("SELECT id, por FROM {$PRF}posts WHERE(por $sign $por1 AND blog = $blog) ORDER BY por $order LIMIT 1", false);
        if (!$row2change) {
            $row2change = $db->query("SELECT id, por FROM {$PRF}posts WHERE(por = (SELECT $fallback FROM {$PRF}posts WHERE blog = $blog) AND blog = $blog) LIMIT 1", false);
        }

        if ($row2change) {
            $id2 = $row2change['id'];
            $por2 = $row2change['por'];

            $db->query("UPDATE {$PRF}posts SET por = $por2 WHERE id = $id1");
            $db->query("UPDATE {$PRF}posts SET por = $por1 WHERE id = $id2");

        }
    }

}


elseif (isnumeric($_GET['del'])) { //pin();

    if ($_GET['del'] == 205) {
        die('Ёта страница €вл€етс€ стартовой. ¬ы не можете удалить ее');
    }

    $db->query("DELETE FROM {$PRF}posts WHERE id = " . a($_GET['del']));

    $db->query("DELETE FROM {$PRF}photo WHERE post = " . a($_GET['del']));

}


elseif (isnumeric($_GET['id']) && $_GET['id'] == 0 && isnumeric($_GET['blog'])) { //pin(); id = -1 ????

    $por = (int) $db->evaluate("SELECT MAX(por) FROM {$PRF}posts WHERE blog = ".a($_GET['blog']) ) + 1;//blog?//0?

			$gal = in_array($_GET['blog'], array(1, 4, 5));


			$db->query("INSERT INTO {$PRF}posts SET
				blog = ".a($_GET['blog']).",
				por = '$por',
				date = '$time',
				gallery = '$gal',
				ok = false
			");

			$_GET['id'] = $db->evaluate('SELECT LAST_INSERT_ID()');

}

//OPZIYA PO4ISTIT SAJT


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////





include A_ROOT . 'editor/header.php';

//-------------------------
if (isnumeric($_GET['gallery'])) {
    include A_ROOT . 'editor/four.php';
}
elseif (isnumeric($_GET['id'])) {
    include A_ROOT . 'editor/one.php';
}
elseif (isset($_GET['subject']) && ($_GET['subject'] == 'other')) {
    include A_ROOT . 'editor/two.php';
}
elseif (isset($_GET['subject']) && ($_GET['subject'] == 'menu')) {
    include A_ROOT . 'editor/three.php';
}
else {
    include A_ROOT . 'editor/zero.php';
}
//-------------------------

include A_ROOT . 'editor/footer.php';




?>