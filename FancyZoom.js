var includeDim = true;
var includeCaption = true;
var zoomTime = 12;//ms
var zoomSteps = 10;//max. will vary
var includeFade = 0;//turned off for low cpus
var zoomBorder = 13;//nice white border
var minBorder = 100;//from screen edges
var shadowSettings = '0px 0px ' + (parseInt(minBorder / 2) - zoomBorder) * 2 + 'px rgba(0, 0, 0, ';//corners//todo ???
var CPU = 300, START, zoomCurrent;

var MY_URL = 'http://kuperfild.ru';

//CPU testing

var myWidth, myHeight, myScrollx, myScrolly, myScrollWidth, myScrollHeight, click_pos_x, click_pos_y;

var zoomOpen = false, zoomRunning = false, preloadTime = 0, 				//time from start preloading. used to kill hanging preloads
    imgPreload = new Image(), preloadClicked = false;
preloadAnimation = false;		//if we should display spinner cause user clicked zoom

var savedClick, savedKeyPress;
var zoomTimer, execWhenDone = null;//temp globals
var zoomStartX, zoomStartY, zoomStartW, zoomStartH, zoomStartF, zoomChangeX, zoomChangeY, zoomChangeW, zoomChangeH, zoomChangeF, zoomOrigW, zoomOrigH, zoomOrigX, zoomOrigY;
var moveX, moveY, moveH, moveW, moveF;

var zoomID = "ZoomBox";
var theID = "ZoomImage";
var zoomCaption = "ZoomCaption";
var zoomCaptionDiv = "ZoomCapDiv";
var zoomSpinID = "ZoomSpin";
var zoomShadowID = "ShadowBox";

var zoomDiv, zoomImg, zoomCap, zoomSpin;


//preload total clear
//roomin total clear
//zoomout total clear


//window onLoad. injection
function setupZoom() {
    var links = document.getElementsByTagName("a");
    var l = links.length;
    for (i = 0; i < l; i++) {//TODO TEST//or spec class
        with (links[i]) {
            if (href.search(/(.*)\.(jpg|jpeg|gif|png)/gi) != -1) {
                onclick = iZoomClick;
                onmouseover = iZoomPreload;
                style.cursor = '-moz-zoom-in';
            }
        }
    }
}


function iZoomPreload() {
    zoomPreload(this.href);
}

function zoomPreload(src) {

    if (imgPreload) {
        if (imgPreload.src != src && imgPreload.src != MY_URL + src) {
            imgPreload.onload = null;
        } else {
            return;
        }
    }

    imgPreload = new Image();

    preloadTime = setTimeout(preloadingStop, 25000);
    imgPreload.onload = preloadingComplete;

    imgPreload.src = src;

}


function preloadingStop() {

    if (imgPreload) {
        imgPreload.onload = null;
    }

    clearTimeout(preloadTime);

    preloadClicked = false;

    if (preloadAnimation) {
        preloadAnimFinish();
    }
}


function preloadingComplete() {//successfull event

    if (preloadClicked) {

        preloadingStop();//makes preloadClicked = false
        zoomIn();

    } else {

        preloadingStop();

    }
}


// Zoom: Start the preloading animation cycle.
function preloadAnimStart() {
    preloadAnimation = true;
    zoomSpin.style.left = click_pos_x - zoomSpin.offsetWidth / 2 + 'px';
    zoomSpin.style.top = click_pos_y - zoomSpin.offsetHeight / 2 + 'px';
    zoomSpin.style.display = "block";//todo test!!!!!
    setTimeout('zoomSpin.onclick=function(e){cancelEvent(e);preloadingStop();imgPreload=null}', 800);
}
function preloadAnimFinish() {
    preloadAnimation = false;
    zoomSpin.style.display = "none";
    zoomSpin.onclick = null;
}


//****************************** ZOOM CLICK: *************************************
// todo?: i don't beleive complete fires onload event
function iZoomClick(e) {
    var child = this.firstChild.firstChild;
    return zoomClick(child, this.href, this.title, e)
}

