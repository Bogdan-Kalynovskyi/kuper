<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


function quotes ($s) {
    return str_replace('"', '\"', $s);
    //return htmlspecialchars($s);
}

function recursive_hidden ($err) {
    foreach ($err as $key => $p) {
        if (is_array($p)) {
            recursive_hidden($p);
        }
        elseif (substr($key, 0, 3) != 'wp_') {
            echo '<input type="hidden" name="' . quotes($key) . '" value="' . quotes($p) . '" />';
        }
        //expires

    }
}

function restore_all_data () {
//	recursive_hidden($_GET);
    recursive_hidden($_POST);
//	recursive_hidden($_FILES);
//	recursive_hidden($_COOKIE);
}


function bad_cap ($force_captcha = false, $not_silent_check = false) {
    global $user_message;

    if (!$force_captcha && !log_bad_ip($not_silent_check, $_POST['wp_user_login'])) {
        return false;
    }


    @session_start();


//////////////////////////////////////////////////


    if (isempty($_POST['wp_keystring'])) {
        return $user_message[] = 'Please enter verification code';
    }
    $_POST['wp_keystring'] = str_replace(' ', '', $_POST['wp_keystring']);

    if (strlen($_POST['wp_keystring']) < 5) {
        return $user_message[] = 'Verification code too short...';
    }

    if (isempty($_SESSION['captcha_keystring'])) {
        return $user_message[] = 'Please turn on cookies!';
    }


    if (strtolower($_SESSION['captcha_keystring']) == strtolower($_POST['wp_keystring'])) {
        return false;
    }

    return $user_message[] = 'Wrong verification code...';

}

////////////////////////////////////////////////////////////////////////////


function log_bad_ip ($NOT_silent = false, $login_name = '') {
    global $db, /*$user_message,*/
           $do_cap;

//////////////////////////////////////////////////////////
////////////////////////////////////////////


    if (isset($do_cap) && $do_cap) {
        return true;
    }


    $num_alowed = 50; //!
    $num_atack = 300;


    include_once A_HOME . 'ip_fun.php';
    $_ip = a(ip2long(get_real_ip()));
    $login_name = strtolower($login_name);


    $db->query("DELETE FROM " . PRF . "log WHERE time <'" . (time() - 15 * 60) . "'");
    $sum = $db->evaluate("SELECT num FROM " . PRF . "log WHERE ip=$_ip");

    if ($login_name) {
        $db->query("DELETE FROM " . PRF . "log1 WHERE time <'" . (time() - 15 * 60) . "'");
        $num = $db->evaluate("SELECT num FROM " . PRF . "log1 WHERE login=" . a($login_name));
    }
    else {
        $num = 0;
    }

    $ups = $num * 10 + $sum;


///////////////////////////////////
    if ($NOT_silent) { //!
        if ($sum) {
            $db->query("UPDATE " . PRF . "log SET
					num = num+1, time= '" . time() . "'
					WHERE ip=$_ip");
        }
        else {
            $db->query("INSERT INTO " . PRF . "log
					(ip, time, num) VALUES
					($_ip, '" . time() . "', '1')");
        }


        if ($login_name) {
            if ($num) {
                $db->query("UPDATE " . PRF . "log1 SET
						num = num+1, time= '" . time() . "'
						WHERE login=" . a($login_name));
            }
            else {
                $db->query("INSERT INTO " . PRF . "log1
						(login, time, num) VALUES
						(" . a($login_name) . ", '" . time() . "', '1')");
            }
        }
    }
//////////////////////////////


    /*ups*/
    if ($ups) { /////////////////////////////

        if ($ups < $num_alowed) {
            return ($do_cap = false);
        }

        elseif ($ups > $num_atack) //,,kZблять по логыну ы айпышцы дивися!
        {
            die('Too many login attempts from your ip (300 per 15 minutes).<br> Please be patient and wait 15 minutes or contact me mybodya@gmail.com ! ');
        }

        else {
            @session_start();
            return ($do_cap = true);
        }


        /*ups*/
    }


    return ($do_cap = false);
}


function show_cap ($force_captcha = false) {
    global $do_cap;

    if (!$force_captcha) {
        log_bad_ip();
    }

    @session_start();

    if ($do_cap || $force_captcha) {
        echo '
<p>
	<div style="text-align:center">
		<img id="kcaptcha" src="kcaptcha/?' . session_name() . '=' . session_id() . '" width="150" height="70" border="0" alt="ERROR, image not loaded! Turn on images or try to reload the page!" title="Leters and numbers" />
		<div style="cursor:pointer;color:#55f;width:100%;position:relative;top:1px;margin-bottom:2px"
		title="reload the code if you can\'t read it" onclick="captcha_reload()">Reload</div>
	</div>

	<label>Verification code<br/>
	<input name="wp_keystring" id="keystring" class="input" value="" size="20" tabindex="50" />
	</label>
</p>';
    }
}


function show_cap1 ($force_captcha = false) {
    global $do_cap;

    if (!$force_captcha) {
        log_bad_ip();
    }

    @session_start();

    if ($do_cap || $force_captcha) {
        echo '

	<div style="text-align:center;width:400px;margin-left:212px">
		<img id="kcaptcha" src="kcaptcha/?' . session_name() . '=' . session_id() . '" width="300" height="70" border="0" alt="Секретный код не загрузился" title="Цифры и буквы" /><img style="cursor:pointer;position:relative;left:-24px;float:right;top:30px" src="img/reload.png" alt="перегрузить код" title="сменить код, если он трудно читаем" onclick="captcha_reload()" />
	</div>

	<label>Код на рисунке<br/>
	<input name="wp_keystring" id="keystring" class="input" value="" size="20" tabindex="50" />
	</label>
';
    }
}


function show_cap_js ($force_captcha = false) {
    global $do_cap;

    if (!$force_captcha) {
        log_bad_ip();
    }


    if ($do_cap || $force_captcha) {
        echo "
		var ks = document.getElementById('keystring');
		if(ks !== null && ks !== 'undefined'){
		try{
			if(ks.value === '') {
				ks.focus();
				err[10] = 'Please enter the code that you see on the image';
			}else if(ks.value.length < 5) {
				ks.focus();
				err[11] = 'You have not entered all the symbols from the image';
			}
		}catch(e){}
		}
	";
    }
}

function show_cap_js1 ($force_captcha = false) {
    global $do_cap;

    if (!$force_captcha) {
        log_bad_ip();
    }


    if ($do_cap || $force_captcha) {
        echo "
 	function captcha_reload(){
		try{
 		document.getElementById('kcaptcha').src='kcaptcha/?" . session_name() . "=' + Math.round(100000000 * Math.random());//add symbols todo
		}catch(e){}
 	}";
    }
}


function show_ms () {
    global $user_message;

    if (isset($user_message) && is_array($user_message)) {
        echo '<p id="login_error" class="bold_red">' . implode('<br/>', $user_message) . '</p>';
    }

}

?>
