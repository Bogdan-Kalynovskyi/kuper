<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}
?>

<style>

    #gal {
        position: absolute;
        left: 50%;
        top: 50%;
        display: inline-block;
        height: auto;
        margin-top: -62px;
        margin-left: -377px;
        z-index: 31;

        background: #555; /*#ffffe3;/*#fffcfb;*/
        -moz-border-radius: 6px;
        border-radius: 6px;

        text-align: center;
        padding: 30px;
        -moz-box-shadow: 4px 7px 7px #555;
        box-shadow: 4px 7px 7px #555;
        background-image: -moz-linear-gradient(top, #444444, #999999);

        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #444444), color-stop(1, 999999));
    }

    #gal a {
        -moz-border-radius: 6px;
        border-radius: 6px;
        /*color:#444;*/
        color: #fff;
        padding: 15px 29px;
        margin: 0px 10px;
        display: inline-block;
        text-align: center;
        font-size: 36px;
        text-shadow: 1px 0px 2px #999;
        text-decoration: none;
    }

    #gal a:hover {
        background: #aaa
    }
</style>


<div id="gal">

    <a href="?page=<?php echo BLOG ?>&go=0">����������&nbsp;�&nbsp;��������</a><span style="font-weight:1;font-size:47px;color:#ddd">|</span>
    <a href="?page=<?php echo BLOG ?>&go=1">������</a>

</div>
