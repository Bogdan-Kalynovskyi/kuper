<?php
if (!defined('IN_BMC'))
    {die('Access Denied!');
}

function back_link_func() {
    echo '?page=' . BLOG;
    if ($sex)
        {echo '&go=' . $one['switch'];
}
}


$sql = $sex = '';
$bmc_vars['blog_y'] += 20;


////////// 1
if (isset($_GET['go']) && isnumeric($_GET['go'])) {
    $sql = " AND switch=" . a($_GET['go']);
}


////////// 2
if (isnumeric($_GET['page']) || isnumeric($_GET['blog'])) {
    $om = true;
    $bmc_vars['blog_y'] = 300;
    $data = $db->query("SELECT * FROM " . PRF . "posts WHERE blog=" . BLOG . " $sql ORDER BY por ASC", true, true);
}


///////// 3	
elseif (isnumeric($_GET['id'])) {
    $om = false;
    $one = $db->query("SELECT * FROM " . PRF . "posts WHERE id=" . a($_GET['id']), false);
    $data = $db->query("SELECT * FROM " . PRF . "photo WHERE post=" . a($_GET['id']) . " ORDER BY por ASC", true, true);
    if (!$data)
        {die('<h1><br><br><br>������� �����</h1>' . backbutton());
}
    if ($one['blog'] == 5)
        $sex = true;
}


else die('oops');


?>

    <style>

    #fon {
        opacity: 0.5
    }

    ul#gal li, .to_bottom, #container h1, #container h2 {
        position: relative;
        z-index: 31;
    }

    #container h1, #container h2 {
        text-align: center;
        font-weight: normal;
        font-style: italic;
        font-size: 19px;
        color: #d22;
        padding: 11px 0 0 0;
    }

    #container h1 {
        text-shadow: 1px 1px 20px #eee;
    }

    #container h2 {
        font-size: 16px;
        color: #955;
        margin-top: -3px
    }

    #container h1:hover {
        cursor: pointer;
    }

    .to_bottom {
        opacity: 0.7;
        text-decoration: none;
        clear: both;
        font-size: 12px;
        color: #33a;
        left: 22px;
    }

    .to_bottom:hover {
        opacity: 1;
        text-decoration: underline;
        color: #c00;
    }

    ul#gal li a:active {
        /*color:#228;*/
        color: #922;
    }

    ul#gal li a:hover h3, ul#gal li a:hover h4 {
        color: #c00;
    }

    ul#gal li a .zek {
        opacity: 0.9
    }

    ul#gal li a:hover .zek {
        opacity: 1;
    }

        /********************************************************************/

    <?php if(!$om){ ?>
    ul#gal {
        margin: 10px 0 8px 94px;
    }

    ul#gal li a .abc {
        height: 100%;
        hieght: auto !important;
        min-height: 100%;
        float: left;
        margin-left: 32px; /*history*/
        position: relative;
    }

    ul#gal li a .loh {
        position: absolute;
        bottom: 0;
    }

    ul#gal li a .zek {
        float: left;
        margin-right: 17px;
        padding: 5px;
        min-width: 260px;
    }

    .zek img {
        -moz-box-shadow: 3px 2px 4px #555;
        box-shadow: 3px 2px 4px #555;
    }

    <?php

            echo <<<EOF


                ul#gal li a{
                    display:block;

                    height:{$bmc_vars['blog_y']}px;
                    color:#223;
                    text-decoration:none;
                }

                ul#gal li a .zek img{
                    height:{$bmc_vars['blog_y']}px;
                }


    EOF;

    ?>

    ul#gal li a h3 {
        font-weight: normal;
        color: #633;
    <?php if($om){ ?> font-size: 22px;
        min-height: <?php echo $bmc_vars['blog_y']/2 - 15; ?>px;
    <?php }else{ ?> font-size: 19px;
    <?php }	?> width: 600px;
    }

    ul#gal li a h4 {
        font-weight: normal;
        font-size: 15px;
        width: 600px;
        line-height: 20px;
    }

    <?php } ?>

        /********************************************************************/

    <?php if($om){ ?>

    ul#gal {
        margin: 0 auto;
        width: 1007px;
    }

    ul#gal li {
        display: block;
        width: 50%;
        float: left;
    }

    ul#gal li a {
        display: block;
        text-decoration: none;
        color: #223;
    }

    ul#gal li a .abc {
        display: block;
        margin: 0 auto;
        width: 360px;
        height: 20px;
        text-align: center;
    }

    <?php
            echo <<<EOF

                ul#gal li a .zek img{
                    /*height:{$bmc_vars['blog_y']}px;*/
                }
    EOF;
    ?>

    ul#gal li a h3 {
        font-weight: normal;
        color: #733;
        font-size: 19px;
    }

    ul#gal li a h4 {
        font-weight: normal;
        font-size: 11px;
        line-height: 19px;
    }

    .outer {
        border-radius: 6px;
        -moz-border-radius: 6px;
        margin: 13px auto;
        width: 340px;
        height: 210px;
        overflow: hidden;
        *position: relative;
    }

    .inner {
        float: left;
        position: relative;
        left: 50%;
    }

    .outer .inner img {
        display: block;
        position: relative;
        left: -50%;
    }

    <?php } ?>
    </style>





