function zoomClick(from, src, zzzz, e) {//starter id,  fullsize src, 
    if (zoomRunning) {
        return false;
    }

    if (metaEvent(e)) {
        return true;
    }

    if (typeof zoomSpin == undefined || !zoomSpin) {
        insertZoomHTML();//todo optimize

        zoomSpin = $(zoomSpinID);
        zoomDiv = $(zoomID);
        zoomImg = $(theID);
        zoomCap = $(zoomCaptionDiv);
        zoomShadow = $(zoomShadowID);

    }


/////////////////////////////////////////// ми можемо блять переключитись з одного зуьу на 1нший п1д час прелоад1нгу

    preloadFrom = from;
    preloadSrc = src;
    preloadz = zzzz;

//screen
    getSize(e);

//picture
    zoomPreload(src);


    if (imgPreload.complete) {

        zoomIn(e);

    } else {

        preloadClicked = true;
        preloadAnimStart();

    }

    return false;

}


// Zoom: Move an element in to endH endW, using zoomHost as a starting point.
// "from" is an object reference to the href that spawned the zoom.

function zoomIn() {

    if (zoomRunning) {
        return;
    }
    if (typeof e == 'object') {
        cancelEvent(e);
    }
    zoomRunning = true;		// 5 lock from other actions while zooming //why? - for no bugs =)


    zoomImg.src = preloadSrc;

//start
    zoomStartW = preloadFrom.offsetWidth;
    zoomStartH = preloadFrom.offsetHeight;

//finish
    endW = imgPreload.width;
    endH = imgPreload.height;
    imgPreload = null;

    if (includeCaption && preloadz) {
        $(zoomCaption).innerHTML = preloadz;
    }

    // Store original position in an array for future zoomOut.

    zoomOrigW = zoomStartW;
    zoomOrigH = zoomStartH;
    zoomOrigX = zoomStartX;
    zoomOrigY = zoomStartY;


    // If it's too big to fit in the window, shrink the width and height to fit (with ratio).

    sizeRatio = endW / endH;
    if (endW > myWidth - minBorder) {
        endW = myWidth - minBorder;
        endH = endW / sizeRatio;
    }
    if (endH > myHeight - minBorder) {
        endH = myHeight - minBorder;
        endW = endH * sizeRatio;
    }

    zoomChangeX = ((myWidth / 2) - (endW / 2) - zoomStartX);
    zoomChangeY = ((myHeight / 2) - (endH / 2) - zoomStartY);
    zoomChangeW = (endW - zoomStartW);
    zoomChangeH = (endH - zoomStartH);

    // Setup Fade with Zoom, If Requested

    if (includeFade) {
        zoomStartF = 0;
        zoomChangeF = 100;
    } else {
        setOpacity(100, zoomDiv);
    }


/////////////////////////////


    // Get keypresses
    savedKeyPress = document.onkeypress;
    document.onkeypress = getKey1;

    savedClick = document.onclick;
    document.onclick = zoomOut;


    //number of steps left. can change
    // Setup Zoom
///////////////////////////////////////		

    tempSteps = zoomSteps;

    START = new Date().getTime();

    zoomCurrent = 0;

///////////////////////////////////////

    execWhenDone = zoomDoneIn;

    zoomTimer = setInterval(zoomElement, zoomTime);

}

// Zoom it back out.

function zoomOut(e) {

    if (metaEvent(e)) {
        return true;
    }
    /*for right - click*/
    cancelEvent(e);
    if (zoomRunning) {
        return false;
    }
    zoomRunning = true;

    zoomBeforeOut(e);//exec

    // Now, figure out where we came from, to get back there

    zoomStartX = parseInt(zoomDiv.style.left);
    zoomStartY = parseInt(zoomDiv.style.top);
    zoomStartW = zoomImg.width;
    zoomStartH = zoomImg.height;
    zoomChangeX = zoomOrigX - zoomStartX;
    zoomChangeY = zoomOrigY - zoomStartY;
    zoomChangeW = zoomOrigW - zoomStartW;
    zoomChangeH = zoomOrigH - zoomStartH;

    // Setup Fade with Zoom, If Requested

    if (includeFade) {
        zoomStartF = 100;
        zoomChangeF = -100;
    }


    // Setup Zoom
//////////////
    zoomCurrent = 0;

    START = new Date().getTime();

    tempSteps = zoomSteps;
///////////////
    execWhenDone = zoomDone;

    zoomTimer = setInterval(zoomElement, zoomTime);

}


// Finished Zooming In

