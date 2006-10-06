<?php
/**
 *
 * ApfGrouprights.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: ApfGrouprights.class.php,v 1.1 2006/10/06 10:50:40 arzen Exp $
 */

class ApfGrouprights   extends Actions
{

	function executeGrouprightsubmit () 
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
		    foreach($new_ingrouplist_arr as $right_id)
		    {
			    $data = array(
			        'group_id' => $group,
			        'right_id' => $right_id
			    );
			    $granted = $luadmin->perm->grantGroupRight($data);
//			    Var_Dump::display(array($data,$granted));
		    }
		}
		
		if (is_array($remove_ingrouplist_arr) && sizeof($remove_ingrouplist_arr)>0) 
		{
		    foreach($remove_ingrouplist_arr as $right_id)
		    {
				$filters = array(
				    'right_id' => $right_id,
				    'group_id' => $group
				);
				$removed = $luadmin->perm->revokeGroupRight($filters);
		    }
		}
		$this->forward("users/apf_grouprights/");
			

	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$luadmin,$i18n;

//		Var_Dump::display($luadmin->perm->getRights());
//		$params = array(
//		    'fields' => array(
//		        'right_id',
//		        'right_define_name',
//		        'group_id'
//		    ),
//		    'with' => array(
//		        'group_id' => array(
//		            'fields' => array(
//		                'group_id'
//		            ),
//		        ),
//		    ),
//		    'filters' => array(
//		        'group_id' => 3
//		    ),
//		    'by_group' => true,
//		);
//		$allGroupRights = $luadmin->perm->getRights($params);
//		
//		$group_rights = array();
//		if (is_array($allGroupRights) &&  count($allGroupRights)>0) 
//		{
//			foreach($allGroupRights as $key=>$userdata)
//			{
//				$group_rights[$userdata['right_id']] = $userdata['right_define_name'];		
//			}
//		}
//		Var_Dump::display($allGroupRights);
		
		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_group_rights_list.html"
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
			"GROUPOPTION" => selectTag("group",$category_arr,"","onchange=\"remoteGroupRights.inGroupRights(this.value);remoteGroupRights.unInGroupRights(this.value)\""),
			"DOACTION" => "grouprightsubmit"
		));
	
	}

}
?>