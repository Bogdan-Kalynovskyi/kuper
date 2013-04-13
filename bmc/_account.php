<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


if (isset($_POST['wp_' . LOGIN_HASH])) {

    include_once A_ROOT . "login.php";

}


if (isset($_GET['_account_'])) {


////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
    if ($_GET['_account_'] == 'logout') {

        bmc_Logout();

    }


////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
    if ($_GET['_account_'] == 'secret_link') {

        $usr = $db->query("SELECT * FROM " . PRF . "users WHERE email = " . a($_GET['email']), false);
        if ($usr && $_GET['key'] == $usr['additional_security_feature']) {
            include_once A_HOME . 'ip_fun.php';
            if ($_GET['ip'] == get_real_ip()) {
                if ($_GET['whattodo'] == 'get') {

                    yobtvoyumat(0, $usr);

                }
                elseif ($_GET['whattodo'] == 'set') {

                    yopernujteatr(0, $usr);

                }
            }
        }

        error_page('The link specified is invalid!');
    }


////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
    if ($_GET['_account_'] == 'restore_pass') {
        include_once A_HOME . "fun_login.php";

        if (bad_cap(true)) {
            error_page($user_message);
        } //user_message is a global variable taken from bad_cap

        $_POST['email'] = strtolower($_POST['email']);

        if (!isemail($_POST['email'])) {
            error_page('Incorrect Email - <big>' . htmlspecialchars($_POST['email']) . '</big>');
        }

        $usr = $db->query("SELECT id,login FROM " . PRF . "users WHERE email=" . a($_POST['email']), false);

        if (!$usr && $bmc_vars['email'] != $_POST['email']) {
            error_page('You have entered a wrong email - <big>' . htmlspecialchars($_POST['email']) . '</big>');
        }

        include_once A_HOME . 'ip_fun.php';
        $ip = get_real_ip();

        $key = uuidv4();
        $db->query("UPDATE " . PRF . "users SET additional_security_feature=" . a($key) . " WHERE id = '{$usr['id']}' ");
//todo vaslidation time


        $subject = "$MY_URL password restore";
        $href = "$MY_URL?_account_=secret_link&ip=$ip&email={$_POST['email']}&whattodo=get&key=$key";
        $message = "
					<pre style=\"white-space:pre-wrap;\">
					<a href=\"$MY_URL\">$MY_URL</a>


						You have asked to restore your password


					------------------------------------
						Your username is <b>{$usr['login']}</b>

						Follow this link to set a new password

						<a href=\"$href\">$href</a>
					-------------------------------------


						Request sent from ip $ip on " . bmc_date() . ". Link is valid for one hour. Please use the same ip.
					</pre>";
        //user_agent

        if (bmc_mail($_POST['email'], $subject, $message)) {
            good_page('New password has been generated<br> and sent on your email');
        }
        else {
            error_page('Email sending error occured restoring your password. Please contact the webmaster');
        }


    }

    //upgade suggestion


////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
    if ($_GET['_account_'] == 'email_request') {
        $do_cap = true;
        include_once A_HOME . "fun_login.php";
        include A_VIEW . "header_1.php"
        ?>



        <script>//make it nicer, change username, email....
            function isEmail(str) {
                str = str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
                return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9_\-]*\.)+[a-z]{2,4}$/i).test(str);
            }
            function check_form () {
                if (!isEmail(document.getElementById('email').value)) {
                    document.getElementById('email').focus();
                    alert(document.getElementById('email').value + ' is not a valid email');
                    return false;
                }
            }

            <?php show_cap_js(); ?>//not working now
        </script>


        <h1><a href="./" title="Powered by Bodya">Login</a></h1>
        <form accept-charset="<?php echo $CHRST ?>" method=post action="?_account_=restore_pass" onsubmit="return check_form()" id="loginform">
            <br>

            <h1 style="font-family:arial;font-size:21px;margin:0 0 6px 0"> New password will be sent to your email</h1><br>

            <?php show_ms(); ?>

            <p>
                <label>
                    Your email<br>
                    <input type=email name="email" id="email" class="input" size="20" tabindex="10">
                </label>
            </p>

            <?php show_cap(); ?>    <p style="height:11px"></p>

            <p class="submit">
                <input type=submit id="wp-submit" class="button-primary" value="    G o    " tabindex="100">
            </p>

            <br>
        </form>



        <?php
        include A_VIEW . "footer.php";
        exit;
    }


}
////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
$USER = null;