function zoomDoneIn() {

    // Note that it's open

    zoomOpen = true;

    //border

    /*zoomImg.style.width = imgPreload.width + 'px';
     zoomImg.style.height = imgPreload.height + 'px';bug!!!!!!!!??????*/
    zoomImg.style.border = zoomBorder + 'px solid #eee';
    zoomDiv.style.left = moveX - zoomBorder + 'px';
    zoomDiv.style.top = moveY - zoomBorder + 'px';

    //fade

    if (includeFade) {
        setOpacity(100, zoomDiv);
    }

    //shadow

    if (!ie) {
        // Or, do a fade of the modern shadow
        TINY.shadow.set(zoomImg, 0, 1, 9);
    }

    // Position and display the CAPTION, if existing

    if (includeCaption && preloadz) {

        zoomCap.style.top = parseInt(zoomDiv.offsetTop) + (zoomDiv.offsetHeight + 4) + 'px';
        zoomCap.style.left = (myWidth / 2) - (zoomCap.offsetWidth / 2) + 'px';
        fadein(zoomCap);
    }

    // Display Close Box (fade it if it's not IE)

    fadein($("ZoomClose"));


    // Display the Dim
    $('dim2').style.display = 'block';
    TINY.alpha.set('dim2', 54, 5);

}


function zoomBeforeOut(e) {

    //border

    zoomImg.style.border = '0';
    zoomDiv.style.left = moveX + 'px';
    zoomDiv.style.top = moveY + 'px';

    //shadow

    if (!ie) {
        fuckoff(zoomImg);//TINY.shadow.set(zoomImg, 1, 0, 9);
    }

    // close button

    fadeout($("ZoomClose"));

    // caption

    if (includeCaption && preloadz) {
        fadeout(zoomCap);
    }

    //hide dim

    TINY.alpha.set($('dim2'), 0, 4);
    setTimeout("$('dim2').style.display = 'none'", 600);


}


// Finished Zooming Out

function zoomDone() {

    zoomOpen = false;

    document.onclick = savedClick;
    document.onkeypress = savedKeyPress;

    //hide div
    zoomDiv.style.visibility = "hidden";

}


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function zoomElement() {

    // cpu time

    zoomCurrent++;

    var cd = new Date().getTime();
    time = -START + cd;
    tempSteps = CPU / time * zoomCurrent;//alert(zoomSteps)

    if (tempSteps < zoomCurrent) {
        tempSteps = zoomCurrent;
    }


    // Calculate this step's difference, and move it!

    moveW = cubicInOut(zoomCurrent, zoomStartW, zoomChangeW, tempSteps);
    moveH = cubicInOut(zoomCurrent, zoomStartH, zoomChangeH, tempSteps);
    moveX = cubicInOut(zoomCurrent, zoomStartX, zoomChangeX, tempSteps);
    moveY = cubicInOut(zoomCurrent, zoomStartY, zoomChangeY, tempSteps);


    // 3d

    zoomDiv.style.left = moveX + 'px';
    zoomDiv.style.top = moveY + 'px';
    zoomImg.style.width = moveW + 'px';
    zoomImg.style.height = moveH + 'px';


    // Do the Fade!

    if (includeFade) {
        moveF = cubicInOut(zoomCurrent, zoomStartF, zoomChangeF, tempSteps);
        setOpacity(moveF, zoomDiv);
    }

    //// !!!!!!
    if (zoomCurrent == 1) {
        zoomDiv.style.visibility = "visible";
    }


//###########################################		
    if (zoomCurrent >= tempSteps) {

        clearInterval(zoomTimer);

        if (time > CPU) {
            setTimeout(execWhenDone, (time - CPU) * 1.3);
        }//todo test
        else {
            execWhenDone();
        }

        zoomRunning = false;
    }

}


// Check for Command / Alt key. If pressed, pass them through -- don't zoom!
function metaEvent(e) {
    if (!e) {
        e = window.event;
    }
    if (e.button == 2 || e.metaKey || e.altKey) {
        return true;
    }
}

// Zoom Utility: Get Key Press when image is open, and act accordingly
function getKey1(e) {
    if (!e) {
        e = window.event;
    }
    var t = e.keyCode;

    if (t == 27 || t == 32 || t == 13) { // ESC
        zoomOut(e);
    }
}


////////////////////////////
//
// FADE Functions
//

