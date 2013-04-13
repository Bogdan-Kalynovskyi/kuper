// FancyZoomHTML.js - v1.0
// Used to draw necessary HTML elements for FancyZoom
//
// Copyright (c) 2008 Cabel Sasser / Panic Inc
// All rights reserved.

function insertZoomHTML() {

    // All of this junk creates the three <div>'s used to hold the closebox, image, and zoom shadow.

    var inBody = document.getElementsByTagName("body").item(0);

    // WAIT SPINNER

    var inSpinbox = document.createElement("div");
    inSpinbox.setAttribute('id', 'ZoomSpin');
    inSpinbox.style.position = 'absolute';
    inSpinbox.style.left = '10px';
    inSpinbox.style.top = '10px';
    inSpinbox.style.visibility = 'hidden';
    inSpinbox.style.zIndex = '525';
    inBody.insertBefore(inSpinbox, inBody.firstChild);

    var inSpinImage = document.createElement("img");
    inSpinImage.setAttribute('id', 'SpinImage');
    inSpinImage.setAttribute('src', zoomImagesURI + 'zoom-spin-1.png');
    inSpinbox.appendChild(inSpinImage);

    // ZOOM IMAGE
    //
    // <div id="ZoomBox">
    //   <a href="zoomOut();"><img src="/images/spacer.gif" id="ZoomImage" border="0"></a> <!-- THE IMAGE -->
    //   <div id="ZoomClose">
    //     <a href="zoomOut();"><img src="/images/closebox.png" width="30" height="30" border="0"></a>
    //   </div>
    // </div>

    var inZoombox = document.createElement("div");
    inZoombox.setAttribute('id', 'ZoomBox');

    inZoombox.style.position = 'absolute';
    inZoombox.style.left = '10px';
    inZoombox.style.top = '10px';
    inZoombox.style.visibility = 'hidden';
    inZoombox.style.zIndex = '499';

    inBody.insertBefore(inZoombox, inSpinbox.nextSibling);

    var inImage1 = document.createElement("img");
    inImage1.onclick = function (event) {
        zoomOut(this, event);
        return false;
    };
    inImage1.setAttribute('src', zoomImagesURI + 'spacer.gif');
    inImage1.setAttribute('id', 'ZoomImage');
    inImage1.setAttribute('border', '0');
    // inImage1.setAttribute('onMouseOver', 'zoomMouseOver();')
    // inImage1.setAttribute('onMouseOut', 'zoomMouseOut();')

    // This must be set first, so we can later test it using webkitBoxShadow.
    inImage1.setAttribute('style', '-webkit-box-shadow: ' + shadowSettings + '0.0)');
    inImage1.style.display = 'block';
    inImage1.style.width = '10px';
    inImage1.style.height = '10px';
    inImage1.style.cursor = 'pointer'; // -webkit-zoom-out?
    inZoombox.appendChild(inImage1);

    var inClosebox = document.createElement("div");
    inClosebox.setAttribute('id', 'ZoomClose');
    inClosebox.style.position = 'absolute';

    // In MSIE, we need to put the close box inside the image.
    // It's 2008 and I'm having to do a browser detect? Sigh.
    if (browserIsIE) {
        inClosebox.style.left = '-1px';
        inClosebox.style.top = '0px';
    } else {
        inClosebox.style.left = '-15px';
        inClosebox.style.top = '-15px';
    }

    inClosebox.style.visibility = 'hidden';
    inZoombox.appendChild(inClosebox);

    var inImage2 = document.createElement("img");
    inImage2.onclick = function (event) {
        zoomOut(this, event);
        return false;
    };
    inImage2.setAttribute('src', zoomImagesURI + 'closebox.png');
    inImage2.setAttribute('width', '30');
    inImage2.setAttribute('height', '30');
    inImage2.setAttribute('border', '0');
    inImage2.style.cursor = 'pointer';
    inClosebox.appendChild(inImage2);

    // SHADOW
    // Only draw the table-based shadow if the programatic webkitBoxShadow fails!
    // Also, don't draw it if we're IE -- it wouldn't look quite right anyway.


    if (includeCaption) {

        // CAPTION
        //
        // <div id="ZoomCapDiv" style="margin-left: 13px; margin-right: 13px;">
        // <table border="1" cellpadding="0" cellspacing="0">
        // <tr height="26">
        // <td><img src="zoom-caption-l.png" width="13" height="26"></td>
        // <td rowspan="3" background="zoom-caption-fill.png"><div id="ZoomCaption"></div></td>
        // <td><img src="zoom-caption-r.png" width="13" height="26"></td>
        // </tr>
        // </table>
        // </div>

        var inCapDiv = document.createElement("div");
        inCapDiv.setAttribute('id', 'ZoomCapDiv');
        inCapDiv.style.position = 'absolute';
        inCapDiv.style.visibility = 'hidden';
        inCapDiv.style.marginLeft = 'auto';
        inCapDiv.style.marginRight = 'auto';
        inCapDiv.style.zIndex = '501';

        inBody.insertBefore(inCapDiv, inZoombox.nextSibling);

        var inCapTable = document.createElement("table");
        inCapTable.setAttribute('border', '0');
        inCapTable.setAttribute('cellPadding', '0');	// Wow. These honestly need to
        inCapTable.setAttribute('cellSpacing', '0');	// be intercapped to work in IE. WTF?
        inCapDiv.appendChild(inCapTable);

        var inTbody = document.createElement("tbody");	// Needed for IE (for HTML4).
        inCapTable.appendChild(inTbody);

        var inCapRow1 = document.createElement("tr");
        inTbody.appendChild(inCapRow1);

        var inCapCol1 = document.createElement("td");
        inCapCol1.setAttribute('align', 'right');
        inCapRow1.appendChild(inCapCol1);
        var inCapImg1 = document.createElement("img");
        inCapImg1.setAttribute('src', zoomImagesURI + 'zoom-caption-l.png');
        inCapImg1.setAttribute('width', '13');
        inCapImg1.setAttribute('height', '26');
        inCapImg1.style.display = 'block';
        inCapCol1.appendChild(inCapImg1);

        var inCapCol2 = document.createElement("td");
        inCapCol2.style.background = '#1a1a1a';
        inCapCol2.setAttribute('id', 'ZoomCaption');
        inCapCol2.setAttribute('valign', 'middle');
        inCapCol2.style.fontSize = '14px';
        inCapCol2.style.fontFamily = 'Helvetica';
        inCapCol2.style.fontWeight = 'bold';
        inCapCol2.style.color = '#ffffff';
        inCapCol2.style.textShadow = '0px 2px 4px #000000';
        inCapCol2.style.whiteSpace = 'nowrap';
        inCapRow1.appendChild(inCapCol2);

        var inCapCol3 = document.createElement("td");
        inCapRow1.appendChild(inCapCol3);
        var inCapImg2 = document.createElement("img");
        inCapImg2.setAttribute('src', zoomImagesURI + 'zoom-caption-r.png');
        inCapImg2.setAttribute('width', '13');
        inCapImg2.setAttribute('height', '26');
        inCapImg2.style.display = 'block';
        inCapCol3.appendChild(inCapImg2);
    }
}