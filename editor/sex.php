<form method=post action="user.php" enctype=multipart/form-data>
    <?php
    for ($i = 0; $i < 13; $i++) {
        echo <<<EOF
		<input type=file name="i$i">

EOF;
    }

    ?><input type=submit>
</form>
