<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


//**************************************************************************
//**************************************************************************
//**************************************************************************


function bmc_wordwrap ($str, $width = 60, $break = "\n", $nobreak = "") {
    // Split HTML content into an array delimited by < and >
    // The flags save the delimeters and remove empty variables
    $content = preg_split("/([<>])/", $str, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    // Transform protected element lists into arrays
    $nobreak = explode(" ", strtolower($nobreak));

    // Variable setup
    $intag = false;
    $innbk = array();
    $drain = "";

    // List of characters it is "safe" to insert line-breaks at
    // It is not necessary to add < and > as they are automatically implied
    $lbrks = "/?!%(|)-]\\\"':;&.,";

    // Is $str a UTF8 string?
    $utf8 = (preg_match("/^([\x09\x0A\x0D\x20-\x7E]|[\xC2-\xDF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|\xED[\x80-\x9F][\x80-\xBF]|\xF0[\x90-\xBF][\x80-\xBF]{2}|[\xF1-\xF3][\x80-\xBF]{3}|\xF4[\x80-\x8F][\x80-\xBF]{2})*$/", $str)) ? "u" : "";

    while (list(, $value) = each($content)) {
        switch ($value) {

            // If a < is encountered, set the "in-tag" flag
            case "<":
                $intag = true;
                break;

            // If a > is encountered, remove the flag
            case ">":
                $intag = false;
                break;

            default:

                // If we are currently within a tag...
                if ($intag) {

                    // Create a lowercase copy of this tag's contents
                    $lvalue = strtolower($value);

                    // If the first character is not a / then this is an opening tag
                    if ($lvalue{0} != "/") {

                        // Collect the tag name
                        preg_match("/^(\w*?)(\s|$)/", $lvalue, $t);

                        // If this is a protected element, activate the associated protection flag
                        if (in_array($t[1], $nobreak)) {
                            array_unshift($innbk, $t[1]);
                        }

                        // Otherwise this is a closing tag
                    }
                    else {

                        // If this is a closing tag for a protected element, unset the flag
                        if (in_array(substr($lvalue, 1), $nobreak)) {
                            reset($innbk);
                            while (list($key, $tag) = each($innbk)) {
                                if (substr($lvalue, 1) == $tag) {
                                    unset($innbk[$key]);
                                    break;
                                }
                            }
                            $innbk = array_values($innbk);
                        }
                    }

                    // Else if we're outside any tags...
                }
                else if ($value) {

                    // If unprotected...
                    if (!count($innbk)) {

                        // Use the ACK (006) ASCII symbol to replace all HTML entities temporarily
                        $value = str_replace("\x06", "", $value);
                        preg_match_all("/&([a-z\d]{2,7}|#\d{2,5});/i", $value, $ents);
                        $value = preg_replace("/&([a-z\d]{2,7}|#\d{2,5});/i", "\x06", $value);

                        // Enter the line-break loop
                        do {
                            $store = $value;

                            // Find the first stretch of characters over the $width limit
                            if (preg_match("/^(.*?\s)?([^\s]{" . $width . "})(?!(" . preg_quote($break, "/") . "|\s))(.*)$/s{$utf8}", $value, $match)) {

                                if (strlen($match[2])) {
                                    // Determine the last "safe line-break" character within this match
                                    for ($x = 0, $ledge = 0; $x < strlen($lbrks); $x++) {
                                        $ledge = max($ledge, strrpos($match[2], $lbrks{$x}));
                                    }
                                    if (!$ledge) {
                                        $ledge = strlen($match[2]) - 1;
                                    }

                                    // Insert the modified string
                                    $value = $match[1] . substr($match[2], 0, $ledge + 1) . $break . substr($match[2], $ledge + 1) . $match[4];
                                }
                            }

                            // Loop while overlimit strings are still being found
                        } while ($store != $value);

                        // Put captured HTML entities back into the string
                        foreach ($ents[0] as $ent) {
                            $value = preg_replace("/\x06/", $ent, $value, 1);
                        }
                    }
                }
        }

        // Send the modified segment down the drain
        $drain .= $value;
    }

    // Return contents of the drain
    return $drain;
}


//----------------------------------------------------------------------------------------------------

function blog_view_list () {
    global $_bl;
    if (!isset($_bl)) {
        global $lll, $BLOGS;
        foreach ($BLOGS as $i_blog) {
            if (!(($lll < 2) && $i_blog['frozen'])) {
                $_bl[] = $i_blog['id'];
            }
        }
    }

    return $_bl;
}


function blog_no_view_list () {
    global $_bl1;
    if (!isset($_bl1)) {
        global $lll, $BLOGS;
        foreach ($BLOGS as $i_blog) {
            if (($lll < 2) && $i_blog['frozen']) {
                $_bl1[] = $i_blog['id'];
            }
        }
    }

    return $_bl1;
}


function post_view_sql ($show_hidden = false, $show_password = false) {
    global $lll;
    $SQL = '';


    if (defined('BLOG')) //was checked earlier
    {
        $SQL = " blog ='" . BLOG . "'";
    }

    elseif (!IS_ADMIN) { //bodya use NOT!!!!!!instead of OR

        $mya = blog_no_view_list();
        if ($mya) {
            $SQL .= "(blog <> {$mya[0]}";
            for ($i = 1; $i < count($mya); $i++) {
                $SQL .= " AND blog <> {$mya[$i]}";
            }
            $SQL .= ")";
        }
        //else{			$SQL = " AND 0";		}
    }

    $SQL .= " AND status='1' ";
    if (!$show_hidden && !IS_ADMIN) {
        $SQL .= " AND access <= '$lll' ";
    }
    if (!$show_password) {
        $SQL .= " AND password = '0' ";
    }


    if (strpos($SQL, ' AND') === 0) {
        $SQL = substr($SQL, 4);
    }
    //bodya not fast

    return $SQL;
}


function post_edit_sql ($user) {
    $SQL = '';

    if (defined('BLOG')) {
        $SQL .= " AND blog ='" . BLOG . "'";
    }

    elseif (!IS_ADMIN) { //2

        $mya = blog_edit_list($user);
        if ($mya) {
            $SQL .= "(blog = {$mya[0]['id']}";
            for ($i = 1; $i < count($mya); $i++) {
                $SQL .= " OR blog = {$mya[$i]['id']}";
            }
            $SQL .= ")";
        }
        else {
            $SQL = " AND 0";
        }
    }


    $SQL .= " AND password >= '0' ";

    if (strpos($SQL, ' AND') === 0) {
        $SQL = substr($SQL, 4);
    }
    //bodya not fast

    return $SQL;
}


function blog_edit_list ($user) {
    return $BLOGS;
}


//-----------------------------------------------------------------------------------------------------
function get_all_cats () {
    global $db;

    $data_db = $db->query("SELECT * FROM " . MY_PRF . "cats");
    foreach ($data_db as $d) {
        $data[$d['id']] = $d['cat_name'];
    }


    if (isset($data)) {
        return $data;
    }
}


function get_cats ($blog = BLOG, $id_only = false, $restart = false) {
    global $BLOGS;

    static $data = null;
    if (!$data || $restart) {
        $data = get_all_cats();
    }

    $x = $BLOGS[$blog]['cats'];
    $arr = ($x) ? explode(',', $x) : array();

    //print_r($data);die;
    $result = array();
    if (!$id_only) {
        foreach ($arr as $a) {
            if (isset($data[$a])) //perevirka na isnuvannja
            {
                $result[$a] = $data[$a];
            }
        }
    }
    else {
        foreach ($arr as $a) {
            if (isset($data[$a])) //perevirka na isnuvannja
            {
                $result[$a] = $a;
            }
        }
    }
    return $result;
}


//-----------------------------------------------------------------------------------------------------

function echoip ($ip) { //bodya add difference metween cities
    global $lang;
    return <<<EOF
<a target="{$lang['geo_ip']}" title ="{$lang['geo_ip']}" onclick = "popWin('http://smart-ip.net/_res/script/tools/geoip.php?lang=ru&amp;ip=$ip')">($ip)</a>
EOF;
}

?>