<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}



NonCachePlusEncoding();


?><!DOCTYPE html>
<html>
<head>
    <title>Sitename login page</title>

    <meta charset=<?php echo $CHRST; ?>>
    <meta http-equiv="Cache-Control" content="no-cache">

    <meta name="robots" content="noindex, nofollow">
    <meta name="webmaster" content="mybodya@gmail.com">
    <!-- rss -->

    <link rel=stylesheet href='wp-login.php_files/login.css'>
    <link rel=stylesheet href='wp-login.php_files/colors-fresh.css'>


    <script src="js/jscapslock.js"></script>
    <script src="js/hash.js"></script>
</head>

<body class="login">

<div id="login"><h1><a href="http://wordpress.org/" title="Powered by WordPress">121234</a></h1>

    <form accept-charset="<?php echo $CHRST ?>" name="my_form" id="loginform" method=post action="<?php echo $MY_URL . '/login.php'; /*login*/ ?>" onsubmit="return validate();">
        <?php if (isset($user_message)) {
            echo '<p class="bold_red">' . $user_message . '</p>';
        } ?><br>

        <p>
            <label>Username<br>
                <input type=text name="wp_user_login" id="user_login" class="input" value="" size="20" tabindex="10"></label>
        </p>

        <p>
            <label>Password<br>
                <input type=password name="wp_user_pass" id="user_pass" class="input" value="" size="20" tabindex="20"></label>
        </p>
        <?php
        show_cap();
        restore_post_data();
        ?>
        <p style="height:3px"></p>

        <p class="forgetmenot"><label id="remember_label"><input name="wp_remember" type=checkbox id="rememberme" value="1" title="For a month" tabindex="90"><big> Remember
                    Me</big></label></p>

        <p class="submit">
            <input type=submit style="position:relative;top:3px" name="wp-submit" id="wp-submit" class="button-primary" value="Log In" tabindex="100">
            <input type=hidden name="hash" value="">
            <input type=hidden name="sid" value="<?php echo session_id(); ?>">
        </p>

        <p style="height:2px"></p>
    </form>

    <p id="nav">
        <a href="./?account=register" title="Become a member">Register</a> | <a href="./?account=email_request" title="Password Lost and Found">Lost your password?</a></p>

    <!--
        <div style="width:370px; text-align:right;margin:0 auto">
    <a href="mailto:mybodya@gmail.com" style="text-decoration:none;">&copy; Oldo Production 2010</a>
</div>
<a href="mailto:mybodya@gmail.com" style="float:right" title="Drop us a message">Contact us...</a>

	-->

    <script>
        <!--
        try {
            document.getElementById('user_login').focus();
        } catch (e) {
        }


        function validate() {

            if (document.my_form.wp_user_login.value.length < 3) {
                document.my_form.wp_user_login.focus();
                alert("Short login, 3 chars minimum");
                return false;
            }
            if (document.my_form.wp_user_pass.value.length < 3) {
                document.my_form.wp_user_pass.focus();
                alert("Short password, 3 chars minimum");
                return false;
            }

            try {
                document.my_form.wp_user_login.value = hex_md5(document.my_form.wp_user_login.value.toLowerCase());
                document.my_form.hash.value = 'ok';
            } catch (e) {
            }

        <?php show_cap_js(); ?>

        /*return true;
         }*/


        //-->
    </script>

</body>
</html>
<?php exit; ?>