<?php
/**
 *
 * ApfGroupusers.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: ApfGroupusers.class.php,v 1.2 2006/10/06 10:50:40 arzen Exp $
 */

class ApfGroupusers  extends Actions
{

	function executeGroupusersubmit () 
	{
		global $luadmin;
		
		$group = $_POST['group'];
		$old_ingroup_arr = explode(",",rtrim($_POST['old_ingroup'],","));
		$old_uningroup_arr = explode(",",rtrim($_POST['old_uningroup'],","));
		$uningrouplist_arr = $_POST['uningrouplist']?$_POST['uningrouplist']:array();		
		$ingrouplist_arr = $_POST['ingrouplist']?$_POST['ingrouplist']:array();
		
		$new_ingrouplist_arr =	array_diff($ingrouplist_arr,$old_ingroup_arr);
		$remove_ingrouplist_arr = array_diff($old_ingroup_arr,$ingrouplist_arr);
		
		if (is_array($new_ingrouplist_arr) && sizeof($new_ingrouplist_arr)>0) 
		{
		    foreach($new_ingrouplist_arr as $user_id)
		    {
			    $data = array(
			        'perm_user_id' => $user_id,
			        'group_id' => $group
			       );
			    $luadmin->perm->addUserToGroup($data);
		    }
		}
		
		if (is_array($remove_ingrouplist_arr) && sizeof($remove_ingrouplist_arr)>0) 
		{
		    foreach($remove_ingrouplist_arr as $user_id)
		    {
			    $filter = array(
			        'perm_user_id' => $user_id,
			        'group_id' => $group
			       );
			    $removed = $luadmin->perm->removeUserFromGroup($filter);
		    }
		}
		$this->forward("users/apf_groupusers/");
			

	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$luadmin,$i18n;


		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_group_users_list.html"
		));
		
		$template->setBlock("MAIN", "main_list", "list_block");
		
		$groups = $luadmin->perm->getGroups();
		$category_arr = array(""=>$i18n->_("None"));
		foreach($groups as $data)
		{
			$category_arr[$data['group_id']] = $data['group_define_name'];
		}

		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"GROUPOPTION" => selectTag("group",$category_arr,"","onchange=\"remoteGroupUsers.inGroupUsers(this.value);remoteGroupUsers.unInGroupUsers(this.value)\""),
			"DOACTION" => "groupusersubmit"
		));
	
	}
	
}
?>