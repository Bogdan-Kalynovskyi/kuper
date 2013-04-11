	var includeDim	   = true;
	var includeCaption = true;
	var zoomTime       = 12;//ms
	var zoomSteps      = 10;//max. will vary
	var includeFade    = 0;//turned off for low cpus
	var zoomBorder 	   = 10;//nice white border
	var minBorder      = 100;//from screen edges
	var shadowSettings = '0px 0px '+ (parseInt(minBorder/2) - zoomBorder)*2 +'px rgba(0, 0, 0, ';//corners//todo ???
	var CPU = 300, START,	zoomCurrent;
	
	var zoomURI   = 'images/zoom/', MY_URL = 'http://kuperfild.ru'; 

//CPU testing

	var myWidth, myHeight, myScrollx, myScrolly, myScrollWidth, myScrollHeight, click_pos_x, click_pos_y;
	
	var 
	zoomOpen = false,
	zoomRunning = false,
	zoomActive=null, 
	preloadTime = 0, 			//time from start preloading. used to kill hanging preloads
	imgPreload = new Image(),
	preloadClicked = false; 
	preloadAnimation = false;		//if we should display spinner cause user clicked zoom

	var savedClick, savedKeyPress;
	var zoomTimer, zoomOrigW, zoomOrigH, zoomOrigX, zoomOrigY, execWhenDone=null;//temp globals
	var zoomStartX, zoomStartY, zoomStartW, zoomStartH, fadeStart, zoomChangeX, zoomChangeY, zoomChangeW, zoomChangeH, fadeChange;
	var moveX, moveY, moveH, moveW, moveO;
	
	var zoomID         = "ZoomBox";  
	var theID          = "ZoomImage";
	var zoomCaption    = "ZoomCaption";
	var zoomCaptionDiv = "ZoomCapDiv";
	var zoomSpinID 	   = "ZoomSpin";
	var zoomShadowID   = "ShadowBox";
	
	var
	zoomDiv,
	zoomImg,
	zoomCap,
	zoomSpin;
	
	
//preload total clear
//roomin total clear
//zoomout total clear





//window onLoad. injection
function setupZoom() {
	var links = document.getElementsByTagName("a");
	var l=links.length; 
	for (i = 0; i < l; i++) {//TODO TEST//or spec class
			if (links[i].href.search(/(.*)\.(jpg|jpeg|gif|png)/gi) != -1) {
				
					links[i].onclick = iZoomClick;
					links[i].onmouseover = iZoomPreload;
			}
	}
}




function iZoomPreload() {
	zoomPreload(this.href);
}

function zoomPreload(src) {
	
		if(imgPreload){
			if(imgPreload.src != src && imgPreload.src != MY_URL+src ){
				imgPreload.onload = null;
			}else
				return;
		}

		imgPreload = new Image();
		
		preloadTime = setTimeout(preloadingStop, 25000);
		imgPreload.onload = preloadingComplete;		

		imgPreload.src = src;

}


function preloadingStop(){
			imgPreload.onload = null;
			
			clearTimeout(preloadTime);
			
			if(preloadAnimation)
				preloadAnimFinish();
}


function preloadingComplete(){//successfull event

			preloadingStop();

			if(preloadClicked){
				
				preloadClicked = false;
				zoomIn();

			}
}


// Zoom: Start the preloading animation cycle.
function preloadAnimStart() {
		
		preloadAnimation = true;		
		zoomSpin.style.left = click_pos_x - zoomSpin.offsetWidth/2 + 'px';
		zoomSpin.style.top =  click_pos_y - zoomSpin.offsetHeight/2  + 'px';
		zoomSpin.style.display = "block";//todo test!!!!!
}
function preloadAnimFinish() {
		preloadAnimation = false;		
		zoomSpin.style.display = "none";    
}



