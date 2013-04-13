<?php
/********************************************************************
 * openImageLibrary addon Copyright (c) 2006 openWebWare.com
 * Contact us at devs@openwebware.com
 * This copyright notice MUST stay intact for use.
 ********************************************************************/

require('config.inc.php');


$f2 = upload_file();


if (!empty($f2)) {
    $_POST['src'] = str_replace($startdir, "", $f2);
}







header("Content-Type: text/html; charset=utf-8");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <meta charset=utf-8
    " >

    <title>Додати файл для скачування</title>

    <script src="../scripts/wysiwyg-popup.js"></script>
    <script language="JavaScript">

        var ibu = '<?php echo $imagebaseurl; ?>';


        function loadForm() {
            <?php if(isset($f2) && !empty($f2)){ ?>
            insertHyperLink();
            <?php } else{ ?>
            loadSelection();
            <?php } ?>
        }

    </script>
    <style>
        * {
            margin: 0;
            padding: 0
        }</style>
    <script src="insert_file.js"></script>

</head>
<body bgcolor="#EEEEEE" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" onLoad="loadForm();">
<table border="0" cellpadding="0" cellspacing="0" style="padding: 11px;">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?wysiwyg=<?php echo $wysiwyg; ?>" name="myform" enctype="multipart/form-data" onsubmit="return mySubmit();">
        <input type="hidden" id="dir" name="dir" value="">
        <tr>
            <td style="vertical-align:top;">
                <span style="font-family: arial, verdana, helvetica; font-size: 12px; font-weight: bold;"
                      id="ccc">Посилання на файл для скачування:</span>
                <table width="380" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
                    <?php
                    if ($allowuploads) {
                        ?>
                        <tr>
                            <td style="padding-top: 0px;padding-bottom: 0px; font-family: arial, verdana, helvetica; font-size: 12px;width:80px;">З Файлу:</td>
                            <td style="padding-top: 0px;padding-bottom: 0px;width:300px;"><span id="test"><input type="file" name="file" size="30"
                                                                                                                 style="font-size: 12px; width: 100%;"
                                                                                                                 accept="image/gif, image/jpeg, image/png, image/bmp"
                                                                                                                 onchange="clear_f2();" onkeydown="clear_f2();"></span></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 0px;padding-bottom: 2px;font-family: tahoma; font-size: 10px;">&nbsp;</td>
                            <td style="padding-top: 0px;padding-bottom: 2px;font-family: tahoma; font-size: 10px;"><?php echo $errormsg; ?></td>
                        </tr>
                    <?php
                    }
                    else {
                        ?>
                        <tr>
                            <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;" colspan="2">
                                Завантаження заблоковані на сервері.
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;" width="80">Або з URL:</td>
                        <td style="padding-bottom: 2px; padding-top: 0px;" width="300"><input type="text" name="src" id="src" value="<?php echo $_POST['src']; ?>"
                                                                                              onchange="clear_f1();" onkeydown="clear_f1();" style="font-size: 12px; width: 100%;">
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size: 9px;">&nbsp;</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">Підказка:</td>
                        <td>
                            <input type="text" name="title" id="title" value="<?php echo $_POST['title']; ?>"
                                   style="font-size: 11px; width: 100%;  color:#777777; background-color: #eeeeee;">
                        </td>
                    </tr>

                    <tr>
                        <td style=" width: 50px; font-family: arial, verdana, helvetica; font-size: 11px;">Target:</td>
                        <td colspan="3">
                            <input type="text" name="linkTarget" id="linkTarget" value="" style="font-size: 10px; width: 60%;  color:#777777; background-color: #eeeeee;">
                            &nbsp;
                            <select name="linkTargetChooser" id="linkTargetChooser" style="font-size: 10px; width: 30%; color:#777777; background-color: #eeeeee;"
                                    onchange="updateTarget(this.value);">
                                <option value="" selected>no target</option>
                                <option value="_blank">_blank</option>
                                <option value="_self">_self</option>
                                <option value="_parent">_parent</option>
                                <option value="_top">_top</option>
                                <option value="">custom</option>
                            </select>
                        </td>
                    </tr>


                    <tr>
                        <td style="height:2px;">&nbsp;</td>
                        <td></td>
                    </tr>


                    <tr>
                        <td></td>
                        <td style="text-align: right;">
                            <input type="submit" value="  Зберегти  " style="font-size: 13px;">
                            <input type="button" value="  Відмінити  " onclick="window.close();" style="font-size: 13px;">


                        </td>
                    </tr>


                </table>
                <input type="hidden" name="linkStyle" id="linkStyle">
                <input type="hidden" name="linkClass" id="linkClass">
                <input type="hidden" name="linkName" id="linkName">

            </td>
            <td style="vertical-align: top;width: 200px; padding-left: 5px;">
                <span style="font-family: arial, verdana, helvetica; font-size: 12px; font-weight: bold;">Виберіть Файл:</span>
                <iframe id="chooser" frameborder="0" style="height:154px;width: 200px;border: 2px solid #FFFFFF; padding: 5px;"
                        src="select_file.php?dir=<?php echo $leadon; ?>"></iframe>
            </td>
        </tr>
    </form>
</table>
</body>
</html>
