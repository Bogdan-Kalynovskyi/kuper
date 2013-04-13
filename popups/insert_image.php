<?php
/********************************************************************
 * openImageLibrary addon Copyright (c) 2006 openWebWare.com
 * Contact us at devs@openwebware.com
 * This copyright notice MUST stay intact for use.
 ********************************************************************/

require('config.inc.php');


$f2 = get_file($_POST['src']);

if (empty($f2)) {
    $f2 = upload_file(true);
}






/*if($_POST['thumb'])*/ //print_r($_POST);




if (!empty($f2) && isset($_POST['thumb']) && ($_POST['thumb'] == '1')) {

    $path_parts = pathinfo($f2);
    $path_parts['basename'] = 'thumb_' . $path_parts['basename'];
    $f3 = $path_parts['dirname'] . '/' . $path_parts['basename'];

    include "image.class.php";

    $img = new Zubrag_image;
    if (isset($_POST['max_x']) && is_numeric($_POST['max_x']) && $_POST['max_x'] > 0) {
        $_POST['width'] = $_POST['max_x'];
        $img->max_x = $_POST['max_x'];
    }
    if (isset($_POST['max_y']) && is_numeric($_POST['max_y']) && $_POST['max_y'] > 0) {
        $_POST['heigh'] = $_POST['max_y'];
        $img->max_y = $_POST['max_y'];
    }

    $img->GenerateThumbFile($f2, $f3);
//	unlink($f2);
}






















//echo $_REQUEST; die;


//color:#777777; background-color: #eeeeee;






//*******************************************************************************************************
if (!empty($f3)) {
    $f2 = $f3;
}
if (!empty($f2)) {
    $_POST['src'] = str_replace($startdir, "", $f2);
}



if (empty($_POST['max_x'])) {
    $_POST['max_x'] = 100;
}
if (empty($_POST['max_y'])) {
    $_POST['max_y'] = 100;
}


$orig_x = $_POST['width'];
$orig_y = $_POST['height'];


if (!empty($f2)) {
    list($orig_x, $orig_y, $orig_img_type, $img_sizes) = @getimagesize($f2);
}



















