/* Created by Martin Hintzmann 2008 martin [a] hintzmann.dk * MIT (http://www.opensource.org/licenses/mit-license.php) licensed. * * Version: 0.1 * * Requires: *   jQuery 1.2+ */(function($) {	$.fn.boxShadow = function(xOffset, yOffset, blurRadius, shadowColor) {		if (!$.browser.msie) return;		return this.each(function(){			$(this).css({				position:	"relative",				zoom: 		1,				zIndex:		"2"			});			$(this).parent().css({					position:	"relative"			});						var div=document.createElement("div");			$(this).parent().append(div);			var _top, _left, _width, _height;			if (blurRadius != 0) {				$(div).css("filter", "progid:DXImageTransform.Microsoft.Blur(pixelRadius="+(blurRadius)+", enabled='true')");				_top = 		yOffset-blurRadius-1;				_left =		xOffset-blurRadius-1;				_width =		$(this).outerWidth()+1;				_height =	$(this).outerHeight()+1;			} else {				_top = 		yOffset;				_left =		xOffset;				_width = 	$(this).outerWidth();				_height = 	$(this).outerHeight();			}			$(div).css({				top: 			_top,				left:			_left,				width:		_width,				height:		_height,				background:	shadowColor,				position:	"absolute",				zIndex:		1			});				  });	};})(jQuery);
/*
* DisplayObject3D ----------------------------------------------
*/
var DisplayObject3D = function(){
	return this;
};

DisplayObject3D.prototype._x = 0;
DisplayObject3D.prototype._y = 0;

//Create 3d Points
DisplayObject3D.prototype.make3DPoint = function(x,y,z) {
	var point = {};
	point.x = x;
	point.y = y;
	point.z = z;
	return point;
};

//Create 2d Points
DisplayObject3D.prototype.make2DPoint = function(x,y, depth, scaleFactor){
	var point = {};
	point.x = x;
	point.y = y;
	point.depth = depth;
	point.scaleFactor = scaleFactor;
	return point;
};

DisplayObject3D.prototype.container = undefined;
DisplayObject3D.prototype.pointsArray = [];

DisplayObject3D.prototype.init = function (container){
	
	this.container = $(container);
	this.containerId = this.container.attr("id");
	
	//if there isn't a ul than it creates a list of +'s
	if ($(container+":has(ul)").length === 0){
		for (i=0; i < this.pointsArray.length; i++){
			this.container.append('<b id="item'+i+'">+</b>');
		}
	}
};	

/*
* DisplayObject3D End ----------------------------------------------
*/


/*
* Camera3D ----------------------------------------------
*/
var Camera3D = function (){};

Camera3D.prototype.x = 0;
Camera3D.prototype.y = 0;
Camera3D.prototype.z = 500;
Camera3D.prototype.focalLength = 1000;

Camera3D.prototype.scaleRatio = function(item){
	return this.focalLength/(this.focalLength + item.z - this.z);
};

Camera3D.prototype.init = function (x,y,z,focalLength){
	this.x = x;
	this.y = y;
	this.z = z;
	this.focalLength = focalLength;
};


/*
* Camera3D End ----------------------------------------------
*/


/*
* Object3D ----------------------------------------------
*/
var Object3D = function (container){
	this.container = $(container);
};

Object3D.prototype.objects = [];

Object3D.prototype.addChild = function (object3D){
		
	this.objects.push(object3D);
	
	object3D.init(this.container);
	
	return object3D;
};

/*
* Object3D End ----------------------------------------------
*/


/*
* Scene3D ----------------------------------------------
*/

var Scene3D = function (){};

Scene3D.prototype.sceneItems = [];
Scene3D.prototype.addToScene = function (object){
	this.sceneItems.push(object);
};

Scene3D.prototype.Transform3DPointsTo2DPoints = function(points, axisRotations,camera){
	var TransformedPointsArray = [];
	var sx = Math.sin(axisRotations.x);
	var cx = Math.cos(axisRotations.x);
	var sy = Math.sin(axisRotations.y);
	var cy = Math.cos(axisRotations.y);
	var sz = Math.sin(axisRotations.z);
	var cz = Math.cos(axisRotations.z);
	var x,y,z, xy,xz, yx,yz, zx,zy, scaleFactor;

	var i = points.length;
	
	while (i--){
		x = points[i].x;
		y = points[i].y;
		z = points[i].z;

		// rotation around x
		xy = cx*y - sx*z;
		xz = sx*y + cx*z;
		// rotation around y
		yz = cy*xz - sy*x;
		yx = sy*xz + cy*x;
		// rotation around z
		zx = cz*yx - sz*xy;
		zy = sz*yx + cz*xy;
		
		scaleFactor = camera.focalLength/(camera.focalLength + yz);
		x = zx*scaleFactor;
		y = zy*scaleFactor;
		z = yz;
		
		var displayObject = new DisplayObject3D();
		TransformedPointsArray[i] = displayObject.make2DPoint(x, y, -z, scaleFactor);
	}
	
	return TransformedPointsArray;
};

Scene3D.prototype.renderCamera = function (camera){

	for(var i = 0 ; i< this.sceneItems.length; i++){

		var obj = this.sceneItems[i].objects[0];
	
		var screenPoints = this.Transform3DPointsTo2DPoints(obj.pointsArray, axisRotation, camera);
		
		for (k=0; k < obj.pointsArray.length; k++){
			var currItem = null;
			
			currItem = document.getElementById(obj.containerId).getElementsByTagName("ul")[0].getElementsByTagName("li")[k];
			
			if(currItem){
				currItem._x = screenPoints[k].x;
				currItem._y = screenPoints[k].y;
				var cs = currItem.scale = screenPoints[k].scaleFactor;
				
				currItem.style.top = currItem._y+'px';
				currItem.style.left = currItem._x*2+'px';
				//currItem.style.fontSize = 100*currItem.scale+'%';				var iii = currItem.childNodes[0];
				iii.style.height = Math.min(100, Math.max(20, 100*cs))+'px';				var xxx = 				iii.style.width = 1.5*Math.min(100, Math.max(20, 100*cs))+'px';				
				$(currItem).css({opacity:(cs-.2)});				//$(currItem).boxShadow(xxx/10 + 'px ' + xxx/10 + 'px ' + xxx/10 + 'px #555');

			}
			
		}

	}
};

/*
* Scene3D End ----------------------------------------------
*/


//Center for rotation
var axisRotation = new DisplayObject3D().make3DPoint(0,0,0);
