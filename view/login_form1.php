<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


header("Content-Type: text/html; charset=$CHRST");
header("Cache-Control: no-cache");
header("Expires: -1");
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');




///////////////////////////////////////////////////////////////////////////////////////////////

?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Login Page</title>
        <meta <?php echo $CHRST; ?>">
        <link rel=stylesheet href="img/global00.css">
        <link rel=stylesheet href="img/master00.css">

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <script src="js/jscapslock.js"></script>
        <script src="js/hash.js"></script>

    </head>

    <body class="login" style="background:#FFDDFF">
    <!--[if lt IE 7]>
    <link rel=stylesheet href="css/ie6.css">
    <![endif]-->
    <form id="Form1" name="Form1" accept-charset="<?php echo $CHRST ?>" method=post action="<?php echo $MY_URL . '/login.php'; ?>" onsubmit="return validate();">

        <div id="panelErrorMsg">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'restore_pass') {

                if ($_GET['restore_success']) {
                    echo '<h1><br>Password regenerated and sent on your email</h1>';
                }
                else {
                    echo '<h3><br>Email not sent due to an error</h3>';
                }

            }
            ?>
        </div>
        <br><br><br>

        <div id="login">
            <div id="cap-top"></div>
            <div id="cap-body">
                <div id="branding"><h1 style="margin:-9px 0 21px 40px;color:#dfdfdf;font-size:32px;">Oldo Admin Tool</h1><br><?php if (isset($user_message)) {
                        echo '<div style="margin:-24px 0 4px 44px; color:#F55; font-weight:bold">' . $user_message . '</div>';
                    } ?></div>
                <div id="panelLogin">

                    <div>
                        <label>
                            Your login</label>
                        <input type=text class="textbox340" name="user_login" id="txtLogin" value="">
                    </div>
                    <div>
                        <label>
                            Password</label>
                        <input type=password class="textbox340" name="password" id="txtPassword" value="">
                    </div>
                    <div>
                        <label>
                            Remember me</label>
                        <input type=checkbox name="remember" style="padding:2px;*margin-left:-3px" value="1">
                    </div>


                    <div class="submit clearfix">
                        <input type="image" src="img/button-l.png" alt="Login" name="btnLogin" id="btnLogin">
                    </div>
                    <p class="lostpassword">
                        <a href="account.php?action=restore_pass">Forgot your password?</a>
                        &nbsp; or &nbsp;
                        <a href="mailto: mybodya@gmail.com" target=_blank>Need help? - Oldo</a>
                    </p>

                </div>


            </div>
            <div id="cap-bottom"><img src="img/cap-bott.png"></div>
        </div>
        <!-- END #login -->

    </form>

    <script language="javascript">
        document.getElementById('txtLogin').focus();
        document.getElementById('Form1').style.position = 'relative';
        document.getElementById('Form1').style.top = screen.height / 2 - 380;


        function validate() {

            if (document.getElementById('txtLogin').value.length < 3) {
                document.getElementById('txtLogin').focus();
                alert("Short login, 3 chars minimum");
                return false;
            }
            if (document.getElementById('txtPassword').value.length < 3) {
                document.getElementById('txtPassword').focus();
                alert("Short password, 3 chars minimum");
                return false;
            }
            return true;
        }

    </script>

    </body>
    </html>
<?php exit; ?>