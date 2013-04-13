<?php

$f2 = get_file($_POST['src']);

if (empty($f2)) {
    $f2 = upload_file(true);
}


if (!empty($f2) && isset($_POST['thumb']) && ($_POST['thumb'] == '1')) {

    $path_parts = pathinfo($f2);
    $path_parts['basename'] = 'thumb_' . $path_parts['basename'];
    $f3 = $path_parts['dirname'] . '/' . $path_parts['basename'];

    include "image.class.php";

    $img = new Zubrag_image;
    if (isset($_POST['max_x']) && is_numeric($_POST['max_x']) && $_POST['max_x'] > 0) {
        $_POST['width'] = $_POST['max_x'];
        $img->max_x = $_POST['max_x'];
    }
    if (isset($_POST['max_y']) && is_numeric($_POST['max_y']) && $_POST['max_y'] > 0) {
        $_POST['heigh'] = $_POST['max_y'];
        $img->max_y = $_POST['max_y'];
    }

    $img->GenerateThumbFile($f2, $f3);
    @rename($f3, $f2);
}


?>