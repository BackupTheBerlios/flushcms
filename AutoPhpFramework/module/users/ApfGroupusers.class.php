<?php
/**
 *
 * ApfGroupusers.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: ApfGroupusers.class.php,v 1.1 2006/10/01 12:04:52 arzen Exp $
 */

class ApfGroupusers
{

	function executeGroupusersubmit () 
	{
		Var_Dump::display($_REQUEST);
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$luadmin;

		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_group_users_list.html"
		));
		
		$template->setBlock("MAIN", "main_list", "list_block");
		
		$groups = $luadmin->perm->getGroups();
		$category_arr = array();
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