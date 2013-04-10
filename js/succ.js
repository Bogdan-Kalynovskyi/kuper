	var lazer = document.createElement("div");
	var lazer.innerHTML = 
	
'<div id="ZoomSpin" style="position:absolute;visibility:hidden;display:none;z-index:555;cursor:pointer">\
	 <img id="SpinImage" src="ajax-loader.gif" alt="loading..." onclick="preloadingStop" />\
</div>
<div id="dim2" style="background:#000; cursor:-webkit-zoom-out;cursor:-moz-zoom-out;cursor:zoom-out; opacity:0;filter:alpha(opacity=0); position:fixed;width:100%;height:100%; z-index:32; display:none"></div>\
	<div id="ZoomBox">
	   <img src="'+zoomImagesURI+'spacer.gif" id="ZoomImage" onclick="zoomOut()" />
	   <div id="ZoomClose">
	    	<img src="'+zoomImagesURI+'closebox.png" alt="" onclick="zoomOut()"/>
	   </div>
	 </div>
	
	<style>
		#ZoomClose:hover{margin-top:2px;}
	</style>
	
	<div id="ZoomCapDiv" style="margin-left: 13px; margin-right: 13px;">
	<table border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td><img src="zoom-caption-l.png" width="13" height="26"></td>
	<td rowspan="3" background="zoom-caption-fill.png"><div id="ZoomCaption"></div></td>
	<td><img src="zoom-caption-r.png" width="13" height="26"></td>
	</tr>
	</table>
	</div>	 
	 '


	if (browserIsIE) {
		inClosebox.style.left = '-1px';
		inClosebox.style.top = '0px';	
	} else {
		inClosebox.style.left = '-15px';
		inClosebox.style.top = '-15px';
	}
	
	//rounded cornerrs instead of images in caption