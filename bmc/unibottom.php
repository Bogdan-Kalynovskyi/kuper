<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}?>

    <td style="border-left:1px solid #999;vertical-align:top;padding:0 0 0 18px"><br/>


        <input type="button" id="b_add" style="width:100px" value="Save" class="btn" onclick="edit1()"/>
        <br/><br/>
        <input type="button" id="b_del" style="width:100px" value="Delete" class="btn" onclick="delete1()"/>
        <br/><br/><br/><br/>
        <input type="button" id="b_more" style="width:100px" value="More... >" class="btn" onclick="more1()"/>

        <br/><br/><br/><br/>

        <h3 style="color:green"><?php if (isset($_result)) {
                echo $_result;
            } ?></h3>

    </td></tr>

    </table>

    </fieldset>
    </form>






    <script src="js/all.js"></script>

<?php
include A_ROOT . "js/all.js.php";

include A_VIEW . "footer.php";
?>