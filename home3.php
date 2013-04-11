<style>

			#item{

				position:absolute;
				width:1px;
				height:1px;
				left:50%;
				top:50%;
				z-index:10
				
			}
			#item li{
				position :absolute;
			}

#item img{
box-shadow:10px 10px 10px #ddd;
-moz-box-shadow:10px 10px 10px #ddd;
-ktml-box-shadow:10px 10px 10px #ddd;
border:3px solid #333
}
#item b{
	font-size:12px;
	line-height:10px;
	display:block;
	text-align:center;
	color:#333;
}
			ul{

				list-style-type: none;

			}

		</style>
<h1 style="margin:0 auto"><?php echo @$POOO['summary'] ?></h1>
		<div id="item">
			<ul style="font-size:40px">
				<?php
						$posts = $db->query("SELECT * FROM `".PRF."posts` WHERE blog=".BLOG);

					foreach($posts as $p){
						echo '<li><a href="?id='.$p['id'].'"><img src="'.$p['icon'].'" title="'.$p['title'].'" /><b>'.$p['title'].'</b></a></li>';
				}
				?>
			</ul>
		</div>
		

	<script src=js/jquery-1.2.1.min.js></script>
	<script src=js/3DEngine.js></script>

	<script src=js/Cube.js></script>
	<script src=data.js></script>
