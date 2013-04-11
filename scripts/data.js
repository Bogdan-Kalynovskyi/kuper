
		//<![CDATA[


var myWidth = 0, myHeight = 0;

		
function alertSize() {
try{
    a = window.innerWidth;
    b = window.innerHeight;
    //IE 6+ in 'standards compliant mode'
    a1= document.documentElement.clientWidth;
    b1= document.documentElement.clientHeight;
    //IE 4 compatible
    a2 = document.body.clientWidth;
    b2 = document.body.clientHeight;
  
	myWidth = Math.max(a, a1, a2);
	myHeight = Math.max(b, b1, b2);
	if(navigator.product == 'Gecko')myHeight +=10;
}catch(e){};
}

		

		$(function() {

			alertSize();

			var camera = new Camera3D();

			camera.init(0,0,0,myHeight/2 - 160);
			
			var item_id = document.getElementById('item');
			item_id.style.top = myHeight/2 - 100;			


			var container = $("#item")
			var item = new Object3D(container);

			

			item.addChild(new Cube(myHeight/10));

			

			var scene = new Scene3D();

			scene.addToScene(item);



	

			

			var mouseX, mouseY = 0;

			var offsetX = $("#item").offset().left;
			var offsetY = $("#item").offset().top;

			var speed = 130000;

/*new*/			
			axisRotation.x = 0.5; 
			axisRotation.y = 0.5;
/*new*/			

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

						

			

			setInterval(animateIt, 10);

			

			

			});

		//]]>