function fadeout(e) {
    if (ie) {
        e.style.visibility = "hidden"
    } else {
        TINY.alpha.set(e, 0, 8, 1);
    }
}

function fadein(e) {
    e.style.visibility = "visible";
    if (ie) {
        e.style.filter = ''
    } else {
        TINY.alpha.set(e, 100, 10);
    }
}


//////////////////////////////////////////////////////////////
//
//					 UTILITY 
//
//////////////////////////////////////////////////////////////


function setOpacity(opacity, object) {

    if (ie) {
        object.style.filter = "alpha(opacity=" + opacity + ")";
    } // IE/Win
    else {
        object.style.opacity = opacity / 100;
    }                 // Safari 1.2, Firefox+Mozilla

}


function cubicInOut(t, b, c, d) {
    if ((t /= d / 2) < 1) {
        return c / 2 * t * t * t + b;
    }
    return c / 2 * ((t -= 2) * t * t + 2) + b;
}


function getSize(e) {

    var _ = document.body, __ = window, _1 = document.documentElement;

    if (__.innerHeight) { // Everyone but IE
        myScrollx = __.pageXOffset;
        myScrolly = __.pageYOffset;
    } else { // IE6 Strict +
        myScrollx = _1.scrollLeft;
        myScrolly = _1.scrollTop;
    }

    if (!w || !h) {
        winSize();
    }
    myWidth = w;
    myHeight = h;

    // Page size w/offscreen areas

    if (__.innerHeight && __.scrollMaxY) {
        myScrollWidth = _.scrollWidth;
        myScrollHeight = __.innerHeight + __.scrollMaxY;//too todo test
    } else if (_.scrollHeight > _.offsetHeight) { // All but Explorer Mac
        myScrollWidth = _.scrollWidth;
        myScrollHeight = _.scrollHeight;
    } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
        myScrollWidth = _.offsetWidth;
        myScrollHeight = _.offsetHeight;
    }


//////////////////////
    var startPos = getOffset(preloadFrom);

    zoomStartX = startPos.left - myScrollx;
    zoomStartY = startPos.top - myScrolly;

    //click absolute coords

    if (!e) {
        e = __.event;
    }

    click_pos_x = (e.pageX) ? (e.pageX - myScrollx) : (e.offsetX + zoomStartX);
    click_pos_y = (e.pageY) ? (e.pageY - myScrolly) : (e.offsetY + zoomStartY);
}


// Utility: Find the Y position of an element on a page. Return Y and X as an array

function getOffsetSum(elem) {
    var top = 0, left = 0
    while (elem) {
        top = top + parseFloat(elem.offsetTop)
        left = left + parseFloat(elem.offsetLeft)
        elem = elem.offsetParent
    }

    return {top: Math.round(top), left: Math.round(left)}
}
function getOffsetRect(elem) {
    // (1)
    var box = elem.getBoundingClientRect()

    // (2)
    var body = document.body
    var docElem = document.documentElement

    // (3)
    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft

    // (4)
    var clientTop = docElem.clientTop || body.clientTop || 0
    var clientLeft = docElem.clientLeft || body.clientLeft || 0

    // (5)
    var top = box.top + scrollTop - clientTop
    var left = box.left + scrollLeft - clientLeft

    return { top: Math.round(top), left: Math.round(left) }
}
function getOffset(elem) {
    if (elem.getBoundingClientRect) {
        return getOffsetRect(elem)
    } else {
        return getOffsetSum(elem)
    }
}


function insertZoomHTML() {

    var inBody = $$("body")[0];

    var box = document.createElement("div");

    var sssuka = (includeCaption) ? '<table id="ZoomCapDiv" cellspacing="0"><tr><td><img src="img/caption-l.png' + '"/></td><td id="ZoomCaption" valign="middle"></td><td><img src="img/caption-r.png' + '"/></td></tr></table>' : '';

    box.innerHTML = '<div id="ZoomSpin"><img id="SpinImage" title="click to stop" src="img/ajax-loader.gif" alt="loading..." /></div>\
	<div id="dim2"></div>\
	<div id="ZoomBox"><img id="ZoomImage" onclick="zoomOut(event)"/><div id="ZoomClose" onclick="zoomOut(event)"></div>' + sssuka + '</div>'
    inBody.appendChild(box);

//vbar _ = document
}
