<?php
/**
 * 本文件用于将phpBB整合在其他系统中
 * 作者: FlyingHail
 */

if( isset($phpbb_root_path) && !defined('IN_PHPBB'))
{
	/**
	 * 用户整合函数
	 * 
	 * @param string $op   执行的操作: 建立(insert), 更新(update), 删除(delete), 登录(login), 注销(logout)
	 * @param array  $user 用户数据: 用户ID[user_id], 用户名[username], 密码[user_password], Email[user_email]等等
	 */
	function phpbb_user($op, &$user)
	{
		// 连接到phpBB数据库
		$phpbb_set = phpbb_set();
		$phpbb_dbc = $phpbb_set['dbc'];
		$prefix = $phpbb_set['prefix'];
		$user_id = $user['user_id'];

		if ( $user_id == 2 )
		{
			die("说明: 用户ID 2是phpBB的默认管理员，不能在其他程序中进行操作，如果这是您第一次注册用户，请再注册一个新的用户。如果您是ID为 2 的用户，请联系网站管理员。");
		}

		switch ($op)
		{
			case 'insert':
				// 这里只插入最少的用户数据.
				$sql = "INSERT INTO " . $prefix ."users (`user_id`, `username`, `user_password`, `user_regdate`, `user_email`) VALUES ($user_id, '" . $user['username'] . "', '" . $user['user_password'] . "', " . time() . ", '" . $user['user_email'] . "')";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				// 建立用户组
				$sql = "INSERT INTO " . $prefix . "groups (`group_type`, `group_name`, `group_description`, `group_moderator`, `group_single_user`) VALUES (1, '" . $user['username'] . "', 'Personal User', 0, 1)";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
				$group_id = mysql_insert_id($phpbb_dbc);

				// 插入用户到该用户组
				$sql = "INSERT INTO " . $prefix . "user_group (`group_id`, `user_id`, `user_pending`) VALUES($group_id, $user_id, 0)";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				// 不需要更新的资料
				unset($user['username'],$user['user_password'],$user['user_email']);
				// 更新其他资料
				phpbb_update_profile_fields($user, $phpbb_dbc, $prefix);
				break;

			case 'update':
				// 更新资料
				phpbb_update_profile_fields($user, $phpbb_dbc, $prefix);
				break;

			case 'delete':
				$sql = "SELECT u.username, g.group_id
					FROM " . $prefix . "users u, " . $prefix . "user_group ug, " . $prefix . "groups g  
					WHERE  u.user_id = $user_id
						AND ug.user_id = u.user_id
						AND g.group_id = ug.group_id 
						AND g.group_single_user = 1";
				$result = mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
				$row = mysql_fetch_assoc($result);

				$sql = "UPDATE " . $prefix . "posts
					SET poster_id = -1, post_username = '" . str_replace("\\'", "''", addslashes($row['username'])) . "' 
					WHERE poster_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "UPDATE " . $prefix . "topics
					SET topic_poster = -1 
					WHERE topic_poster = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "UPDATE " . $prefix . "vote_users
					SET vote_user_id = -1
					WHERE vote_user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "SELECT group_id
					FROM " . $prefix . "groups
					WHERE group_moderator = $user_id";
				$result = mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				while ( $row_group = mysql_fetch_assoc($result) )
				{
					$group_moderator[] = $row_group['group_id'];
				}

				if ( count($group_moderator) )
				{
					$update_moderator_id = implode(', ', $group_moderator);

					$sql = "UPDATE " . $prefix . "groups
						SET group_moderator = 2
						WHERE group_moderator IN ($update_moderator_id)";
					mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
				}

				$sql = "DELETE FROM " . $prefix . "users
					WHERE user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "user_group
					WHERE user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "groups
					WHERE group_id = " . $row['group_id'];
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "auth_access
					WHERE group_id = " . $row['group_id'];
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "topics_watch
					WHERE user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "banlist
					WHERE ban_userid = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "SELECT privmsgs_id
					FROM " . $prefix . "privmsgs
					WHERE privmsgs_from_userid = $user_id 
						OR privmsgs_to_userid = $user_id";
				$result = mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
				while ( $row_privmsgs = mysql_fetch_assoc($result) )
				{
					$mark_list[] = $row_privmsgs['privmsgs_id'];
				}

				if ( count($mark_list) )
				{
					$delete_sql_id = implode(', ', $mark_list);

					$delete_text_sql = "DELETE FROM " . $prefix . "privmsgs_text
						WHERE privmsgs_text_id IN ($delete_sql_id)";
					$delete_sql = "DELETE FROM " . $prefix . "privmsgs
						WHERE privmsgs_id IN ($delete_sql_id)";

					mysql_query($delete_sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $delete_sql . "\n");
					mysql_query($delete_text_sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $delete_text_sql . "\n");
				}
				break;

			case 'login':
				// 如果用户存在则进行登录设置
				$sql = "SELECT user_id FROM " . $prefix . "users WHERE `user_id` = $user_id";
				$result = mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
				if ( mysql_num_rows($result) == 1 )
				{
					// 设置session和cookie
					$cookie_set = phpbb_cookie_set($phpbb_dbc, $prefix);
					$user['session_id'] = phpbb_insert_session($phpbb_dbc, $prefix, $user_id);
					phpbb_set_cookies($cookie_set, $user);
				}
				
				break;

			case 'logout':
				$cookie_set = phpbb_cookie_set($phpbb_dbc, $prefix);
				phpbb_delete_session($phpbb_dbc, $prefix, $user_id);
				phpbb_unset_cookies($cookie_set);
				break;
		}
	}

	/**
	 * 获取phpBB的设置，建立数据库连接(只支持MySQL)，获取数据表前缀
	 */
	function phpbb_set()
	{
		global $phpbb_root_path;
		include($phpbb_root_path.'config.php');

		if (!strstr($dbms, 'mysql'))
		{
			die('只支持使用MySQL的phpBB，您使用的数据库为: ' . $dbms);
		}

		$phpbb_dbc = mysql_connect($dbhost, $dbuser, $dbpasswd);
		mysql_select_db($dbname, $phpbb_dbc);
		$phpbb_set['dbc'] = $phpbb_dbc;
		$phpbb_set['prefix'] = $table_prefix;
		return $phpbb_set;
	}

	/**
	 * 更新用户资料
	 *
	 * @param array  $user 获得的用户资料
	 * @param object $phpbb_dbc 数据库连接
	 * @param string $prefix 数据库前缀
	 */
	function phpbb_update_profile_fields(&$user, &$phpbb_dbc, $prefix)
	{
		$user_id = $user['user_id'];
		unset($user['user_id']);
		if(!empty($user))
		{
			$sql = "UPDATE " . $prefix ."users SET ";
			foreach ($user as $akey => $aval)
			{
				$sql_set .= "`$akey` = '" . $aval . "', ";
			}
			$sql = substr($sql_set, 0, -2);
			$sql .= " WHERE user_id = $user_id LIMIT 1";
			mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
		}
	}

	/**
	 * 获取phpBB的cookie设置
	 *
	 * @param  object $phpbb_dbc 数据库连接
	 * @param  string $prefix 数据表前缀
	 * @return array  $cookie_set 包含cookie设置信息的数组
	 */
	function phpbb_cookie_set(&$phpbb_dbc, $prefix)
	{
		$sql = 	"SELECT config_name, config_value
		FROM " . $prefix . "config";
		$result = mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
		while($row = mysql_fetch_assoc($result))
		{
			$phpbb_config[$row['config_name']] = $row['config_value'];
		}
		$cookie_set['cookie_name'] = $phpbb_config['cookie_name'];
		$cookie_set['cookie_path'] = $phpbb_config['cookie_path'];
		$cookie_set['cookie_domain'] = $phpbb_config['cookie_domain'];
		$cookie_set['cookie_secure'] = $phpbb_config['cookie_secure'];

		return $cookie_set;
	}

	/**
	 * 向phpBB的Session表插入数据
	 *
	 * @param  object  $phpbb_dbc 数据库连接
	 * @param  string  $prefix 数据表前缀
	 * @param  integer $user_id 用户ID
	 * @return string  $session_id 用户的Session ID
	 */
	function phpbb_insert_session(&$phpbb_dbc, $prefix, $user_id)
	{
		$session_id = md5(uniqid(mt_rand(), true));
		$sql = "INSERT INTO " . $prefix . "sessions (`session_id`, `session_user_id`, `session_start`, `session_time`, `session_ip`, `session_page`, `session_logged_in`, `session_admin`) VALUES ('$session_id', $user_id, " . time() . ", " . time() . ", '" . phpbb_encoded_client_ip() . "' , 0, 1, 0)";

		mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
		return $session_id;
	}

	/**
	 * 从数据库中删除Session
	 *
	 * @param object  $phpbb_dbc 数据库连接
	 * @param string  $prefix 数据表前缀
	 * @param integer $user_id 用户ID
	 */
	function phpbb_delete_session(&$phpbb_dbc, $prefix, $user_id)
	{
		$sql = "DELETE FROM " . $prefix . "sessions WHERE `session_user_id` = " . $user_id . " AND `session_ip`='" .phpbb_encoded_client_ip(). "'";
		mysql_query($sql, $phpbb_dbc) or die('查询失败: ' . mysql_error() . " \n" . $sql . "\n");
	}

	/**
	 * 设置Cookie
	 *
	 * @param array   $phpbb_cookie_set phpBB的Cookie设置资料
	 * @param integer $user_id 用户ID
	 */
	function phpbb_set_cookies($phpbb_cookie_set, $user_id)
	{
		$sessiondata = array();
		$sessiondata['userid'] = $user_id;
		$sessiondata['autologinid'] = uniqid(mt_rand(), true);
		$sessiondata['user_active'] = 1;

		setcookie($phpbb_cookie_set['cookie_name'] . '_data', serialize($sessiondata), time() + 31536000, $phpbb_cookie_set['cookie_path'], $phpbb_cookie_set['cookie_domain'], $phpbb_cookie_set['cookie_secure']);
		setcookie($phpbb_cookie_set['cookie_name'] . '_sid', $user['session_id'], 0, $phpbb_cookie_set['cookie_path'], $phpbb_cookie_set['cookie_domain'], $phpbb_cookie_set['cookie_secure']);
	}

	/**
	 * 删除Cookie
	 *
	 * @param array $phpbb_cookie_set phpBB的Cookie设置资料
	 */
	function phpbb_unset_cookies($phpbb_cookie_set)
	{
		$sessiondata = array();
		setcookie($phpbb_cookie_set['cookie_name'] . '_data', serialize($sessiondata), $current_time - 31536000, $phpbb_cookie_set['cookie_path'], $phpbb_cookie_set['cookie_domain'], $phpbb_cookie_set['cookie_secure']);
		setcookie($phpbb_cookie_set['cookie_name'] . '_sid', '', $current_time - 31536000, $phpbb_cookie_set['cookie_path'], $phpbb_cookie_set['cookie_domain'], $phpbb_cookie_set['cookie_secure']);
	}

	/**
	 * 生成符合phpBB格式的IP地址
	 *
	 * @return string 16进制的IP地址字符串
	 */
	function phpbb_encoded_client_ip()
	{
		$ip_sep =  explode('.', $_SERVER['REMOTE_ADDR']);
		return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
	}
}
?>