<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}

?>

<form name="f" method=post action="user.php" accept-charset="<?php echo $CHRST ?>">
    <fieldset>
        <input type=hidden name="<?php echo FORM_HASH; ?>" value="2">

        <label>Заголовок сайта<br>
            <input type=text name="site_title" value="<?php echo htmlspecialchars(@$bmc_vars['site_title']); ?>" size="96">
        </label><br><br>

        <label>Ключевые слова сайта для поисковых машин<br>
            <input type=text name="site_keywords" value="<?php echo htmlspecialchars(@$bmc_vars['site_keywords']); ?>" size="96">
        </label><br><br>

        <label>Описание сайта для поисковых машин<br>
            <input type=text name="site_desc" value="<?php echo htmlspecialchars(@$bmc_vars['site_desc']); ?>" size="96">
        </label><br><br>

        <!-->	<label>Опис сайту для людей<br>
		<textarea name="site_welcome" cols="80" rows="3"><?php echo htmlspecialchars(@$bmc_vars['site_welcome']); ?></textarea>
	</label><br><br><br>-->
        ---
        <label>Контактный Email<br>
            <input type=text name="email" value="<?php echo htmlspecialchars(@$bmc_vars['email']); ?>" size="96">
        </label><br><br>
        ---
        <label>Контактный телефон<br>
            <input type=text name="phone" value="<?php echo htmlspecialchars(@$bmc_vars['phone']); ?>" size="96">
        </label><br><br>

        <label>Контакты ВКонтакте, Twitter, Facebook (код)<br>
            <textarea name="twitter" cols="80" rows="4"><?php echo htmlspecialchars(@$bmc_vars['twitter']); ?></textarea>
        </label><br><br><br>

        <label><b>Другие контакты (текст. ICQ здесь же) </b><br>
            <input type=text name="contacts" value="<?php echo htmlspecialchars(@$bmc_vars['contacts']); ?>" size="96">
        </label><br><br><br>

        <input type=submit value="      Зберегти      ">

    </fieldset>
</form>
