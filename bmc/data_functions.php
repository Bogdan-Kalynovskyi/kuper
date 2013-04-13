<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


// ====================================================================================================
function sql_from_post ($query, $fields_ary, $table) {
    global $db, $bmc_vars;


    $res = array(); // sql
    foreach ($fields_ary as $key => $el) {


        switch ($el) {
            case 'date':
            case 'time':
                $res[$key] = time();
                break;


            case 'login':
                $res[$key] = @trim(preg_replace('/[^a-zA-Z0-9_\-\s]/', '_', $_POST[$key])); //error if !
                break;


            case 'password':
                $res[$key] = @md5($_POST[$key]); //error if !
                break;


            /*case 'textarea':
                $res[$key] = @str_replace("\n", '<br>', htmlspecialchars($_POST[$key]));
                break;*/


            case 'picture':
                if (isset($_FILES[$key]) && (!$_FILES[$key]['error'])) {
                    include_once A_HOME . "upload_pic.php";
                    $x = $bmc_vars['big_x'];
                    $y = $bmc_vars['big_y'];
                    $res[$key] = @htmlspecialchars(up_pic($key, '', '', 'upload/', $x, $y)) or error_msg('Error uploading picture');

                    if ($res[$key]) {
                        include_once A_HOME . "image.class.php";

                        $img = new Zubrag_image;
                        $img->max_x = $bmc_vars['th_x'];
                        $img->max_y = $bmc_vars['th_y'];
                        $img->GenerateThumbFile($res[$key], A_ROOT . 'thumbs/' . basename($res[$key]));
                        $_POST[$key . '__no'] = true; //unlink old file
                    }
                }
                break;


            case 'file':
                if (isset($_FILES[$key]) && !$_FILES[$key]['error']) {
                    include_once A_HOME . "upload_pic.php";
                    $res[$key] = @htmlspecialchars(up_file($key, 'upload/')) or error_msg('Error uploading file');

                    $_POST[$key . '__no'] = true; //unlink old file
                    $res['atname'] = @htmlspecialchars($_FILES[$key]['name']);
                }
                break;


            default:
                $res[$key] = @htmlspecialchars($_POST[$key]);
        }


////////////////////		
        if (($el == 'picture' || $el == 'file') && isset($_POST[$key . '__no'])) {
            if (!isset($res[$key])) {
                $res[$key] = '';
            }
            $fl = @$db->evaluate("SELECT $key FROM " . PRF . "$table WHERE id=" . a($_POST['id']) /*id is shit*/);
            if ($fl) {
                unlink(A_ROOT . htmlspecialchars_decode($fl));
            }
        }
//////////////////


    }

    return $db->sql_from_array($query, $res);
}


// ====================================================================================================
function Required_and_Unique () {
    global $fields, $required, $unique, $table;
    global $db;


    foreach ($required as $r) {
        switch ($fields[$r]) {

            case 'integer':
                if (!isnumeric($_POST[$r])) {
                    error_msg("Please insert a number - <b>$r</b>: {$_POST[$r]}");
                }
                break;

            case 'login':
                if (preg_match("/[^a-zA-Z0-9_\-\s]/", $_POST[$r]) || strlen($_POST[$r]) < 3) {
                    error_msg("Login should contain alphanumeric characters only and be minimum 2 symbols long - <b>$r</b>: {$_POST[$r]}");
                }
                break;

            case 'textarea':
                if (!isset($_POST[$r]) || empty($_POST[$r])) {
                    error_msg("Please fill the field - <b>$r</b>: {$_POST[$r]}");
                }
                break;

            case 'password':
                if (strlen($_POST[$r]) < 6) {
                    error_msg('Too short password, 6 chars mimimum');
                }
                if ($_POST[$r] != $_POST['pass1']) {
                    error_msg('Passwords do not match');
                }
                break;

            default:
                if (isempty($_POST[$r])) {
                    error_msg("This field is required - <b>$r</b>: {$_POST[$r]}");
                }
        }
    }


    foreach ($unique as $u) {
        $a = array();
        $a[$u] = $_POST[$u];
        $sql = $db->sql_from_array('WHERE', $a, ' OR ');

        if ($db->row_count("SELECT id FROM " . PRF . "$table WHERE ($sql) AND id<>" . a($_POST['id']))) {
            error_msg("Value <b>{$_POST[$u]}</b> is not unique for field <b>$u</b>");
        }
    }

}


?>