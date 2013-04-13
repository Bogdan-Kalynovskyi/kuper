<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


function restore_post_data () {
    foreach ($_POST as $key => $p) {
        if (substr($key, 0, 3) != 'wp_') {
            echo '<input type="hidden" name="' . addslashes($key) . '" value="' . addslashes($p) . '" />';
        }
    }
}

function bad_cap ($force = false) {
    global $user_message;

    if (!$force && !log_bad_ip(0)) {
        return false;
    }

    if (isempty($_POST['wp_keystring'])) {
        return $user_message = 'Please enter the verification code';
    }

    if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == strtolower($_POST['wp_keystring'])) {
        return false;
    }

    return $user_message = 'Wrong verification code';

}

////////////////////////////////////////////////////////////////////////////


function log_bad_ip ($n = -1) {
    global $db, $user_message;

    if ($n == -1) //$n
    {
        $n = !empty($user_message);
    }

    $num_alowed = 3;
    $_ip = ip2long(get_real_ip());

    $db->query("DELETE FROM " . PRF . "log WHERE time <'" . (time() - 15 * 60) . "'");
    $ups = $db->query("SELECT * FROM " . PRF . "log WHERE ip=$_ip", false);

    if ($ups) {
        if ($n) {
            $db->query("UPDATE " . PRF . "log SET
					num = num+1, time= '" . time() . "'
					WHERE ip=$_ip", false);
        }
        if (($ups['num']) < $num_alowed) {
            return false;
        }
        else {
            @session_start();
            return true;
        }


    }
    else {

        if ($n) {
            $db->query("INSERT INTO " . PRF . "log
					(ip, time, num) VALUES
					($_ip, '" . time() . "', '1')");
        }
    }

    return false;
}


function show_cap () {
    global $do_cap;
    if (!isset($do_cap)) {
        $do_cap = log_bad_ip();
    }

    if ($do_cap) {
        echo '
<p>
	<div style="text-align:center">
		<img id="kcaptcha" src="kcaptcha/?' . session_name() . '=' . session_id() . '" width="150" height="55" alt="ERROR, image not loaded" title="Leters and numbers" /> <div style="cursor:pointer;color:#55f;vertical-align:middle;line-height:55px;float:right;margin:0 10px 0 10px" onclick="captcha_reload()">Reload</div>
	</div>
	<label>
		Verification code<br/>
		<input name="wp_keystring" id="keystring" class="input" value="" size="20" tabindex="50" />
	</label>
</p>';
    }
}


function show_cap_js () {
    global $do_cap;
    if (!isset($do_cap)) {
        $do_cap = log_bad_ip();
    }

    if ($do_cap) {
        echo " if(document.getElementById('keystring').value.length < 5) {
			alert('Please enter the code you see on the image');
			documentgetElementById('keystring').focus(); return false;
		}

		return true;
	}

 	function captcha_reload(){
 		document.getElementById('kcaptcha').src='kcaptcha/?" . session_name() . "='+Math.round(100000000 * Math.random());
 	}";
    }
    else {
        echo "

		return true;
	}";
    }

}

?>