$USER = bmc_getLogged();

if (!($USER && is_array($USER) && $USER['level'])) {
    return;
}

////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
////------------------------------------------------------------------------------------------////
if (isset($_GET['_account_'])) {

    if ($_GET['_account_'] == 'pass_request') {

        yobtvoyumat(1, $USER);

    }

    if ($_GET['_account_'] == 'change_pass') {

        yopernujteatr(1, $USER);

    }

}


function yobtvoyumat ($inside, $usr) {
    include A_ROOT . "editor/header.php"
    ?>


    <script>//make it nicer
        function check_form() {
            <?php if($inside){ ?>
            if (document.install.old_pass.value.length < 3) {
                alert("Old password too short. At least 3 symbols");
                document.install.old_pass.focus();
                return false;
            }
            <?php } ?>
            if (document.install.new_pass1.value.length < 6) {
                alert("Ïàðîëü ñëèøêîì êîðîòêèé. Ìèíèìóì 6 ñèìâîëîâ!");
                document.install.new_pass1.focus();
                return false;
            }
            if (document.install.new_pass.value != document.install.new_pass1.value) {
                alert("Ïàðîëè íå ñîâïàäàþò!");
                document.install.new_pass1.focus();
                return false;
            }

            return true;
        }
    </script>

    <form accept-charset="<?php echo $CHRST ?>" method=post action="<?php if ($inside) { ?>?_account_=change_pass<?php
    }
    else {
        echo str_replace('&whattodo=get&', '&whattodo=set&', $_SERVER['REQUEST_URI']);
    } ?>" name="install" onsubmit="return check_form()">
        <fieldset id="__key">

            <strong>Ñìåíèòü ïàðîëü</strong><br><br>

            <u>Ëîãèí</u> <?php echo $usr['login']; ?><br><br>
            <?php if ($inside) { ?>
                <u>Ñòàðûé ïàðîëü</u> <input type=password name="old_pass" id="autofoc" value=""><br>
            <?php } ?>
            <u>Íîâûé ïàðîëü</u> <input type=password name="new_pass"><br>
            <u>Íîâûé ïàðîëü åùå ðàç</u> <input type=password name="new_pass1"><br><br><br>

            <u><input type=submit value="     Ñìåíèòü     "></u> <input type=button onclick="history.go(-1)" value="  Îòìåíà  "><br>

            <?php if ($inside) { ?>
                <script>
                    $('autofoc').value = '';
                    $('autofoc').focus();
                </script>
            <?php } ?>


        </fieldset>
    </form>


    <?php

    include A_ROOT . "editor/footer.php";
    exit;
}


function yopernujteatr ($inside, $usr) {
    global $db;


    if ($inside && ($usr['pass'] != bmc_hash($_POST['old_pass']))) {
        error_page('Íåâåðíî óêàçàí ñòàðûé ïàðîëü');
    }
    if (strlen($_POST['new_pass']) < 6) {
        error_page('Ñëèøêîì êîðîòêèé íîâûé ïàðîëü. Ìèíèìóì - 6 ñèìâîëîâ');
    }
    if ($_POST['new_pass'] != $_POST['new_pass1']) {
        error_page('Íîâûå ïàðîëè íå ñîâïàäàþò');
    }
    {

        $succ = $db->query("UPDATE " . PRF . "users SET pass=" . a(bmc_hash($_POST['new_pass'], $usr['algo'], $usr['salt'])) . ", additional_security_feature=0 WHERE id=" . a($usr['id']));
        if ($succ) {
            $db->query("DELETE FROM " . PRF . "login WHERE user=" . a($usr['id']));
        }

        if ($succ) {
            good_page("Ïàðîëü óñïåøíî èçìåíåí!");
        }
        else {
            error_page("Pasword change failed!");
        }

    }

}

?>