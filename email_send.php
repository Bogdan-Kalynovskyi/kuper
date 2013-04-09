<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");

	include_once A_HOME."fun_login.php";
//todo preview
//todo ipban(очень потом)
	$message = '';
	
	if(isset($_POST[USER_HASH]) && $_POST[USER_HASH]=='2'){
		if(bad_cap(true)){
			$message = "Введите правильно код на картинке";
			$ok = false;
			
		}elseif(!trim(@$_POST['text'])){
			$message = "Вы вероятно забыли ввести сообщение";
			$ok = false;
						
		}else{
			
			$_POST['name'] = htmlspecialchars_decode($_POST['name']);				
			$_POST['text'] = htmlspecialchars_decode($_POST['text'])."</pre>";				

try{
			require_once('PHPMailer/class.phpmailer.php');
			
			$mail             = new PHPMailer();
						
			$mail->CharSet = $CHRST;
			$mail->IsHTML(true); 
			$Reply = isemail($_POST['email'])?"<a href=\"mailto:{$_POST['email']}\">{$_POST['email']}</a>":$_POST['email'];
			
			//..$mail->SetFrom($Reply, 'Письмо с kuperfild.ru');
			$mail->AddAddress($bmc_vars['email']);
			$mail->Subject    = "Письмо с kuperfild.ru! Пишет  {$_POST['name']}";
			$mail->FromName = 'kuperfild.ru';
			$mail->From = 'noreply@kuperfild.ru';
						
			$msg = "
			Человек представился как <big><b style=\"margin-left:8px;color:#755\">{$_POST['name']}</b></big>.
			<br/>Оставил свои координаты: <big style=\"margin-left:8px\">$Reply</big> 
			<br/>
			<br/>---------------------- Написал: ----------------------- <br/> <pre style=\"white-space:pre-wrap;	font-size:14px\">"; // optional, comment out and test
			
			$mail->AltBody    = strip_tags($msg).$_POST['text'];
			$mail->MsgHTML($msg.$_POST['text']);
			
			if($mail->Send()) {
					$message = "Письмо успешно отправлено!";
					$ok = true;
					unset($_POST);
			} else {
					$message = "Какая-то бага =(. Попробуйте еще раз!";
					$ok = false;
			}
} catch (phpmailerException $e) {
  $message =  $e->errorMessage(); //Pretty error messages from PHPMailer
					$ok = false;
} catch (Exception $e) {
  $message =  $e->getMessage(); //Boring error messages from anything else!
					$ok = false;
}		
		}
	}




?>

<link rel="stylesheet" type="text/css" href="guestbook.css" />
<link rel="stylesheet" type="text/css" href="email_send.css" />


<div id="xyz">
	
<h1>Контакты</h1>

<div id="sex">
	<?php
	
	function email_pr($s){
		$s = str_replace('http://','',$s);
		if(strlen($s)>26)
			$s = substr($s, 0, 24).'&#133;';
		return $s;
	}
	
        echo '<a target="_blank" href="'.$bmc_vars['vk'].'"><img src="images/vk.png" alt="ВКонтакте" />'.email_pr($bmc_vars['vk']).'</a>';
		echo '<a target="_blank" href="'.$bmc_vars['lj'].'"><img src="images/lj.png" alt="Уютная ЖЖ" />'.email_pr($bmc_vars['lj']).'</a>';
		echo '<a target="_blank" href="mailto:'.$bmc_vars['email'].'"><img src="images/email.png" alt="Е-мейл" />'.email_pr($bmc_vars['email']).'</a>';
		echo '<a target="_blank" href="callto:'.$bmc_vars['phone'].'"><img src="images/phone.png" alt="Телефон" />'.email_pr($bmc_vars['phone']).'</a>';
    ?>
</div>

<?php
					
		if($bmc_vars['contacts'])
			echo "<div id=\"dezz\">{$bmc_vars['contacts']}</div>";
		else
			echo "<div  style=\"clear:both;height:18px\"></div>";
			
?>     
</div>
<br/>


<div id="overall">







<img src="images/ida_env2.jpg" alt="" id="envelope" />


<h3 style="padding:17px 0 6px 0;color:#222">
	Написать мне письмо</h3><br/>


<br/>
<?php
	if($message){
		echo '<label><span class="bar '.($ok?'green':'red').'">'.$message.'</span></label><label></label>';
	}
?>


<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>"  accept-charset="<?php echo $CHRST ?>"  onsubmit="return verify_form()">
<fieldset><br/><br/>
	<input type="hidden" name="<?php echo USER_HASH; ?>" value="2" />

	
	<label>Представтесь пожалуста
		<input type="text" name="name" value="<?php echo htmlspecialchars(@$_POST['name']) ?>" tabindex="10" />
	</label>

	<label>Как Вас найти?&nbsp; <span>(email, блог&#133;)</span>
		<input type="text" name="email" value="<?php echo htmlspecialchars(@$_POST['email']) ?>" tabindex="20" />
	</label>

	<label style="height:120px">Текст сообщения <span style="color:red">*</span>
		<textarea name="text" cols="80" rows="4" tabindex="30"><?php echo htmlspecialchars(@$_POST['text']) ?></textarea>
	</label>
	
	
	<?php show_cap1(true); ?>

	<br/>
	<label>
		<input type="submit"  style="letter-spacing:1px" value="         Отправить         " tabindex="100" />
	</label><br/><br/>
		
</fieldset>
</form>
</div>




<script type="text/javascript" src="js/jslib.js"></script>
<script type="text/javascript">

   function verify_form(){
   		if(! document.getElementsByName('text')[0].value ){
   			alert('Напишите хоть что нибудь в тексте сообщеиня');
   			return false;
   		}
   		return true;
   	}
   	
  <?php show_cap_js1(true) ?>

</script>