//****************************** ZOOM CLICK: *************************************
// todo?: i don't beleive complete fires onload event
function iZoomClick(e){
	var child = this.firstChild.firstChild;
	return zoomClick(child, this.href, this.title, e)
}

function zoomClick(from, src, zzzz, e) {//starter id,  fullsize src, 
	if(zoomRunning)return true;
	
	if (metaEvent(e))return true;
		
	if(typeof zoomSpin == undefined || !zoomSpin){
			insertZoomHTML();//todo optimize
			
			zoomSpin = $(zoomSpinID);
			zoomDiv = $(zoomID);  
			zoomImg = $(theID);
			zoomCap = $(zoomCaptionDiv);
			zoomShadow = $(zoomShadowID);
			
	}

	
/////////////////////////////////////////// ми можемо блять переключитись з одного зуьу на 1нший п1д час прелоад1нгу

		preloadFrom = from; preloadSrc = src; preloadz = zzzz;			

//screen
	getSize(e);

//picture
	zoomPreload(src);
	

	if (imgPreload.complete) {

			zoomIn();
		
	} else {

			preloadClicked = true;
			preloadAnimStart();	

	}
	
	return false;
	
}



// Zoom: Move an element in to endH endW, using zoomHost as a starting point.
// "from" is an object reference to the href that spawned the zoom.

function zoomIn() {
	
	if(zoomRunning) return;
	zoomRunning = true;		// 5 lock from other actions while zooming //why? - for no bugs =)
	

	zoomImg.src = preloadSrc; 

//start
	zoomStartW = preloadFrom.offsetWidth;if(ie)zoomStartW*=3;
	zoomStartH = preloadFrom.offsetHeight;

//finish
	endW = imgPreload.width;
	endH = imgPreload.height;
	
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
			fadeStart = 0;
			fadeChange = 100;
		}else{
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

		if (metaEvent(e))return true;/*for right - click*/
////////////////////
		cancelEvent(e);
////////////////////
	
		if(zoomRunning) return true;
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
			fadeStart = 100;
			fadeChange = -100;
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

	zoomImg.style.border = zoomBorder + 'px solid #eee';
	zoomDiv.style.left = moveX - zoomBorder + 'px';
	zoomDiv.style.top = moveY - zoomBorder + 'px';
	
	//fade

	if (includeFade) {
		setOpacity(100, zoomDiv);
	}

	//shadow

	if (! ie) {
		// Or, do a fade of the modern shadow
		TINY.shadow.set(zoomImg, 0, 1, 9);
	}
	
	// Position and display the CAPTION, if existing
  
	if (includeCaption && preloadz) {

		zoomCap.style.top = parseInt(zoomDiv.style.top) + (zoomDiv.offsetHeight + 15) + 'px';
		zoomCap.style.left = (myWidth / 2) - (zoomCap.offsetWidth / 2) + 'px';
		zoomCap.style.visibility = "visible";
		fadein(zoomCap);
	}   
	
	// Display Close Box (fade it if it's not IE)

	$("ZoomClose").style.visibility = "visible";
	fadein("ZoomClose");


	// Display the Dim
	$('dim2').style.display = 'block';
	TINY.alpha.set('dim2', 64, 5);
	
}


function zoomBeforeOut(e){

	//border

	zoomImg.style.border = '0';
	zoomDiv.style.left = moveX + 'px';
	zoomDiv.style.top = moveY + 'px';

	//shadow
	
	if (! ie) {	
		fuckoff(zoomImg);//TINY.shadow.set(zoomImg, 1, 0, 9);
	}

	// close button
	
	fadeout( $("ZoomClose"));
	
	// caption
	
	if (includeCaption && preloadz) {
		fadeout(zoomCap);
	}
	
	//hide dim

	TINY.alpha.set($('dim2'),0,4);
	setTimeout(	"$('dim2').style.display = 'none'", 600);
	

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
		tempSteps = CPU/time*zoomCurrent;//alert(zoomSteps)
		
		if(tempSteps < zoomCurrent)tempSteps = zoomCurrent;

		
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
			moveO = cubicInOut(zoomCurrent, fadeStart, fadeChange, tempSteps);
			setOpacity(moveO, zoomDiv);
		}

		//// !!!!!!
		zoomDiv.style.visibility = "visible";


