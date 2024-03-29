<?php
/********************************************************************
 * openImageLibrary addon Copyright (c) 2006 openWebWare.com
 * Contact us at devs@openwebware.com
 * This copyright notice MUST stay intact for use.
 ******************TODO DELETE ******************TODO BREADCRUMBS *** TODO FOLDER BROWSING*****************************/
require('config.inc.php');


$opendir = $leadon;
if (!$leadon) {
    $opendir = '.';
}
if (!file_exists($opendir)) {
    $opendir = '.';
    $leadon = $startdir;
}

clearstatcache();
if ($handle = opendir($opendir)) {
    while (false !== ($file = readdir($handle))) {
        //first see if this file is required in the listing
        if ($file == "." || $file == "..") {
            continue;
        }
        if (@filetype($leadon . $file) == "dir") {
            if (!$browsedirs) {
                continue;
            }

            $n++;
            if ($_GET['sort'] == "date") {
                $key = @filemtime($leadon . $file) . ".$n";
            }
            else {
                $key = $n;
            }
            $dirs[$key] = $file . "/";
        }
        else {
            $n++;
            if ($_GET['sort'] == "date") {
                $key = @filemtime($leadon . $file) . ".$n";
            }
            elseif ($_GET['sort'] == "size") {
                $key = @filesize($leadon . $file) . ".$n";
            }
            else {
                $key = $n;
            }
            $files[$key] = $file;
        }
    }
    closedir($handle);
}

//sort our files
if ($_GET['sort'] == "date") {
    @ksort($dirs, SORT_NUMERIC);
    @ksort($files, SORT_NUMERIC);
}
elseif ($_GET['sort'] == "size") {
    @natcasesort($dirs);
    @ksort($files, SORT_NUMERIC);
}
else {
    @natcasesort($dirs);
    @natcasesort($files);
}

//order correctly
if ($_GET['order'] == "desc" && $_GET['sort'] != "size") {
    $dirs = @array_reverse($dirs);
}
if ($_GET['order'] == "desc") {
    $files = @array_reverse($files);
}
$dirs = @array_values($dirs);
$files = @array_values($files);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <title>Галерея:</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            background: transpatent;
        }

        a {
            font-family: Arial, verdana, helvetica;
            font-size: 11px;
            color: #000000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function selectImage(url) {
            if (parent) {
                parent.clear_f1();
                parent.document.getElementById("src").value = url;
                parent.document.getElementById("img_").src = '<?php echo $leadon; ?>/' + url;
            }
        }

        if (parent) {
            parent.document.getElementById("dir").value = '<?php echo $leadon; ?>';
        }

    </script>
</head>
<body>
<table border="0">
    <tbody>
    <?php
    $breadcrumbs = explode('/', str_replace($imagebasedir, "", $leadon));
    if (($bsize = sizeof($breadcrumbs)) > 1) {
        if (($bsize - 1) > 0) {
            echo "<tr><td>";
            $sofar = '';
            echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?dir=' . myurlencode($imagebasedir) . '" style="font-size:10px;font-family:Tahoma;">&raquo; .. </a>';
            for ($bi = 0; $bi < ($bsize - 1); $bi++) {
                $sofar = $sofar . $breadcrumbs[$bi] . '/';
                echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?dir=' . myurlencode($imagebasedir . $sofar) . '" style="font-size:10px;font-family:Tahoma;">&raquo; ' . $breadcrumbs[$bi] . '</a>';
            }
            echo "</td></tr>";
        }
    }
    ?>
    <tr>
        <td>
            <?php
            $class = 'b';
            if ($dirok) {
                ?>
                <a href="<?php echo $_SERVER['SCRIPT_NAME'] . '?dir=' . myurlencode($dotdotdir); ?>"><img src="images/dirup.png" alt="Folder" border="0"> <strong>..</strong></a>
                <br>
                <?php
                if ($class == 'b') {
                    $class = 'w';
                }
                else {
                    $class = 'b';
                }
            }
            $arsize = sizeof($dirs);
            for ($i = 0; $i < $arsize; $i++) {
                $dir = substr($dirs[$i], 0, strlen($dirs[$i]) - 1);
                ?>
                <a href="<?php echo $_SERVER['SCRIPT_NAME'] . '?dir=' . myurlencode($leadon . $dirs[$i]); ?>"><img src="images/folder.png" alt="<?php echo $dir; ?>" border="0">
                    <strong><?php echo $dir; ?></strong></a><br>
                <?php
                if ($class == 'b') {
                    $class = 'w';
                }
                else {
                    $class = 'b';
                }
            }

            $arsize = sizeof($files);
            for ($i = 0; $i < $arsize; $i++) {
                $icon = 'unknown.png';
                $ext = strtolower(substr($files[$i], strrpos($files[$i], '.') + 1));
                if (in_array($ext, $supportedextentions)) {

                    $thumb = '';
                    if ($filetypes[$ext]) {
                        $icon = $filetypes[$ext];
                    }

                    $filename = $files[$i];
                    //if(strlen($filename)>43) {
                    //	$filename = substr($files[$i], 0, 40) . '...';
                    //}
                    $fileurl = $leadon . $files[$i];
                    $filedir = str_replace($imagebasedir, "", $leadon);
                    ?>
                    <a href=# onclick="selectImage('<?php echo $filedir . $filename; ?>');return false"><img src="images/<?php echo $icon; ?>" alt="<?php echo $files[$i]; ?>"
                                                                                                               border="0">
                        <strong><?php echo $filename; ?></strong></a><br>
                    <?php
                    if ($class == 'b') {
                        $class = 'w';
                    }
                    else {
                        $class = 'b';
                    }
                }
            }
            ?>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
