<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}
//	if(!defined('LEVEL') || LEVEL < 1) return;//!USER-implied in header.php


//fix two-three bugs with ids here:form, div, fielset
if (isset($_POST['where']) && is_array($_POST['where'])) {
    $tbl = reset($_POST['where']);
}
else {
    $tbl = $table;
}

?>

<script>
    function __check_submit() {
        var x = document.getElementById('<?php echo SEARCH_HASH; ?>').value;
        return x.value.length > 2 && x.value != 'Search...';
    }

    function more_search() {
        var x = document.getElementById('__s3');
        if (s2.style.display == 'none') {
            s2.style.display = 'block';
        } else {
            s2.style.display = 'none';
        }
    }
</script>


<form accept-charset="<?php echo $CHRST ?>" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"
      onsubmit="return __check_submit()">
    <fieldset class="search_box" id="__s2">

        <input name="<?php echo SEARCH_HASH; ?>" id="<?php echo SEARCH_HASH; ?>" value="Site search..."
               onfocus="if(this.value=='Site search...'){this.value='';
}document.getElementById('__s2').style.opacity=1;document.getElementById('__s3').style.display='block'"
               onblur="if(this.value==''){this.value='Site search...';
}//document.getElementById('__s2').style.opacity=0.5"
            /><!--<img src="img/down.gif" alt="\\/"
		onclick="more_search()" onkeydown="alert();more_search()"
	/>--><input type="image" src="img/s.png" alt="&gt;"/>

        <div id="__s3"><!-- easing -->
            <input type="checkbox" name="deep" value="1"/> Deep&nbsp;&nbsp;

            <select name="where[]" size="1">
                <?php foreach ($STA as $s) {

                    if ($tbl == $s) {
                        $temp = ' selected="selected"';
                    }
                    else {
                        $temp = '';
                    }
                    if ($s == '') {
                        $s = 'All';
                    } //=)

                    echo "<option value=\"$s\"$temp>$s</option>";

                } ?>
            </select> Pages
            <input type="submit" value=" Go "/>
        </div>

    </fieldset>
</form>