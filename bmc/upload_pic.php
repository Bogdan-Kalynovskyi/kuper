<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}
/*
<Files ScriptThatReceivesUploads.php>
CharsetDisable On
</Files>
*/
function valid_filename ($str) {
    $reserved = preg_quote('\\\\\/:*?"<>|', '/');
    return preg_replace("/([\\x00-\\x1f{$reserved}])/e", "_", $str);
}

function url_exists ($url) {
//create too long requests ttl
//   if(!preg_match('/(((http(s?))|(ftp))\:\/\/)/i', $url))
//    	$url = 'http://'.$url;
    $header = @get_headers($url);
    return preg_match('/^HTTP(.*)(200|301|302|303|304|307)(.*)$/i', $header[0]);
}


function my_replace_url (&$source_name) { //fo local url only
    global $MY_URL;
//якщо файл на нашому сервері, робимо з абсолютної адреси відносну// todo:www

    if (my_chop($MY_URL . '/', $source_name)) {
        return true;
    }

    /*		$MY_URL1 = $MY_URL;
            my_chop('http://',$MY_URL);
            if(strpos($MY_URL, 'www.') !== 0)$MY_URL = 'www.'.$MY_URL;	//якщо чувак вставив шлях файл з ввв
            $r = my_chop($MY_URL, $source_name);
            $MY_URL = $MY_URL1;

            if($r)
                return true;*/

    return false;
}


function my_find_path (&$source_name, $upload_dir) { //я не задоволений ц1эю процедурою


    my_chop(A_ROOT . '/', $source_name);
    $source_name = trim($source_name);


//почалася безпека
    if (strpos($source_name, '..') !== false) {
        return null;
    } //leading лидинг
    if (strpos($source_name, '//') !== false) {
        return null;
    } //leading лидинг
//	 		if(strpos($source_name, './')!== false)return null;//leading лидинг


//доробляємо відносні шляхи і їх варіанти. недотестовано.

    /*	do{
                 if(substr($source_name,0,1)=='.'){ $source_name = substr($source_name,1); $ok=false;}
                 elseif(substr($source_name,0,1)=='/'){ $source_name = substr($source_name,1); $ok=false;}
                 else $ok=true;
                        $source_name=trim($source_name);
        }while (!$ok);*/


    //можна єдинa папку загрузок!!!!!!!!!
    $valid_upload_folders = array('userpics/', 'upload/', 'pics/', 'img/', 'images/', 'thumb/', 'thumbnails/', 'photos/', 'pictures/', $upload_dir); //або не закриті .htaccess
    $flag = false;
    foreach ($valid_upload_folders as $s) {
        if (strpos($source_name, $s) === 0 || strpos($source_name, '/' . $s) === 0 || strpos($source_name, './' . $s) === 0) {
            $flag = true;
            break;
        }
    }
    //самое главное


    return $flag;
}


function my_chop ($a, &$c) {
    if (strpos($c, $a) !== 0) {
        return false;
    }
    $c = trim(substr($c, strlen($a)));
    return true;

}


//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function up_pic ($name, $radio, $new_name = '', $upload_dir, $orig_x = null, $orig_y = null, $bodya = null) {

    if (substr($upload_dir, -1, 1) != '/') {
        $upload_dir .= '/';
    }
    str_replace('\\', '/', $upload_dir);
    //блять чую тут треба ше яко1сь примочки
    $max_pic_size = 100000000;
    $leadon = A_ROOT . $upload_dir;
    $local_url = false;

//$name - name of <input file> AND / OR <input text> ~/ can be used both!!!  
//input text is the prior.
//radio - name of input
//image url can be absolute or relative
//$new_name - name without(!) extension, can't hold /..
//maximum dimensions. if smaller the picture is not changed.

