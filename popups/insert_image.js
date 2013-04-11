function addslashes( str ) {
return (str+'').replace(/([\\"'])/g, "\\$1").replace(/\0/g, "\\0");
}
function myrep( str ) {
		var val1 = new RegExp(addslashes(ibu));
		return str.replace(val1, "");
}
/* ---------------------------------------------------------------------- *\
  Function    : insertImage()
  Description : Inserts image into the WYSIWYG.
\* ---------------------------------------------------------------------- */
function mySubmit() {
	
	if(!document.myform.thumb.checked && (document.myform.file.value=='') && document.getElementById('src').value != ''  ){
		return true;
/*
		var newImg = new Image();
		newImg.src = document.getElementById('src').value;
		document.getElementById('height').value  = newImg.height;
		document.getElementById('width').value  = newImg.width;
	 	insertImage(); 
	 	
	 	//window.close();*/
 	}
	if(document.myform.thumb.checked || (document.myform.file.value!=''))
 		return true;

	return false;
}

function check() {
  var ext = document.getElementById('src').value;
  if(!ext )return false;
	ext =  (ext!="undefined") ? ext.substring(ext.lastIndexOf(".")+1, ext.length).toLowerCase() : false;
  if(ext != 'jpg' && ext != 'jpeg' && ext != 'gif' && ext != 'png' && ext != 'bmp') {
    alert('��� ���� �� ����������� ���������� --> '+ext);
    return false; }
  return true; 
}


function insertImage() {	if(!check())return;
	var n = WYSIWYG_Popup.getParam('wysiwyg');
	 
	value = document.getElementById('src').value;
if( (value.search(/http:\/\//)==-1) && (value.search(/ftp:\/\//)==-1)	)
{
	value = ibu+value;
}
	var src = value;
	var alt = document.getElementById('alt').value;
	var width = document.getElementById('width').value;
	var height = document.getElementById('height').value;
	var border = document.getElementById('border').value;
	var align = document.getElementById('align').value;
	var color = document.getElementById('color').value;
	var space = document.getElementById('space').value;
	var styleClass = document.getElementById('linkClass').value;
	
	// insert image
	WYSIWYG.insertImage(src, width, height, align, border, alt, space, color, n, styleClass);
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
	if(img == null || img == undefined) return;
	document.getElementById('ccc').innerHTML = "������ �������";
	// assign the values to the form elements
	for(var i = 0;i < img.attributes.length;i++) {
		var attr = img.attributes[i].name.toLowerCase();
		var value = img.attributes[i].value;
		if(attr && value && value != "null" && value != undefined) {
			switch(attr) {
				case "src": 
					if(WYSIWYG_Core.isMSIE) value = WYSIWYG.stripURLPath(n, value, false);
					value=myrep(value);
					document.getElementById('src').value = value;
				break;
				case "title":
					document.getElementById('alt').value = value;
				break;
				case "alt":
					document.getElementById('alt').value = value;
				break;
				case "width":
					document.getElementById('width').value = value;
				break;
				case "height":
					document.getElementById('height').value = value;
				break;				
				case "hspace":
					document.getElementById('space').value = value;
				break;
				case "vspace":
					document.getElementById('space').value = value;
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
	
//	if(!WYSIWYG_Core.isMSIE) {
		document.getElementById('width').value = img.style.width.replace(/px/, "");
		document.getElementById('height').value = img.style.height.replace(/px/, "");
		document.getElementById('border').value = img.style.borderWidth.replace(/px/, "");
		document.getElementById('space').value = img.style.margin.replace(/px/, "");
		document.getElementById('color').value = img.style.borderColor;
		selectItemByValue(document.getElementById('align'), img.style.float);
		
//	}
}
/* ---------------------------------------------------------------------- *\
  Function    : selectItem()
  Description : Select an item of an select box element by value.
\* ---------------------------------------------------------------------- */
function selectItemByValue(element, value) {
	if(element.options.length) {
		for(var i=0;i<element.options.length;i++) {
			if(element.options[i].value == value) {
				element.options[i].selected = true;
			}
		}
	}
}


function clear_f1() {
	document.getElementById('width').value='';
	document.getElementById('height').value='';
	document.getElementById("test").innerHTML=
		'<input type="file" name="file" size="30" style="font-size: 12px; width: 100%;" accept="image/gif, image/jpeg, image/png, image/bmp" onchange="clear_f2();" onkeydown="clear_f2();" >';
}

function clear_f2() {
	document.getElementById('src').value='';
	document.getElementById('width').value='';
	document.getElementById('height').value='';
}

function slideshow(){
	myform.action = "slideshow.php?wysiwyg="+WYSIWYG_Popup.getParam('wysiwyg');
	myform.submit();
}

function popwin(){
	var lnk = myrep(document.getElementById('src').value);
	
	var wnd = window.open('../'+ibu+lnk,'','toolbar=No,menubar=No,left=200,top=200,width=900,resizable=yes,scrollbars=yes,status=No,location=No,height=700');
	wnd.document.onclick = 'window.close()';
}
/*  deletiopn of php imagebaseurl can be deleted!!!! ins no longer here*/