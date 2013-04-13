<?php header("Content-type: text/html; charset=utf-8"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <metacharset
    =utf-8" >
    <title> <?php echo "Створити нову сторінку"; ?> </title>
</head>
<script src="../scripts/wysiwyg-popup.js"></script>

<script>
    <!--

    function insertHyperLink() {
        var n = WYSIWYG_Popup.getParam('wysiwyg');
        var blog = WYSIWYG_Popup.getParam('blog');
//	var blog_file = WYSIWYG_Popup.getParam('blog_file');
        var iid = WYSIWYG_Popup.getParam('id');
        var title = document.getElementById('title').value;

        // insert link
        var x = '../user.php?action=new_post&blog=' + blog + '&nest=' + iid + '&wysiwyg=' + n;
//alert(x);

        newwin(x);
    }


    function newwin(url) {
        var width = 1131;
        var height = 800;
        var screenX = (screen.width / 2 - width / 2);
        var screenY = (screen.height / 2 - height / 2);
        var features = "width=" + width + ",height=" + height;
        features += ",screenX=" + screenX + ",left=" + screenX;
        features += ",screenY=" + screenY + ",top=" + screenY;
        features += ",+resizable=Yes,scrollbars=Yes,location=Yes";
        //self.resizeTo(width,height);
        window.moveTo(0, 0);


        window.open(url, "_blank", features).focus();

    }

    function loadLink() {
        // get params
        var n = WYSIWYG_Popup.getParam('wysiwyg');
        // get selection and range
        var sel = WYSIWYG.getSelection(n);
        var range = WYSIWYG.getRange(sel);
        if (WYSIWYG.emptySelection(range)) {
            alert("Спочатку виділіть текст, який буду перетворено в гіперссилку ! ");
        }

        document.getElementById('title').value = range;
        if (WYSIWYG_Core.isMSIE) {
            document.getElementById('title').value = range.htmlText;
        }
    }
    -->
</script>

<body style="margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
	background: #EEEEEE;
	font: 12px Tahoma, Verdana, Arial;
	font-size:100.01%;"
      onLoad="loadLink();">

<table border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
    <tr>
        <td>

            <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Створити нову сторінку:</span>
            <table width="330" border="0" cellpadding="1" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
                <tr>
                    <td style="padding: 2px; width: 50px; font-family: arial, verdana, helvetica; font-size: 11px;">Назва сторінки:</td>
                    <td style="padding: 2px;" colspan="3">
                        <input type=text name="title" id="title" value="" style="font-size: 10px; width: 100%;">
                    </td>
                </tr>
            </table>


            <div align="right" style="padding-top: 5px;"><input type=submit value="      ОК      " onclick="insertHyperLink();" style="font-size: 12px;">&nbsp;<input
                    type=button value="  Cancel  " onclick="window.close();" style="font-size: 12px;"></div>

</table>


</body>
</html>

