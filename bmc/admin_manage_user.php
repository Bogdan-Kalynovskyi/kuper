<?php
define('REQUIRED', 3);
require "bmc/main.php";

include A_VIEW . "header.php";


if (!isnumeric($_GET['user'])) {
    bmc_go(-1);
}
$usr = $db->query("SELECT * FROM " . PRF . "users WHERE id=" . a($_GET['user']));
if (!$usr) {
    error_msg();
}



?>

<h1>Manage user <b><?php echo $usr['name']; ?></b></h1>
<br>
<img src="<?php echo $usr['pic']; ?>">
<br>
Login:<?php echo $usr['login']; ?><br>
Admin description:
<p>
    <?php echo $usr['login']; ?>
</p>

<br>
<buton>Pay User</button><br>
    <buton>Add to Project</button><br><br>
        <buton>Edit User</button><br><br>
            <buton>Ban User</button><br>
                <buton>Delete User</button><br>


                  <?php
                    include A_VIEW . "footer.php";
                  ?>
