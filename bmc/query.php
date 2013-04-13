<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}
/*		
function get_nieghbours($id, &$prev=null, &$next=null){//bodya optimize
global $db;	$limit = '';

	$q = get_query($limit, $limit, false, $page_title,true);
	$data = $db->query("SELECT id FROM ".MY_PRF."posts WHERE $q");
	foreach($data as $x => $y)
		if($y['id'] == $id) break;// print_r($data);die($x.'aa');
	//if($x === false) return;//die($x.'aa');
	if($x > 0) $prev = $data[$x-1]['id'];
	if($x < count($data)-1) $next = $data[$x+1]['id'];
}
*/
function get_nieghbours (&$POOO, &$prev = null, &$next = null) { //bodya optimize
    global $db;
    $q_s = 'sort=none';

//bodya fuck
    $q = get_query($q_s, $limit, false, $page_title, true);
    $data1 = $db->query("SELECT id FROM " . MY_PRF . "posts WHERE date < {$POOO['date']} AND $q ORDER BY DATE DESC LIMIT 1");
    $data2 = $db->query("SELECT id FROM " . MY_PRF . "posts WHERE date > {$POOO['date']} AND $q ORDER BY DATE ASC LIMIT 1");
    $prev = $data1[0]['id'];
    $next = $data2[0]['id'];
}


