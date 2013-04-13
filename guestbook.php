<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}

include_once A_HOME . "fun_login.php";

//todo preview
//todo ipban

$base = $_SERVER['SCRIPT_NAME'] . '?blog=' . BLOG;
$message = '';

if (isset($_POST[USER_HASH]) && $_POST[USER_HASH] == '1') {
    if (!IS_ADMIN && bad_cap(true)) {
        $message = "������� ��������� ��� �� ��������";
        $ok = false;

    }
    elseif (!trim(@$_POST['text'])) {
        $message = "�� �������� ������ ������ ���������";
        $ok = false;

    }
    else {

        include_once A_HOME . "upload_pic.php";

        if (IS_ADMIN && isnumeric($_POST['edit'])) {
            $message = "����� ������� �������";
            $id = $_POST['edit'];
        }
        else {
            $message = "����� ������� �������� !";
            $_POST['date'] = time();
            $id = '0';
        }


        $icon = myurlencode(up_pic('icon', '', md5(mt_rand(0, 99999999) . time()), 'userpics/', $bmc_vars['ava_x'], $bmc_vars['ava_y']));
        if ($_POST['site'] == 'http://') {
            $_POST['site'] = '';
        }


        $vals = array('id', 'name', 'email', 'site', 'public', 'icon', 'text', 'date');
        $rez = array();
        foreach ($vals as $p) {
            $rez[$p] = htmlspecialchars(htmlspecialchars_decode(@$_POST[$p]));
        }
        $rez['id'] = $id;
        $rez['icon'] = $icon;

        $db->query("REPLACE INTO " . PRF . "guestbook " . $db->sql_from_array("REPLACE", $rez));

        $ok = true;

        unset($_POST);

    }
}


if (IS_ADMIN && isnumeric($_GET['del'])) {
    $db->query("DELETE FROM " . PRF . "guestbook WHERE id = " . a($_GET['del']));
    $message = '����� ������� ������';
    $ok = true;
    //confirmatin todo
}


if (IS_ADMIN && isnumeric($_GET['edit'])) {
    $_POST = $db->query("SELECT * FROM " . PRF . "guestbook WHERE id= " . a($_GET['edit']), false); //���� ��� �� �� �����?..
    $message = '������ �� ������ ��������������� �����. �������� ��� ��������';
    $ok = true;
}


$G = $db->query("SELECT * FROM " . PRF . "guestbook ORDER BY date DESC");
//����� ������������ ������ ���??

?>


<link rel=stylesheet href=guestbook.css>


