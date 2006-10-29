<?php
/**
 *
 * GroupRights.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: GroupRights.class.php,v 1.1 2006/10/29 09:21:13 arzen Exp $
 */

class GroupRights
{

	function inGroupRights($group)
	{
		$group_rights = $this->getInGroupRights($group);
		
		return count($group_rights)>0?$group_rights:array(""=>"");
	}

	function unInGroupRights($group)
	{
		$group_rights = $this->getUnInGroupRights($group);
		return count($group_rights)>0?$group_rights:array(""=>"");
	}
	
	function getInGroupRights ($group) 
	{
		global $luadmin,$i18n;
		
		$params = array(
		    'fields' => array(
		        'right_id',
		        'right_define_name',
		        'group_id'
		    ),
		    'with' => array(
		        'group_id' => array(
		            'fields' => array(
		                'group_id'
		            ),
		        ),
		    ),
		    'filters' => array(
		        'group_id' => $group
		    ),
		    'by_group' => true,
		);
		$allGroupRights = $luadmin->perm->getRights($params);
		
		$group_rights = array();
		if (is_array($allGroupRights) &&  count($allGroupRights)>0) 
		{
			foreach($allGroupRights as $key=>$userdata)
			{
				$group_rights[$userdata['right_id']] = $userdata['right_define_name'];//$i18n->_($userdata['right_define_name']);		
			}
		}
		
		return $group_rights;
	}
	
	function getAllRights () 
	{
		global $luadmin,$i18n;
		$rightsGroup = $luadmin->perm->getRights();
		$group_rights = array();
		if (is_array($rightsGroup) && count($rightsGroup)>0) 
		{
			foreach($rightsGroup as $key=>$userdata)
			{
				$group_rights[$userdata['right_id']] = $userdata['right_define_name'];//$i18n->_($userdata['right_define_name']);		
			}
		}
		
		return $group_rights;
	}
	
	function getUnInGroupRights ($group) 
	{
		$all_rights = $this->getAllRights();
		$in_group_rights = $this->getInGroupRights($group);
		if (count($all_rights)>0) 
		{
			return $un_in_group_rights = array_diff($all_rights, $in_group_rights);
		}
		return ;
	}
	
}
?>