//RETURNS:  one or two names
//TRUE or NULL on error 
//or FALSE if new_name is incorrect


    if (noempty($new_name)) {
        if (!preg_match('/^[^./][^/]*$/', $new_name) || strpos($new_name, '..') !== false) {
            return false;
        }
        $new_name = str_replace("\0", '', $new_name);
        $new_name = valid_filename($new_name); //зразу коцаєм выдповыдно до ОС/ // а шо там з розширенням?
    }


    $supportedextentions = array('.gif', '.ico', '.png', '.jpeg', '.jpg', '.bmp' //other types
        //php security problem? chmod folder that files are not executable?
    );


////////////////////////////////////////////////////////////////////////////////////////
    if (noempty($_FILES[$name]['type'])) {

        if (isempty($_FILES[$name]['name'])) {
            return null;
        }
        if (isempty($_FILES[$name]['tmp_name'])) {
            return null;
        }
        if ($_FILES[$name]['error']) {
            return null;
        }
        //-content-type
        if ($_FILES[$name]['size'] > $max_pic_size) {
            return null;
        }

        $source_name = valid_filename($_FILES[$name]['name']);
        if (get_magic_quotes_gpc()) {
            $source_name = stripslashes($source_name);
        }

        $from_url = false;

    }

////////////////////////////////////////////////////////////////////////////////////////	
    elseif (noempty($_POST[$name])) {

        $source_name = str_replace('\\', '/', htmlspecialchars_decode($_POST[$name])); //stripslashes already applied????

        if (substr($source_name, 0, 4) == 'www.') {
            $source_name = 'http://' . $source_name;
        }

        my_replace_url($source_name);


        if ((strtolower(substr($source_name, 0, 7) == 'http://')) || strtolower(substr($source_name, 0, 8) == 'https://') || strtolower(substr($source_name, 0, 6) == 'ftp://')) {

            if (!url_exists($source_name)) {
                return null;
            }
            $local_url = false;

        }
        else {

            if (!my_find_path($source_name, $upload_dir)) {
                return null;
            }
            if (!is_file(A_ROOT . /*rawurldecode*/
                ($source_name))
            ) {
                return null;
            }
            $local_url = true;

        }

        $from_url = true;

    }
    else {
        return null;
    }


    if (isempty($source_name)) {
        return '';
    } //ATTENTION, sperial return value!


    $ext = strtolower(substr($source_name, strrpos($source_name, '.'))); //strrchr ??
    if (!in_array($ext, $supportedextentions)) {
        return null;
    }


//*********************** CHECK DOWN ONCE MORE  *******************
//переыменовуэмо

    if (noempty($new_name)) {
        $target_name = $new_name . $ext;
    }
    else {
        $target_name = valid_filename(basename($source_name));
    }

    if (isempty($target_name)) {
        return '';
    }


//f2-source with path. файл починаэ закачуватись тут
////////////////////////////////////////////////////////////////////////////    

    if ($from_url) {

        if ($local_url) {
            $f2 = A_ROOT . $source_name;
        }
        else {
            $f2 = $source_name;
        }


        if (noempty($new_name)) {

            $f3 = $leadon . $target_name;
            if (is_file($f3)) {
                $f3 = $leadon . uuidv4() . $target_name;
            }

            if (!copy($f2, $f3)) {
                return null;
            }
            if (filesize($f3) > $max_pic_size) {
                unlink($f3);
                return null;
            }

            $f2 = $f3;
        }


    }
    else {

        $f2 = $leadon . $target_name;
        if (is_file($f2)) {
            $f2 = $leadon . uuidv4() . $target_name;
        }

        if (!move_uploaded_file($_FILES[$name]['tmp_name'], $f2)) {
            return null;
        }

    }


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    if ($bodya && $local_url && 'photos/' . basename($f2) == $f2 && is_file('thumb/' . basename($f2)) && is_file('fullsize/' . basename($f2))) {
        return $f2;
    }
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


