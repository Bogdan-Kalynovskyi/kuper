function addslashes(str) {
    return (str + '').replace(/([\\"'])/g, "\\$1").replace(/\0/g, "\\0");
}
function myrep(str) {
    var val1 = new RegExp(addslashes(ibu));
    return str.replace(val1, "");
}
/* ---------------------------------------------------------------------- *\
 Function    : insertImage()
 Description : Inserts image into the WYSIWYG.
 \* ---------------------------------------------------------------------- */

function insertHyperLink() {
    var n = WYSIWYG_Popup.getParam('wysiwyg');

    value = document.getElementById('src').value;
    if ((value.search(/http:\/\//) == -1) && (value.search(/https:\/\//) == -1) && (value.search(/ftp:\/\//) == -1)) {
        value = ibu + value;
    }
    var href = value;
    var target = document.getElementById('linkTarget').value;
    var style = document.getElementById('linkStyle').value;
    var styleClass = document.getElementById('linkClass').value;
    var name = document.getElementById('linkName').value;
    var title = document.getElementById('title').value;

    WYSIWYG.insertLink(href, target, style, styleClass, name, n, title);
    window.close();
}


/* ---------------------------------------------------------------------- *\
 Function    : loadImage()
 Description : load the settings of a selected image into the form fields
 \* ---------------------------------------------------------------------- */
function loadSelection() {
    // get params
    var n = WYSIWYG_Popup.getParam('wysiwyg');
    // get selection and range
    var sel = WYSIWYG.getSelection(n);
    var range = WYSIWYG.getRange(sel);
    if (WYSIWYG.emptySelection(range)) {
        alert("—початку вид≥л≥ть текст, €кий буду перетворено в г≥перссилку ! ");
    }
    var lin = null;
    if (WYSIWYG_Core.isMSIE) {
        if (sel.type == "Control" && range.length == 1) {
            range = WYSIWYG.getTextRange(range(0));
            range.select();
        }
        if (sel.type == 'Text' || sel.type == 'None') {
            sel = WYSIWYG.getSelection(n);
            range = WYSIWYG.getRange(sel);
            // find a as parent element
            lin = WYSIWYG.findParent("a", range);
        }
    } else {
        // find a as parent element
        lin = WYSIWYG.findParent("a", range);
    }

    // if no link as parent found exit here
    if (lin == null || lin == undefined) {
        return;
    }
    document.getElementById('ccc').innerHTML = "«м≥нити посиланн€ на файл";
    // set form elements with attribute values
    for (var i = 0; i < lin.attributes.length; i++) {
        var attr = lin.attributes[i].name.toLowerCase();
        var value = lin.attributes[i].value;
        if (attr && value && value != "null" && value != undefined) {
            switch (attr) {
                case "href":
                    if (WYSIWYG_Core.isMSIE) {
                        value = WYSIWYG.stripURLPath(n, value, false);
                    }
                    value = myrep(value);
                    document.getElementById('src').value = value;
                    break;
                case "target":
                    document.getElementById('linkTarget').value = value;
                    selectItemByValue(document.getElementById('linkTargetChooser'), value);
                    break;
                case "title":
                    document.getElementById('title').value = value;
                    break;
                case "name":
                    document.getElementById('linkName').value = value;
                    break;
                case "class":
                    document.getElementById('linkClass').value = value;
                    break;
                case "classname":
                    document.getElementById('linkClass').value = value;
                    break;

            }
        }
    }

    // Getting style attribute of the link separately, because IE interprets the
    // style attribute is an complex object, and do not return a text stylesheet like Mozilla.
    document.getElementById('linkStyle').value = WYSIWYG_Core.replaceRGBWithHexColor(WYSIWYG_Core.getAttribute(lin, "style"));
}

/* ---------------------------------------------------------------------- *\
 Function    : selectItem()
 Description : Select an item of an select box element by value.
 \* ---------------------------------------------------------------------- */

function updateTarget(value) {
    document.getElementById('linkTarget').value = value;
}

function selectItemByValue(element, value) {
    if (element.options.length) {
        for (var i = 0; i < element.options.length; i++) {
            if (element.options[i].value == value) {
                element.options[i].selected = true;
                return;
            }
        }
        element.options[(element.options.length - 1)].selected = true;
    }
}


function mySubmit() {

    if (document.myform.file.value == '' && document.getElementById('src').value != '') {
        insertHyperLink();
        return false;
    }
    if ((document.myform.file.value != '')) {
        return true;
    }

    return false;
}


function clear_f1() {
    document.getElementById("test").innerHTML = '<input type="file" name="file" size="30" style="font-size: 12px; width: 100%;"  accept="image/gif, image/jpeg, image/png, image/bmp" onchange="clear_f2();" onkeydown="clear_f2();" >';
}

function clear_f2() {
    document.getElementById('src').value = '';
}