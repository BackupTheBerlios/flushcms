<?php
/**
 *
 * GroupUsers.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: GroupUsers.class.php,v 1.2 2006/10/23 23:36:56 arzen Exp $
 */
class GroupUsers
{
	function inGroupUsers($group)
	{
		$group_users = $this->getInGroupUsers($group);
		
		return count($group_users)>0?$group_users:array(""=>"");
	}

	function unInGroupUsers($group)
	{
		$group_users = $this->getUnInGroupUsers($group);
		return count($group_users)>0?$group_users:array(""=>"");
	}
	
	function getInGroupUsers ($group) 
	{
		global $luadmin;
		$params = array(
		    'filters' => array(
		        'group_id' => $group
		    )
		);
		$usersGroup = $luadmin->getUsers($params);
		$group_users = array();
		foreach($usersGroup as $key=>$userdata)
		{
			$group_users[$userdata['perm_user_id']] = $userdata['handle'];		
		}
		
		return $group_users;
	}
	
	function getAllUsers () 
	{
		global $luadmin;
		$usersGroup = $luadmin->getUsers();
		$group_users = array();
		foreach($usersGroup as $key=>$userdata)
		{
			$group_users[$userdata['perm_user_id']] = $userdata['handle'];		
		}
		
		return $group_users;
	}
	
	function getUnInGroupUsers ($group) 
	{
		$all_users = $this->getAllUsers();
		$in_group_users = $this->getInGroupUsers($group);
		if (count($all_users)>0) 
		{
			return $un_in_group_users = array_diff($all_users, $in_group_users);
		}
		return ;
	}
	
}
?>