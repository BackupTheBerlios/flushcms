<br/>
<br/>
<?php
if ($sf_request->hasErrors())
{ 
  $error_mesg = "输入的用户名与密码不符，请重新输入";
}
else
{
	$error_mesg = ""; 
} 
$login_form = new sfLoginForm();
$login_form->renderLoginForm($sf_params->get('login'),$error_mesg);
?>