<div id="overall">


    <h1>�������� �����</h1>

    <h2><b style="font-family:georgia"><?php echo count($G) ?></b>
        <small><?php echo number_ending(count($G), '�������', '�����', '������') ?></small>

    </h2>

    <input id="write" type=submit value="      �������� �����       " tabindex="4"
           onclick="document.location='#new_post';document.getElementsByName('name')[0].focus();">

    <br>
    <br>


    <?php
    if ($message) {
        echo '<label><span class="bar ' . ($ok ? 'green' : 'red') . '">' . $message . '</span></label><label></label>';
    }
    else {
        echo '<div style="height:2px"></div>';
    }
    ?>


    <div id="macd">
        <?php


        foreach ($G as $i => $a) {
            if (!$a['name']) {
                $a['name'] = '������';
            }
            else {
                $a['name'] = ucfirst($a['name']);
            }


            $a['date'] = bmc_Date($a['date']);

            if ($a['icon'] && (substr($a['icon'], 0, 7) != 'http://') && !is_file(A_ROOT . $a['icon'])) //todo trim//transparent png gif image.class.php todo
            {
                $a['icon'] = '';
            }
            if (!$a['icon']) {
                $a['icon'] = @$bmc_vars['default_userpic'];
            }
            if (!$a['icon']) {
                $a['icon'] = 'img/default_userpic.gif';
            }


            $contacts = $contacts1 = '';
            if (IS_ADMIN || $a['public']) {
                /*	if($a['email'])
                         $contacts = '<a href="mailto: "'.$a['email'].'" title="���������� �����">@</a>&nbsp;';
                    if($a['site']){
                         $contacts .= '<a rel="nofollow" href="'.$a['site'].'" title="������������ ���������">';
                         $contacts1='</a>';
                    }*/
                if ($a['site']) {
                    if (strpos($a['site'], '@')) {
                        $a['site'] = "mailto:" . $a['site'];
                        $comment = "���������� �����";
                    }
                    else {
                        $comment = "������������ ���������";
                    }
                    //telefon&??

                    $contacts = '<a rel="nofollow" href="' . $a['site'] . '" title="' . $comment . '">';
                    $contacts1 = '</a>';
                }
            }

            if (IS_ADMIN) {
                $adm = '<br><a href="' . $base . '&del=' . $a['id'] . '">�������</a>
						&nbsp; 	<a href="' . $base . '&edit=' . $a['id'] . '">�������������</a>';
            }
            else {
                $adm = '';
            }

            $j = $i + 1;
            if ($i & 1) {
                $stl = '';
            }
            else {
                $stl = ' gb1';
            }
            //&nbsp; <i>( $j. )</i>
            echo <<<EOF
		<div class="gb$stl">
			<img src="{$a['icon']}">
			<span>&nbsp; $contacts<b>{$a['name']}</b>$contacts1 <u>{$a['date']}</u>&nbsp;</span>
			<pre>{$a['text']}</pre>
			$adm
		</div>
EOF;


        }
        ?>
    </div>


    <br><br><br><br><br><br>

    <h3>�������� �����</h3><br>


    <a name="new_post"></a>
    <br>
    <?php
    if ($message) {
        echo '<label><span class="bar ' . ($ok ? 'green' : 'red') . '">' . $message . '</span></label><label></label>';
    }
    ?>


    <form method=post action="<?php echo $base ?>" accept-charset="<?php echo $CHRST ?>" enctype="multipart/form-data" onsubmit="return verify_form()">
        <fieldset style="background:#f6f6f6;padding:22px 0 16px 0;border:2px solid white;	-moz-border-radius:2px;border-radius:2px;margin-top:-2px;margin-left:-2px">

            <input type=hidden name="<?php echo USER_HASH; ?>" value="1">
            <input type=hidden name="date" value="<?php echo @$_POST['date'] ?>">
            <input type=hidden name="MAX_FILE_SIZE" value="100000">
            <?php
            if (IS_ADMIN && isnumeric($_GET['edit'])) {
                echo <<<EOF
	<input type=hidden name="edit" value="{$_GET['edit']}">
EOF;
            }
            ?>


            <label style="letter-spacing:1px">���
                <input type=text name="name" value="<?php echo htmlspecialchars(@$_POST['name']) ?>" tabindex="10">
            </label>

            <label>Email &nbsp;<span>���</span>&nbsp; c��������
                <input type=text name="site" value="<?php echo htmlspecialchars(@$_POST['site'] ? $_POST['site'] : 'http://') ?>" tabindex="20">
            </label>

            <label>���� &nbsp;<span>(URL ��� ����)</span> <a href=# id="aaa" title="������ �����"
                                                                                   onclick="clrnpt1('icon');return false">������</a>
                <input type=file name="icon" id="__icon" onkeydown="omch()" onchange="omch()" tabindex="22">
            </label>

            <label>���������� ��������
                <input type=checkbox name="public" value="1" <?php if (@$POOO['site']) {
                    echo ' checked';
                } ?> tabindex="30">
            </label>


            <label style="height:122px">����� ��������� <span style="color:red">*</span>
                <textarea name="text" cols="80" rows="4" tabindex="40"><?php echo htmlspecialchars(@$_POST['text']) ?></textarea>
            </label>


            <?php if (!IS_ADMIN) {
                show_cap1(true);
            } ?>

            <br>
            <label>
                <input type=submit style="letter-spacing:1px;padding-left:1px"
                       value="      <?php echo(!isset($_GET['edit']) ? '��������' : '��������'); ?> �����      " tabindex="100">
            </label>
            <br>

        </fieldset>
    </form>
</div>


<script src=js/jslib.js></script>
<script>

    function clrnpt1(id) {
        $('aaa').style.visibility = 'hidden';
        clrnpt(id);
    }

    function verify_form() {
        if (!document.getElementsByName['text'].value) {
            alert('�������� ���� ��� ������ � ������ ���������');
            return false;
        }
        return true;
    }

    function omch() {
        $('aaa').style.visibility = 'visible';
    }

    <?php show_cap_js1(true) ?>

</script>
