function loadImage() {
    var n = WYSIWYG_Popup.getParam('wysiwyg');

    // get selection and range
    var sel = WYSIWYG.getSelection(n);
    var range = WYSIWYG.getRange(sel);

    // the current tag of range
    var img = WYSIWYG.findParent("a", range);

    // if no image is defined then return
    if (img == null || img == undefined) {
        return;
    }

    // assign the values to the form elements
    for (var i = 0; i < img.attributes.length; i++) {
        var attr = img.attributes[i].name.toLowerCase();
        var value = img.attributes[i].value;	//  /\[([^\]]*)\]/
        if (attr == "rel" && value && value != "null" && value != "undefined") {
            myform.task.value = '000';
            myform.slideshow.value = value;
            myform.submit();
        }
    }

    var img = WYSIWYG.findParent("img", range);

    // if no image is defined then return
    if (img == null || img == undefined) {
        return;
    }

    // assign the values to the form elements
    /*	for(var i = 0;i < img.attributes.length;i++) {
     var attr = img.attributes[i].name.toLowerCase();
     var value = img.attributes[i].value;	//  /\[([^\]]*)\]/
     if(attr && value && value != "null" && value != "undefined") {
     switch(attr) {
     case "width":
     //					document.getElementByNames('max_x')[0].value  = value;
     break;
     case "height":
     //					document.getElementByNames('max_y')[0].value = value;
     break;
     }
     }
     }
     */
    var a = document.getElementsByName('max_x');
    var b = img.style.width.replace(/px/, "");
    if (a[0].value == '' && b) {
        a[0].value = b;
    }
    var a = document.getElementsByName('max_y');
    var b = img.style.height.replace(/px/, "");
    if (a[0].value == '' && b) {
        a[0].value = b;
    }

}


function do_(act, n) {
    myform.task.value = act;
    myform.pic_num.value = n;
    myform.submit();
}

function clear_f1(the, n) {
    document.getElementById("aaa" + n).innerHTML = '&nbsp;&nbsp;Файл :&nbsp;<input type="file" name="file1">';
    the.onclick = 'do_("ren_pic", ' + n + ')';
    the.value = "     Завантажити    ";
}


function popwin(src) {

    var wnd = window.open(src, '', 'toolbar=No,menubar=No,left=200,top=200,width=900,resizable=yes,scrollbars=yes,status=No,location=No,height=700');
    wnd.document.onclick = 'window.close()';
}