//###########################################		
	if (zoomCurrent >= tempSteps) {
		
		clearInterval(zoomTimer);

		if(time>CPU)setTimeout(execWhenDone, (time - CPU)*1.2);//todo test
		else execWhenDone();
		
		zoomRunning = false;
	}
		
}


// Check for Command / Alt key. If pressed, pass them through -- don't zoom!
function metaEvent(e){
	if (! e) e = window.event;
	if ( e.button==2 || e.metaKey || e.altKey) {
		return true;
	}
}

// Zoom Utility: Get Key Press when image is open, and act accordingly
function getKey1(e) {
	if (! e) e = window.event;
	var	t = e.keyCode;
	
	if (t == 27 || t == 32 || t == 13) { // ESC
		zoomOut(e);
	}
}


////////////////////////////
//
// FADE Functions
//

function fadeout(e) {
	TINY.alpha.set(e,0,8,1);
}

function fadein(e) {
	TINY.alpha.set(e,100,10);
}




//////////////////////////////////////////////////////////////
//
//					 UTILITY 
//
//////////////////////////////////////////////////////////////



function setOpacity(opacity, object) {

	if(ie)
		object.style.filter = "alpha(opacity=" + opacity + ")"; // IE/Win
	else
		object.style.opacity = opacity / 100;                 // Safari 1.2, Firefox+Mozilla

}

 

function cubicInOut(t, b, c, d)
{
	if ((t/=d/2) < 1) return c/2*t*t*t + b;
	return c/2*((t-=2)*t*t + 2) + b;
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
	
	if(!w || !h)winSize();
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
	var startPos = findElementPos(preloadFrom);

	zoomStartX = startPos[0];
	zoomStartY = startPos[1];

	//click absolute coords

	if(!e) e = __.event; 

	click_pos_x = (e.pageX)? e.pageX : e.offsetX + zoomStartX;
	click_pos_y = (e.pageY)? e.pageY : e.offsetY + zoomStartY;
}


// Utility: Find the Y position of an element on a page. Return Y and X as an array

function findElementPos(elemFind)
{// ie?
	var elemX = 0;
	var elemY = 0;
	var fixed = false;
	
	do {//is there any other computed style in your code?
		if(TINY.style.val(elemFind, 'position') == 'fixed')
			fixed = true;		
		elemX += elemFind.offsetLeft;
		elemY += elemFind.offsetTop;
	} while ( elemFind = elemFind.offsetParent )

	if(!fixed)
		return Array(elemX - myScrollx, elemY - myScrolly);
	else
		return Array(elemX, elemY);
}














function insertZoomHTML() {
	
	var inBody = $$("body")[0];

	var box = document.createElement("div");

	var sssuka = (includeCaption)?'<table id="ZoomCapDiv" cellspacing="0" cellpadding="0"><tr><td><img src="'+zoomURI+'zoom-caption-l.png'+'"></td><td id="ZoomCaption" valign="middle"></td><td><img src="'+zoomURI+'zoom-caption-r.png'+'"></td></tr></table>':'';

	box.innerHTML = '<div id="ZoomSpin"><img id="SpinImage" src="ajax-loader.gif" alt="loading..." onclick="preloadingStop" /></div>\
	<div id="dim2"></div>\
	<div id="ZoomBox"><img src="'+zoomURI+'closebox.gif" id="ZoomImage" onclick="zoomOut" /><div id="ZoomClose"><img src="'+zoomURI+'closebox.png" onclick="zoomOut" /></div>' + sssuka + '</div>'
	inBody.appendChild(box);
	
//vbar _ = document
}