header("Content-Type: text/html; charset=utf-8");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <meta charset=utf-8
    " >
    <title> Додати або змінити малюнок </title>

    <script src="../scripts/wysiwyg-popup.js"></script>
    <script language="JavaScript">

        function x1() {
            document.getElementById('img_').src = document.getElementById('src').value;
        }

        /* ---------------------------------------------------------------------- *\
         Function    : insertImage()
         Description : Inserts image into the WYSIWYG.
         \* ---------------------------------------------------------------------- */
        function mySubmit() {

            if (!document.myform.thumb.checked && (document.myform.file.value == '') && document.getElementById('src').value != '') {
                insertImage();
                return false;
            }
            if (document.myform.thumb.checked || (document.myform.file.value != '')) {
                return true;
            }

            return false;
        }

        function check() {
            var ext = document.getElementById('src').value;
            if (!ext) {
                return false;
            }
            ext = (ext != "undefined") ? ext.substring(ext.lastIndexOf(".") + 1, ext.length).toLowerCase() : false;
            if (ext != 'jpg' && ext != 'jpeg' && ext != 'gif' && ext != 'png') {
                alert('You selected a .' + ext + ' file; That is a wrong extension!');
                return false;
            }
            return true;
        }


        function insertImage() {
            if (!check()) {
                return;
            }
            var n = WYSIWYG_Popup.getParam('wysiwyg');

            value = document.getElementById('src').value;
            if ((value.search(/http:\/\//) == -1) && (value.search(/ftp:\/\//) == -1)) {
                value = '<?php echo $imagebaseurl;?>' + value;
            }
            var src = value;
            var alt = document.getElementById('alt').value;
            var width = document.getElementById('width').value
            var height = document.getElementById('height').value
            var border = document.getElementById('border').value
            var align = document.getElementById('align').value
            var vspace = document.getElementById('vspace').value
            var hspace = document.getElementById('hspace').value

            // insert image
            WYSIWYG.insertImage(src, width, height, align, border, alt, hspace, vspace, n);
            window.close();
        }

        /* ---------------------------------------------------------------------- *\
         Function    : loadImage()
         Description : load the settings of a selected image into the form fields
         \* ---------------------------------------------------------------------- */
        function loadImage() {
            var n = WYSIWYG_Popup.getParam('wysiwyg');

            // get selection and range
            var sel = WYSIWYG.getSelection(n);
            var range = WYSIWYG.getRange(sel);

            // the current tag of range
            var img = WYSIWYG.findParent("img", range);

            // if no image is defined then return
            if (img == null || img == undefined) {
                return;
            }

            // assign the values to the form elements
            for (var i = 0; i < img.attributes.length; i++) {
                var attr = img.attributes[i].name.toLowerCase();
                var value = img.attributes[i].value;
                if (attr && value && value != "null") {
                    switch (attr) {
                        case "src":
                            var val1 = /
                        <?php echo str_replace("/","\\/",$imagebaseurl); ?>/;

                            if (WYSIWYG_Core.isMSIE) {
                                value = WYSIWYG.stripURLPath(n, value, false);
                            }
                            if (value.search(val1) == 0) {
                                value = value.replace(val1, "");
                            }
                            /* " */
                            document.getElementById('src').value = value;
                            break;
                        case "alt":
                            document.getElementById('alt').value = value;
                            break;
                        case "align":
                            selectItemByValue(document.getElementById('align'), value);
                            break;
                        case "border":
                            document.getElementById('border').value = value;
                            break;
                        case "hspace":
                            document.getElementById('hspace').value = value;
                            break;
                        case "vspace":
                            document.getElementById('vspace').value = value;
                            break;
                        case "width":
                            document.getElementById('width').value = value;
                            break;
                        case "height":
                            document.getElementById('height').value = value;
                            break;
                    }
                }
            }

            // get width and height from style attribute in none IE browsers
            if (!WYSIWYG_Core.isMSIE && document.getElementById('width').value == "" && document.getElementById('width').value == "") {
                document.getElementById('width').value = img.style.width.replace(/px/, "");
                document.getElementById('height').value = img.style.height.replace(/px/, "");
            }
        }
        /* ---------------------------------------------------------------------- *\
         Function    : selectItem()
         Description : Select an item of an select box element by value.
         \* ---------------------------------------------------------------------- */
        function selectItemByValue(element, value) {
            if (element.options.length) {
                for (var i = 0; i < element.options.length; i++) {
                    if (element.options[i].value == value) {
                        element.options[i].selected = true;
                    }
                }
            }
        }

        function showpass() {
            if (document.myform.thumb.checked) {
                document.getElementById("aaa").innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		Max X: <input type=text name="max_x" id="max_x" maxlength="4" value="<?php echo $_POST['max_x'];?>"  style="font-size: 12px; width: 30px;" align="left">px&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		Max Y: <input type=text name="max_y" id="max_y" maxlength="4" value="<?php echo $_POST['max_y'];?>" style="font-size: 12px; width: 30px;" align="left">px&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick="" value="Тест">';
            } else {//TODO PREVIEW RESIZED IMAGE
                document.getElementById("aaa").innerHTML = '&nbsp';
            }
        }


        function clear_f1() {
            document.getElementById('width').value = '';
            document.getElementById('height').value = '';
            document.getElementById("test").innerHTML = '<input type=file name="file" size="37" style="font-size: 12px; width: 100%;" onchange="clear_f2();" onkeydown="clear_f2();" >';
        }

        function clear_f2() {
            document.getElementById('src').value = '';
            document.getElementById('width').value = '';
            document.getElementById('height').value = '';
        }

        function loadForm() {
            <?php if(isset($f2) && !empty($f2)){ ?>
            insertImage();//document.myform.thumb.checked = true;
            <?php }
                else{ if(isset($_POST['align']) && is_numeric($_POST['align'])){
                    echo "document.myform.align.selectedIndex = {$_POST['align']}";
                }
            ?>
            loadImage();
            <?php } ?>
        }


    </script>
</head>
<body bgcolor="#EEEEEE" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" onload="loadForm();">
<form method=post action="<?php echo $_SERVER['PHP_SELF']; ?>?wysiwyg=<?php echo $wysiwyg; ?>" name="myform" enctype="multipart/form-data" onsubmit="return mySubmit();">
    <input type=hidden id="dir" name="dir" value="">
    <table border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
        <tr>
            <td style="vertical-align:top;">
                <span style="font-family: arial, verdana, helvetica; font-size: 12px; font-weight: bold;">Вставити зображення:</span>
                <table width="405" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
                    <?php
                    if ($allowuploads) {
                        ?>
                        <tr>
                            <td style="padding-top: 7px;padding-bottom: 0px; font-family: arial, verdana, helvetica; font-size: 12px;width:100px;">Завантажити:</td>
                            <td style="padding-top: 7px;padding-bottom: 0px;width:300px;"><span id="test"><input type=file name="file" size="37"
                                                                                                                 style="font-size: 12px; width: 100%;" onchange="clear_f2()"
                                                                                                                 onkeydown="clear_f2();"></span></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 1px;padding-bottom: 7px;font-family: tahoma; font-size: 10px;">&nbsp;</td>
                            <td style="padding-top: 1px;padding-bottom: 7px;font-family: tahoma; font-size: 10px;"><?php echo $errormsg; ?></td>
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
                        <td style="padding-bottom: 6px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;" width="80">URL адреса:</td>
                        <td style="padding-bottom: 6px; padding-top: 0px;" width="300"><input type=text name="src" id="src" value="<?php echo @$_POST['src']; ?>"
                                                                                              onchange="clear_f1();" onkeyup="clear_f1();x1()"
                                                                                              style="font-size: 12px; width: 100%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 4px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">Коментар:</td>
                        <td style="padding-bottom: 4px; padding-top: 0px;"><input type=text name="alt" id="alt" value="<?php echo @$_POST['alt']; ?>"
                                                                                  style="font-size: 12px; width: 100%;"></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 4px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">        <?php if ($allowuploads) { ?>
                                Зменшити до:
                            <?php } ?>
                        </td>
                        <td style="padding-bottom: 4px; padding-top: 0px;font-family: arial, verdana, helvetica; font-size: 12px;">

                            <input type=checkbox name="thumb" id="thumb" value="1" onclick="showpass()" style="margin-left:0; height:21px;">
                            <span id="aaa"></span>

                        </td>
                    </tr>
                </table>

                <table width="405" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="vertical-align:top;padding-top:20px; ">
                            <span style="font-family: arial, verdana, helvetica; font-size: 12px; font-weight: bold;">Примочки:</span>
                            <table width="180" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
                                <tr>
                                    <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">Width:</td>
                                    <td style="width:60px;padding-bottom: 2px; padding-top: 0px;"><input type=text name="width" id="width" value="<?php echo $orig_x; ?>"
                                                                                                         style="font-size: 11px; width: 100%;color:#777777; background-color: #eeeeee;"
                                                                                                         maxlength="4"></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">Height:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="padding-bottom: 2px; padding-top: 0px;"><input type=text name="height" id="height" value="<?php echo $orig_y; ?>"
                                                                                              style="font-size: 11px; width: 100%;color:#777777; background-color: #eeeeee;"
                                                                                              maxlength="4"></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">Border:</td>
                                    <td style="padding-bottom: 2px; padding-top: 0px;"><input type=text name="border" id="border" value="<?php echo $_POST['border']; ?>"
                                                                                              style="font-size: 11px; width: 100%;color:#777777; background-color: #eeeeee;"
                                                                                              maxlength="4"></td>
                                </tr>
                            </table>

                        </td>
                        <td width="10">&nbsp;</td>
                        <td style="vertical-align:top;padding-top:10px; ">

                            <span style="font-family: arial, verdana, helvetica; font-size: 12px; font-weight: bold;">&nbsp;</span>
                            <table width="220" border="0" cellpadding="0" cellspacing="0"
                                   style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;margin-top:10px">
                                <tr>
                                    <td style="width: 135px;padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;" width="100">
                                        Alignment:
                                    </td>
                                    <td style="width: 85px;padding-bottom: 2px; padding-top: 0px;">
                                        <select name="align" id="align"
                                                style="font-family: arial, verdana, helvetica; font-size: 12px; width: 100%;color:#777777; background-color: #eeeeee;">
                                            <option value="">Not Set</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                            <option value="texttop">Texttop</option>
                                            <option value="absmiddle">Absmiddle</option>
                                            <option value="baseline">Baseline</option>
                                            <option value="absbottom">Absbottom</option>
                                            <option value="bottom">Bottom</option>
                                            <option value="middle">Middle</option>
                                            <option value="top">Top</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">Horizontal Space:</td>
                                    <td style="padding-bottom: 2px; padding-top: 0px;"><input type=text name="hspace" id="hspace" value="<?php echo $_POST['hspace']; ?>"
                                                                                              style="font-size: 11px; width: 100%;color:#777777; background-color: #eeeeee;"></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 12px;">Vertical Space:</td>
                                    <td style="padding-bottom: 2px; padding-top: 0px;"><input type=text name="vspace" id="vspace" value="<?php echo $_POST['vspace']; ?>"
                                                                                              style="font-size: 11px; width: 100%;color:#777777; background-color: #eeeeee;"></td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top;width: 250px; padding-left: 5px;">
                <span style="font-family: arial, verdana, helvetica; font-size: 12px; font-weight: bold;">Виберіть з галереї:</span>
                <iframe id="chooser" frameborder="0" style="height:255px;width: 270px;border: 2px solid #FFFFFF; padding:0; z-index:20;position:relative;"
                        src="select_image.php?dir=<?php echo $leadon; ?>"></iframe>
                <img id="img_" src="<?php echo @$_POST['src']; ?>"
                     style="height:255px;width: 270px;border: 2px solid #FFFFFF; padding:0; position:absolute;top:25px;left:420px;opacity:0.2;z-index:10;">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right" style="padding-top: 5px;">
                <input type=submit value="  Зберегти  " style="font-size: 14px;">&nbsp;
                <input type=button value="  Відмінити  " onclick="window.close();" style="font-size: 14px;">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
