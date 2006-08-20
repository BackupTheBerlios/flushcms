<?php
/**
 *
 * sfLogin.class.php class.
 * 
 * Usage:
 * 
 * $login_form = new sfLoginForm();
 * $login_form->renderLoginForm($sf_params->get('login'),$error_mesg);
 *
 * @package    symfony.runtime.addon
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfLoginForm.class.php,v 1.1 2006/08/20 05:27:51 arzen Exp $
 */
class sfLoginForm
{
	function renderLoginForm ($last_login="",$error_mesage="") 
	{
		$html_code_form = form_tag('security/login');
		$html_code_username = input_tag('login',$last_login);
		$html_code_password = input_password_tag('password');
		$html_code_submit = submit_tag('µÇÂ¼', 'class=default');
		$html_code_spacer = image_path('sflogin/spacer.gif');
		$html_code_win2000pro_r1_c1 = image_path('sflogin/win2000pro_r1_c1.png');
		$html_code_win2000pro_r2_c1 = image_path('sflogin/win2000pro_r2_c1.png');
		$html_code_win2000pro_r3_c1 = image_path('sflogin/win2000pro_r3_c1.png');
		$html_code_win2000pro_r5_c1 = image_path('sflogin/win2000pro_r5_c1.png');
		$html_code_win2000pro_r7_c1 = image_path('sflogin/win2000pro_r7_c1.png');
		echo $form_html = <<<EOD
<table width="417" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td><img src="{$html_code_spacer}" width="417" height="1" border="0" alt="" /></td>
   <td><img src="{$html_code_spacer}" width="1" height="1" border="0" alt="" /></td>
  </tr>

  <tr>
   <td background="{$html_code_win2000pro_r1_c1}">&nbsp;</td>
   <td><img src="{$html_code_spacer}" width="1" height="21" border="0" alt="" /></td>
  </tr>
  <tr>
   <td><img name="win2000pro_r2_c1" src="{$html_code_win2000pro_r2_c1}" width="417" height="87" border="0" id="win2000pro_r2_c1" alt="" /></td>
   <td><img src="{$html_code_spacer}" width="1" height="87" border="0" alt="" /></td>
  </tr>
  <tr>
   <td><img name="win2000pro_r3_c1" src="{$html_code_win2000pro_r3_c1}" width="417" height="7" border="0" id="win2000pro_r3_c1" alt="" /></td>
   <td><img src="{$html_code_spacer}" width="1" height="7" border="0" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="3" background="{$html_code_win2000pro_r5_c1}">
    {$html_code_form}

	<table width="80%" border="0" align="center">
       <tr>
         <td colspan="2" align="center"><font color="red">{$error_mesage}</font></td>
         </tr>
       <tr>
         <td>ÓÃ»§Ãû</td>
         <td><label>
           {$html_code_username}
         </label></td>
       </tr>
       <tr>
         <td>ÃÜÂë</td>
         <td>{$html_code_password}</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td colspan="2" align="center"><label>
           {$html_code_submit}
         </label></td>
         </tr>
     </table>

	</form>
    </td>
   <td><img src="{$html_code_spacer}" width="1" height="35" border="0" alt="" /></td>
  </tr>
  <tr>
   <td><img src="{$html_code_spacer}" width="1" height="8" border="0" alt="" /></td>
  </tr>
  <tr>
   <td><img src="{$html_code_spacer}" width="1" height="82" border="0" alt="" /></td>
  </tr>
  <tr>
   <td><img name="win2000pro_r7_c1" src="{$html_code_win2000pro_r7_c1}" width="417" height="16" border="0" id="win2000pro_r7_c1" alt="" /></td>
   <td><img src="{$html_code_spacer}" width="1" height="16" border="0" alt="" /></td>
  </tr>
</table>
EOD;
		
	}
}
?>