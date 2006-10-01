<?php
/**
 *
 * GroupUsersServer.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: GroupUsersServer.php,v 1.1 2006/10/01 12:04:52 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/../../..'));
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');

require_once 'HTML/AJAX/Server.php';

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
			$group_users[$userdata['auth_user_id']] = $userdata['handle'];		
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
			$group_users[$userdata['auth_user_id']] = $userdata['handle'];		
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

$server = new HTML_AJAX_Server();

// upperCase will export as uppercase in php4 and upperCase in php5
$server->registerClass(new GroupUsers());

// works in both php4 and 5 plus doing class name aliasing
$server->registerClass(new GroupUsers(), 'GroupUsers', array (
	'inGroupUsers',
	'unInGroupUsers'
));

$server->handleRequest();
?>
