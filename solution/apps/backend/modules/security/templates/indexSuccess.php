<br/>
<br/>
<?php
if ($sf_request->hasErrors())
{ 
  $error_mesg = "������û��������벻��������������";
}
else
{
	$error_mesg = ""; 
} 
$login_form = new sfLoginForm();
$login_form->renderLoginForm($sf_params->get('login'),$error_mesg);
?>