function get_query (&$URI, &$SQL2, $to_edit = true, &$page_title = null, $show_hidden = false, $show_password = false) { //page title is a very good way to do....
    global $bmc_vars, $USER;
// увага! зараз є 3 шляхи з яких ми отримуємо дані -REQUEST, URI(zminna) і спеціальні hidden поля sort, desc, qury_string.  

    $query_str = (isset($_POST['query_str'])) ? $_POST['query_str'] : '';
    $URI = $query_str . '&' . $URI; //query_str практичто уже ввійшла в стандарт по передачі даних між сторінками

    parse_str( /*urldecode(*/
        $URI, $URI);
    $_RE = $_REQUEST;

    foreach ($URI as $k => $r) {
        $_RE[$k] = $r;
    }

    add_real_escape($_RE);

//print_r($_RE);
//Це все нарешті запизається в _RE !!!!!!!!!!!

    $SQL = "";
    $URI = "";

///////////////////////////////security/////////////////////////////////////////////////////////////////

    if ($to_edit) {
        $SQL .= ' AND' . post_edit_sql($USER);
    }
    else {
        $SQL .= ' AND' . post_view_sql($show_hidden, $show_password);
    }

    if (defined('BLOG')) {
        $URI .= "&blog=" . BLOG;
    }


///////////////////////////////////////////day//////////////////////////////////////////////////////////////////////
    $_day = (isset($_RE['day'])) ? bmc_Time($_RE['day']) : '';
    if ($_day) {
        $SQL .= " AND date <= '" . ($_day + 3600 * 24) . "' AND date >= '$_day'";
        $URI .= "&day=" . $_RE['day'];

        //echo bmc_Date($_day); die;

    }


///////////////////////////////////////////date crop////////////////////////////////////////////////////////////////////////
    $_range = (isset($_RE['range'])) ? trim($_RE['range']) : '';

    switch ($_range) {

        case 'this_week':
            $SQL .= " AND date >= " . (time() - 604800);
            $URI .= "&range=this_week";
            break;


        case 'this_month':
            $SQL .= " AND date >= " . (time() - 2592000);
            $URI .= "&range=this_month";
            break;


        case 'last_month':
            $SQL .= " AND date <= " . (time() - 2592000) . " AND date >= " . (time() - 5184000);
            $URI .= "&range=last_month";
            break;


        case 'last_six':
            $SQL .= " AND date <= " . (time() - 5184000) . " AND date >= " . (time() - 31104000);
            $URI .= "&range=last_six";
            break;


        case 'last_year':
            $SQL .= " AND date <= " . (time() - 31104000);
            $URI .= "&range=lat_year";
            break;
    }


/////////////////////////////cat/////////////////////////////////////////////////////////////////////

    if (isnumeric($_RE['cat'])) { //bodya check!!!!blin!!!
        $SQL .= " AND cat = '{$_RE['cat']}' ";
        $URI .= "&cat=" . $_RE['cat'];
    }

//!!!!!!!!!!!!!!


/////////////////////////////archive////////////////////////////////////////////////////////////////////

    if (noempty($_RE['archive']) && strlen($_RE['archive']) < 11 && strlen($_RE['archive']) > 6) {

        list($d_day, $d_month, $d_year) = explode(",", $_RE['archive']);

        if (isnumeric($d_month) && isnumeric($d_year)) {

            if (isnumeric($d_day)) {
                $start_time = mktime(0, 0, 0, $d_month, $d_day, $d_year);
                $end_time = mktime(0, 0, 0, $d_month, $d_day + 1, $d_year);
                $page_title .= " :: " . bmc_Date($start_time, "d M Y"); // Day/Month/Year
            }
            else {
                $start_time = mktime(0, 0, 0, $d_month, 1, $d_year);
                $end_time = mktime(0, 0, 0, ($d_month + 1), 1, $d_year);
                $page_title .= " :: " . bmc_Date($start_time, "M Y"); // Month/Year
            }
            $URI .= "&archive=" . $_RE['archive'];
            $SQL .= " AND date >= '{$start_time}' AND date <= '{$end_time}'";
        }
    }


/////////////////////////////sort/////////////////////////////////////////////////////////////////////


    $_sort = (isset($_RE['sort'])) ? trim($_RE['sort']) : '';
    $_desc = (isset($_RE['desc'])) ? trim($_RE['desc']) : '';


    switch ($_sort) {
        case 'rel':
            $SQL .= " ORDER by rel ";
            $URI .= "&sort=rel";
            break;

        case 'title':
            $SQL .= " ORDER by title ";
            $URI .= "&sort=title";
            break;

        case 'date':
            $SQL .= " ORDER by date ";
            $URI .= "&sort=date";
            break;

        case 'blog':
            $SQL .= " ORDER by blog ";
            $URI .= "&sort=blog";
            break;

        case 'state':
            $SQL .= " ORDER by status ";
            $URI .= "&sort=state";
            break;

        case 'author':
            $SQL .= " ORDER by author ";
            $URI .= "&sort=author";
            break;
        case 'access':
            $SQL .= " ORDER by access ";
            $URI .= "&sort=access";
            break;
        case 'cat':
            $SQL .= " ORDER by cat ";
            $URI .= "&sort=cat";
            break;
        case 'rel':
            $SQL .= " ORDER by rel ";
            $URI .= "&sort=access";
            break;
        case 'none':
            break;

        default:
            $SQL .= " ORDER by date ";
            if (!$_desc) {
                $SQL .= " DESC ";
            }
    }


    if ($_desc) { //---------------------------------------//---------------------------------------
        $SQL .= " DESC ";
        $URI .= "&desc=true";
    }


//echo $SQL;die;


/////////////////////////////////////pages////////////////////////////////////////////////////////////////////////


    $_page = (isnumeric($_RE['page'])) ? ($_RE['page'] - 1) : 0;
    if (isnumeric($_RE['pp'])) {
        $bmc_vars['p_page'] = $_RE['pp'];
    }
    $old_pp = (isnumeric($_RE['old_pp'])) ? $_RE['old_pp'] : $bmc_vars['p_page'];

    $_page = (int) ($_page * $old_pp / $bmc_vars['p_page']);
//	if($_page>$bmc_vars['total';]) IMPORTANT!!!!!!

    $_REQUEST['page'] = $_page + 1; //bodya bmc_vars//bodya bad
    $start = ($_page * $bmc_vars['p_page']);
    $SQL2 = "LIMIT $start, {$bmc_vars['p_page']}";
//no uri	


    if (strpos($SQL, ' AND') === 0) {
        $SQL = substr($SQL, 4);
    }
    //bodya not fast

//	if(strpos($URI, '&') === 0)
//		$URI = substr($URI, 1);//bodya not fast


    return $SQL;
}

?>