<?php

if ($om) {
    echo '<small><br></small><h1>������ �������</h1>';
}
elseif (isset($one['title']) && $one['title']) {
    echo '<h1 onclick="window.location.href=\'<?php back_link_func() ?>\'"><small>������� </small><strong><big> &nbsp; "' . $one['title'] . '"</big></strong></h1>';
}


if (isset($one['summary']) && $one['summary'])
    echo '<h2>' . $one['summary'] . '</h2>';
else
    echo '<div id="razv"></div>';

?><br>














    <ul id="gal">
        <?php

        $k = 0;
        foreach ($data as $i => $d) {

            if (!$om && !$sex)
                $a_href = 'href="fullsize/' . basename($d['icon']) . '" onclick="return z(' . $k . ', event)"';

            elseif (!$om && $sex)
                $a_href = "href=\"fullsize/" . basename($d['icon']) . "\"";

            else
                $a_href = "href=\"?id=$i\"";


            if ($om)
                $zek_img = '<div class="outer"><div class="inner"><img src="' . imgsrc($d['icon']) . '"></div></div>';
            else
                $zek_img = '<div class="zek"><img src="' . imgsrc($d['icon']) . '" rel="reflect"></div>';

            echo <<<EOF
		<li>
			<a $a_href>$zek_img
				<div class="abc"><div class="loh">
					<h3>{$d['title']}</h3>
					<h4>{$d['summary']}</h4>
				</div></div>
				<div style="clear:both;"></div>
			</a>
			<div style="clear:both;height:30px"></div>

		</li>
		
EOF;

            $k++;
        }

        ?>
    </ul>
    <div style="clear:both"></div><br><br>


    <!--<div id="dim"></div>-->


<?php if (!$om) { ?>
    <?php if (count($data) > 7) { ?>
        <a href="#nav" class="to_bottom" onclick="window.scroll(0,0);return false">� ������</a><br><br><br>
    <?php } ?>
    <a href="<?php back_link_func() ?>" class="to_bottom">� ������ �������</a><br><br><br>

    <script src="reflection.js"></script>

<?php } ?>





<?php if (!$om && $sex) { ?>


    <script src="FancyZoom.js"></script>
    <script>
        addLoadEvent(setupZoom);
        includeFade = true;
    </script>





<?php
}
elseif (!$om && !$sex) {
    include A_ROOT . "gallery.php"; ?>


    <script>

        addLoadEvent(function () {

            $('molbert').onclick = cancelEvent;
            mo1.style.visibility = 'hidden';
            document.onclick = b;

        });


        function b() {
            TINY.alpha.set(mo1, 0, 15, true);
            if (ie)setTimeout("mo1.style.visibility = 'hidden'", 200);//todo kill this
            clearTimeout(slideshow.lt);
            clearTimeout(slideshow.at);//stop everything
        }

        function z(x, e) {
            slideshow.imgSpeed = 18;
            slideshow.speed = 18000;
            slideshow.scrollSpeed = 14;
            cancelEvent(e)

            if (mo1.style.visibility == 'visible') {
                b();
                return false;
            }

            TINY.alpha.set(mo1, 100, 20);
            slideshow.pr(x, 0);
            return false;
        }

    </script>

<?php }
elseif ($om) { ?>

    <script>
        addLoadEvent(function () {
            var imgs = $$('img'), not1 = $('zyx'), not2 = $('fon'), i = 0, l = imgs.length, w, x;
            for (i; i < l; i++) {
                if (imgs[i] != not1 && imgs[i] != not2) {
                    x = imgs[i].parentNode.parentNode
                    w = Math.min(imgs[i].width, x.offsetWidth);
                    x.style.width = w + 'px';
                    x.style.border = '5px solid #eee';
                    fuck(x);
                }
            }
        })
    </script>

<?php } ?>