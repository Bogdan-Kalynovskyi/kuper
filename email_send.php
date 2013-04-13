<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}

include_once A_HOME . "fun_login.php";
//todo preview
//todo ipban(î÷åíü ïîòîì)
$message = '';

if (isset($_POST[USER_HASH]) && $_POST[USER_HASH] == '2') {
    if (bad_cap(true)) {
        $message = "Ââåäèòå ïðàâèëüíî êîä íà êàðòèíêå";
        $ok = false;

    }
    elseif (!trim(@$_POST['text'])) {
        $message = "Âû âåðîÿòíî çàáûëè ââåñòè ñîîáùåíèå";
        $ok = false;

    }
    else {

        $_POST['name'] = htmlspecialchars_decode($_POST['name']);
        $_POST['text'] = htmlspecialchars_decode($_POST['text']) . "</pre>";

        try {
            require_once('PHPMailer/class.phpmailer.php');

            $mail = new PHPMailer();

            $mail->CharSet = $CHRST;
            $mail->IsHTML(true);
            $Reply = isemail($_POST['email']) ? "<a href=\"mailto:{$_POST['email']}\">{$_POST['email']}</a>" : $_POST['email'];

            //..$mail->SetFrom($Reply, 'Ïèñüìî ñ kuperfild.ru');
            $mail->AddAddress($bmc_vars['email']);
            $mail->Subject = "Ïèñüìî ñ kuperfild.ru! Ïèøåò  {$_POST['name']}";
            $mail->FromName = 'kuperfild.ru';
            $mail->From = 'noreply@kuperfild.ru';

            $msg = "
			×åëîâåê ïðåäñòàâèëñÿ êàê <big><b style=\"margin-left:8px;color:#755\">{$_POST['name']}</b></big>.
			<br>Îñòàâèë ñâîè êîîðäèíàòû: <big style=\"margin-left:8px\">$Reply</big>
			<br>
			<br>---------------------- Íàïèñàë: ----------------------- <br> <pre style=\"white-space:pre-wrap;	font-size:14px\">"; // optional, comment out and test

            $mail->AltBody = strip_tags($msg) . $_POST['text'];
            $mail->MsgHTML($msg . $_POST['text']);

            if ($mail->Send()) {
                $message = "Ïèñüìî óñïåøíî îòïðàâëåíî!";
                $ok = true;
                unset($_POST);
            }
            else {
                $message = "Êàêàÿ-òî áàãà =(. Ïîïðîáóéòå åùå ðàç!";
                $ok = false;
            }
        }
        catch (phpmailerException $e) {
            $message = $e->errorMessage(); //Pretty error messages from PHPMailer
            $ok = false;
        }
        catch (Exception $e) {
            $message = $e->getMessage(); //Boring error messages from anything else!
            $ok = false;
        }
    }
}




?>

<link rel=stylesheet href="guestbook.css">
<link rel=stylesheet href="email_send.css">


<div id="_head">

    <h1>Êîíòàêòû</h1>

    <div id="_body">
        <?php

        function email_pr ($s) {
            $s = str_replace('http://', '', $s);
            if (strlen($s) > 26) {
                $s = substr($s, 0, 24) . '&#133;';
            }
            return $s;
        }

        echo '<a target="_blank" href="' . $bmc_vars['vk'] . '"><img src="images/vk.png" alt="ÂÊîíòàêòå">' . email_pr($bmc_vars['vk']) . '</a>';
        echo '<a target="_blank" href="' . $bmc_vars['lj'] . '"><img src="images/lj.png" alt="Óþòíàÿ ÆÆ">' . email_pr($bmc_vars['lj']) . '</a>';
        echo '<a target="_blank" href="mailto:' . $bmc_vars['email'] . '"><img src="images/email.png" alt="Å-ìåéë">' . email_pr($bmc_vars['email']) . '</a>';
        echo '<a target="_blank" href="callto:' . $bmc_vars['phone'] . '"><img src="images/phone.png" alt="Òåëåôîí">' . email_pr($bmc_vars['phone']) . '</a>';
        ?>
    </div>

    <?php

    if ($bmc_vars['contacts']) {
        echo "<div id=\"dezz\">{$bmc_vars['contacts']}</div>";
    }
    else {
        echo "<div  style=\"clear:both;height:18px\"></div>";
    }

    ?>
</div>
<br>


<div id="overall">


    <img src="images/ida_env2.jpg" id="envelope">


    <h3 style="padding:17px 0 6px 0;color:#222">
        Íàïèñàòü ìíå ïèñüìî</h3><br>


    <br>
    <?php
    if ($message) {
        echo '<label><span class="bar ' . ($ok ? 'green' : 'red') . '">' . $message . '</span></label><label></label>';
    }
    ?>


    <form method=post action="<?php echo $_SERVER['REQUEST_URI'] ?>" accept-charset="<?php echo $CHRST ?>" onsubmit="return verify_form()">
        <fieldset><br><br>
            <input type=hidden name="<?php echo USER_HASH; ?>" value="2">


            <label>Ïðåäñòàâòåñü ïîæàëóñòà
                <input type=text name="name" value="<?php echo htmlspecialchars(@$_POST['name']) ?>" tabindex="10">
            </label>

            <label>Êàê Âàñ íàéòè?&nbsp; <span>(email, áëîã&#133;)</span>
                <input type=text name="email" value="<?php echo htmlspecialchars(@$_POST['email']) ?>" tabindex="20">
            </label>

            <label style="height:120px">Òåêñò ñîîáùåíèÿ <span style="color:red">*</span>
                <textarea name="text" cols="80" rows="4" tabindex="30"><?php echo htmlspecialchars(@$_POST['text']) ?></textarea>
            </label>


            <?php show_cap1(true); ?>

            <br>
            <label>
                <input type=submit style="letter-spacing:1px" value="         Îòïðàâèòü         " tabindex="100">
            </label><br><br>

        </fieldset>
    </form>
</div>


<script src=js/jslib.js></script>
<script>

    function verify_form() {
        if (!document.getElementsByName('text')[0].value) {
            alert('Íàïèøèòå õîòü ÷òî íèáóäü â òåêñòå ñîîáùåèíÿ');
            return false;
        }
        return true;
    }

    <?php show_cap_js1(true) ?>

</script>
