<?php
error_reporting(E_ALL - E_NOTICE);
if (isset($_REQUEST[session_name()])) {
    session_start();
    if (sin(session_id()) != $_SESSION['fuck']) {
        die('Access Denied!');
    }
}
else {
    die('Access Denied!');
}

clearstatcache();

////#######################################################################

$imagebasedir = '../files';
$imagebaseurl = 'files';


$browsedirs = true;
$overwrite = true;

$f = 'file'; //the name of [input type file] in the form


$supportedextentions = array('gif', 'png', 'jpeg', 'jpg', 'bmp');

$filetypes = array('png' => 'jpg.gif', 'jpeg' => 'jpg.gif', 'bmp' => 'jpg.gif', 'jpg' => 'jpg.gif', 'gif' => 'gif.gif', 'psd' => 'psd.gif', 'rar' => 'rar.gif', 'zip' => 'rar.gif', 'gz' => 'rar.gif', 'pdf' => 'pdf.gif', 'doc' => 'doc.gif', 'xls' => 'xls.gif', 'ppt' => 'ppt.gif', 'txt' => 'doc.gif', 'csv' => 'xls.gif',);


$allowuploads = (bool)ini_get('file_uploads');
$phpmaxsize = ini_get('upload_max_filesize') . 'b';
$errormsg = "( Максимальний розмір файлу: $phpmaxsize )";

//*******************************************************************************************************

$wysiwyg = $_GET['wysiwyg'];

//*******************************************************************************************************

if ((substr($imagebaseurl, -1, 1) != '/') && $imagebaseurl != '') {
    $imagebaseurl .= '/';
}
if ((substr($imagebasedir, -1, 1) != '/') && $imagebasedir != '') {
    $imagebasedir .= '/';
}


// set image dir
$startdir = $leadon = ($imagebasedir == '.') ? '' : $imagebasedir;


// validate the directory
if (isset($_REQUEST['dir'])) {
    $_GET['dir'] = $_POST['dir'] ? $_POST['dir'] : $_GET['dir'];

    if ($_GET['dir']) {
        if (substr($_GET['dir'], -1, 1) != '/') {
            $_GET['dir'] = $_GET['dir'] . '/';
        }


        $dirok = true;
        $dirnames = explode('/', $_GET['dir']);
        $dotdotdir = '';
        for ($di = 0; $di < sizeof($dirnames); $di++) {
            if ($di < (sizeof($dirnames) - 2)) {
                $dotdotdir = $dotdotdir . $dirnames[$di] . '/';
            }
        }

        if (substr($_GET['dir'], 0, 1) == '/') {
            $dirok = false;
        }

        if ($_GET['dir'] == $leadon) {
            $dirok = false;
        }

        if ($dirok) {
            $leadon = $_GET['dir'];
        }


    }


}


//*********************************************************************************************
function url_exists($fileUrl) {
    $AgetHeaders = @get_headers($fileUrl);
    if (preg_match("|200|", $AgetHeaders[0])) {
        return true;
    }
    else {
        return FALSE;
    }
}

function isempty(&$str) {
    if (!isset($str)) {
        return true;
    }
    $str = trim($str);
    return ($str == '');
}


function get_file($url) {
    global $supportedextentions, $startdir, $errormsg;

    if (isempty($url)) {
        return null;
    }

    $protocol = substr($url, 0, strpos($url, "://"));
    if (!($protocol == 'http' || $protocol == 'https' || $protocol == 'ftp')) {
        $url = $startdir . str_replace($startdir, '', $url);
        if (!file_exists($url)) {
            $errormsg = "Файл не існує - " . $url;
            return null;
        }
    }
    elseif (!url_exists($url)) {
        $errormsg = "URL не існує - " . $url;
        return null;
    }

    $ext = strtolower(substr($url, strrpos($url, '.') + 1));
    if (!in_array($ext, $supportedextentions)) {
        $errormsg = "Не підтримується розширення - " . $ext;
        return null;
    }

    return $url;
}


function upload_file($img = false, $slideshow = false) {
    global $supportedextentions, $leadon, $errormsg, $f;

    if (!isset($_FILES[$f]) || isempty($_FILES[$f]['name']) || isempty($_FILES[$f]['tmp_name']) || ($_FILES[$f]['error'])) {
        if ($_FILES[$f]['error']) {
            $errormsg = "Помилка завантаження";
        }
        return null;
    }


    $f2 = $leadon . $_FILES[$f]['name'];
    $path_parts = pathinfo($f2); //ne potribno. mozna basename
    $ext = strtolower($path_parts['extension']);

    if ($img && !in_array($ext, $supportedextentions)) {
        $errormsg = "Не підтримується розширення - " . $ext;
        return null;
    }

    if (file_exists($f2)) {
        $a = $path_parts['filename'];
        $path_parts['filename'] .= mt_rand(0, 10000);
        $errormsg = "Файл " . $a . " вже існуе. Новий файл доданий під іменем " . $path_parts['filename'];
    }

    $f2 = $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $path_parts['extension'];


//echo $f2;// die;
    $f1 = $_FILES[$f]['tmp_name'];

    move_uploaded_file($f1, $f2);

    return $f2;
}


?>