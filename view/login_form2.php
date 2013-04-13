<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


if (noempty($_COOKIE['BMC_redirect'])) {
    $cc = $_COOKIE['BMC_redirect'];
    setcookie("BMC_redirect", '', time() - 100000);
    unset($_COOKIE['BMC_redirect']);
}
else {
    $cc = $_SERVER['REQUEST_URI'];
}

$cc = str_replace('_account_', '1', $cc);


include A_VIEW . "header_1.php";


?>

    <h1><a href="./" title="Powered by Bodya">Login</a></h1>


<?php


///////////////////////////////   special messages   /////////////////////////////////////////

if (isset($_GET['_account_']) && $_GET['_account_'] == 'logout') {
    echo '<p class="message">	You are now logged out.<br></p>';
}

///////////////////////////////                   ////////////////////////////////////////////

$focused_field = 'user_login';
?>






    <form accept-charset="<?php echo $CHRST ?>" name="my_form" id="loginform" method="post"
          action="<?php echo $cc ?>"
          onsubmit="return validate();">
        <?php show_ms(); ?>
        <br>

        <p>
            <label>Username<br>
                <input type=text name="wp_user_login" id="user_login" class="input" value="<?php
                if (!empty($USER) && !is_array($USER)) {
                    echo htmlspecialchars($USER);
                    $focused_field = 'user_pass';
                }
                ?>" size="20" tabindex="10"></label>
        </p>

        <p>
            <label>Password<br>
                <input type=password name="wp_user_pass" id="user_pass" class="input" value="" size="20" tabindex="20"></label>
        </p>
        <?php
        show_cap();
        restore_all_data();
        ?>
        <p style="height:14px"></p>

        <p class="forgetmenot"><label title="forever"><input name="wp_remember" type=checkbox id="rememberme" value="1" tabindex="90"><big> Remember Me</big></label></p>

        <p class="submit">
            <input type=submit name="wp_submit" id="wp-submit" class="button-primary" value="Log In" tabindex="100">
            <input type=hidden name="wp_hash" value="">
            <input type=hidden name="wp_<?php echo LOGIN_HASH ?>" value="<?php echo sha1(session_id()); ?>">
        </p>

        <p style="height:6px"></p>
    </form>

    <p id="nav">
        <a href="./?_account_=register" title="Become a member" tabindex="120">Register</a> | <a href="./?_account_=email_request" title="Password Lost and Found" tabindex="130">Lost
            your password?</a></p>





    <script>
        try {
            document.getElementById('<?php echo $focused_field ?>').focus();
        } catch (e) {
        }
        var js_on = true;


        function validate() {

            try {
                var err = new Array();
                var f1 = document.my_form.wp_user_login;
                var f2 = document.my_form.wp_user_pass;
                f1.value = trim(f1.value);
                f2.value = trim(f2.value);

                if (f1.value === '') {
                    f1.focus();
                    err[0] = "Please enter  login";
                } else if (f1.value.length < 3) {
                    f1.focus();
                    err[0] = "Login too short, 3 letters  minimum";
                }

                if (f2.value === '') {
                    f2.focus();
                    err[1] = "Please enter  password";
                } else if (f2.value.length < 3) {
                    f2.focus();
                    err[1] = "Password too short, 3 letters  minimum";
                }

                <?php show_cap_js(); ?>


                if (err.length) {
                    var str = '\n';
                    for (i in err) {
                        str += ' ' + err[i] + '\n';
                    }
                    alert(str + '\n');
                    return false;
                }
            } catch (e) {
            }


            if (js_on) {
                try {
                    f1.value = hex_md5(f1.value.toLowerCase());
                    document.my_form.wp_hash.value = 'ok';
                } catch (e) {
                    js_on = false
                }
            }

            return true;
        }

        <?php show_cap_js1(); ?>

    </script>

    <script src="js/jscapslock.js"></script>
    <script src="js/hash.js"></script>
    <script src="js/jsfunc.js"></script>



<?php
include A_VIEW . "footer.php";
?>