/////////////////////////////////////////////////////////////////

    $max_x = (isnumeric($orig_x) && $orig_x > 0 && $orig_x < 1200) ? $orig_x : 1200;
    $max_y = (isnumeric($orig_y) && $orig_y > 0 && $orig_y < 800) ? $orig_y : 800;

    list($orig_x, $orig_y, $orig_img_type) = @getimagesize($f2);
    //тут дира в безпеці!!файл-то вже закачаний!скр1пт може вилет1ти цьому м1сц1!{aле розширення не пхп}///механ1зм транзакц1й

    if (!isset($orig_img_type) || !(($orig_img_type > 0 && $orig_img_type < 4) || $orig_img_type == 6)) {
        unlink($f2);
        return null;
    }


    if (($orig_x > $max_x || $orig_y > $max_y) && !$local_url) {
//################################# /thumbs/ #############################################

        include_once A_HOME . "image.class.php";

        $f3 = $leadon . 'resize_' . valid_filename(basename($f2));
        if (is_file($f3)) {
            $f3 = $leadon . 'resize_' . uuidv4() . valid_filename(basename($f2));
        }


        $img = new Zubrag_image;
        $img->max_x = $max_x;
        $img->max_y = $max_y;
        $img->GenerateThumbFile($f2, $f3);
        $orig_x = $img->max_x;
        $orig_y = $img->max_y;

        @unlink($f2); //you cannot unlink an url
        if (!@rename($f3, $f2)) {
            $f2 = $f3;
        }

//###########################################################################################   		
    }


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

    if ($bodya) {
        global $bmc_vars;
        include_once A_HOME . "image.class.php";
        $img = new Zubrag_image;

        $f3 = A_ROOT . 'photos/' . basename($f2);
        $img->max_x = $bmc_vars['x'];
        $img->max_y = $bmc_vars['y'];
        $img->GenerateThumbFile($f2, $f3);

        $f3 = A_ROOT . 'thumb/' . basename($f2);
        $img->max_x = $bmc_vars['thumb_x'];
        $img->max_y = $bmc_vars['thumb_y'];
        $img->GenerateThumbFile($f2, $f3);

        return 'photos/' . basename($f2);
    }

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


//print_r(getimagesize($f2));

    my_chop(A_ROOT, $f2);

    return $f2;
}


function up_file ($name, $upload_dir) {
    $max_pic_size = 10000000;
    if (substr($upload_dir, -1, 1) != '/') {
        $upload_dir .= '/';
    }
    str_replace('\\', '/', $upload_dir);


/////////////////////////////////////
    $leadon = A_ROOT . $upload_dir;
/////////////////////////////////////


    $UNsupportedextentions = array('.php', '.asp', '.pl');


//source_name
    if (isset($_FILES[$name])) /*мусить бути якась додаткова перев1рка*/ {

        //перечитати загрузку
        if (isempty($_FILES[$name]['name'])) {
            return null;
        }
        if (isempty($_FILES[$name]['tmp_name'])) {
            return null;
        }
        if ($_FILES[$name]['error']) {
            return null;
        }
        //-content-type
        if ($_FILES[$name]['size'] > $max_pic_size) {
            return null;
        }

        $source_name = valid_filename($_FILES[$name]['name']);
        if (get_magic_quotes_gpc()) {
            $source_name = stripslashes($source_name);
        }


    }
    else {
        return null;
    }


    if (isempty($source_name)) {
        return '';
    }


    $ext = strtolower(substr($source_name, strrpos($source_name, '.'))); //strrchr ??
    if (in_array($ext, $UNsupportedextentions)) {
        return null;
    }


    $target_name = md5(mt_rand(0, 1000000000)) . $ext;


    $f2 = $leadon . $target_name;

    if (is_file($f2)) {
        $f2 = $leadon . uuidv4() . $target_name;
    }

    if (!move_uploaded_file($_FILES[$name]['tmp_name'], $f2)) {
        return null;
    }


    my_chop(A_ROOT, $f2);

    return $f2;

}

?>