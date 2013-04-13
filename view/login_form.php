<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}

include_once A_VIEW . "header.php"; //no include_once!!!;//RESTORE POST DATA//no cache plus encoding


///////////////////////////////   special messages   /////////////////////////////////////////
if (isset($_GET['action']) && $_GET['action'] == 'restore_pass') {
    if ($_GET['restore_success']) {
        echo '<h1><br/>Password regenerated and sent on your email</h1>';
    }
    else {
        echo '<h3><br/>Email not sent due to an error</h3>';
    }
}
///////////////////////////////                   ////////////////////////////////////////////
?>


<script src="js/jscapslock.js"></script>
<script src="js/hash.js"></script>

<style> input {
        font-size: 16px;
        width: 160px;
        margin: 3px 0 3px 20px;
        float: none
    }

    .form_fields {
        font-size: 14px;
        width: 320px;
        border-width: 3px;
        margin-top: 120px
    }

    input[type=checkbox] {
        width: 15px;
        height: 15px;
        vertical-align: middle;
        margin: 6px 153px 6px 20px;
        /* *margin-right:100px;*/
        padding: 0
    }
</style>
<br/><br/><br/><br/><br/><br/><br/>


<div class="form_fields">
    <form accept-charset="<?php echo $CHRST ?>" method="post" name="my_form" action="<?php echo $MY_URL . '/login.php'; /*login*/ ?>" onsubmit="return validate();">
        <?php if (isset($user_message)) {
            echo '<span class="bold_red">' . $user_message . '</span>';
        } ?><br/><br/>
        <input type="hidden" name="hash" value=""/>
        <input type="hidden" name="sid" value="<?php echo session_id(); ?>"/>
        Login :<input type="text" name="user_login"/><br/>
        Password :<input type="password" name="password"/><br/>
        <span style="vertical-align:middle">Remember me :</span><input type="checkbox" name="remember" value="1"/><br/>

        <?php
        show_cap();
        restore_post_data();
        ?>

        <input type="submit" style="width:164px" class="btn" value="Login"/><br/><br/><br/>
        <small><a href="./?account=email_request">Forgot your password?</a></small>
    </form>
</div> <!-- End form_fields //-->


<div style="width:370px; text-align:right;margin:0 auto">
    <a href="mailto:mybodya@gmail.com" style="text-decoration:none;">&copy; Oldo Production 2010</a>
</div>


<script>
    <!--
    try {
        document.my_form.user_login.focus();
    } catch (e) {
    }


    function validate() {

        if (document.my_form.user_login.value.length < 3) {
            document.my_form.user_login.focus();
            alert("Short login, 3 chars minimum");
            return false;
        }
        if (document.my_form.password.value.length < 3) {
            document.my_form.password.focus();
            alert("Short password, 3 chars minimum");
            return false;
        }
        try {
            document.my_form.user_login.value = hex_md5(document.my_form.user_login.value.toLowerCase());
            document.my_form.hash.value = 'ok';
        } catch (e) {
        }

    <?php show_cap_js(); ?>

    /*return true;
     }*/


    //-->
</script>

<?php
include_once A_VIEW . "footer.php";
exit;
?>
