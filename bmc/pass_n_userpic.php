<?php
if ($_POST['pass'] != $_POST['pass1']) {
    error_page('Passwords do not match');
}

if ($_FILE['pic']) {
    include_once "upload_pic.php";
    $_POST['userpic'] = up_pic('userpic', '', '', 'upload/', 100, 100);
    if (!$_POST['userpic']) {
        error_page('Error loading userpic');
    }
}

?>