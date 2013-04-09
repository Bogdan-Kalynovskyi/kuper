
var myWidth = document.getElementById('container').offsetWidth;
var myHeight = document.getElementById('container').offsetHeight;

var screenFactor = myWidth/myHeight;
		//alert(screenFactor)

		

		$(document).ready(function() {

			var camera = new Camera3D();

			camera.init(0,0,0,478);/*critical!!! ÿ גזו גטירמג287*/
			

			var container = $("#item")
			var item = new Object3D(container);

			

			item.addChild(new Cube(myHeight/5.7));

			

			var scene = new Scene3D();

			scene.addToScene(item);


axisRotation.x=0.942;
axisRotation.y=0.03;
axisRotation.z=-0.143;


	

			

			var mouseX, mouseY = 0;

			var offsetX = $("#item").offset().left;

			var offsetY = $("#item").offset().top;

			var speed = 100000;

			

			document.onmousemove = function(e){
 
				mouseX = e.clientX - offsetX - (container.width() / 2);//changeable width

				mouseY = e.clientY - offsetY - (container.height() / 2);//changeable height

			};


			

			var animateIt = function(){

				if (mouseX != undefined){

					axisRotation.y += mouseX / speed

				}

				if (mouseY != undefined){

					axisRotation.x -= mouseY / speed;

				}



				scene.renderCamera(camera);

				

			};

						

			

			setInterval(animateIt, 50);

			

			

			});

