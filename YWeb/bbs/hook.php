<?php
/**
 * ���ļ����ڽ�phpBB����������ϵͳ��
 * ����: FlyingHail
 */

if( isset($phpbb_root_path) && !defined('IN_PHPBB'))
{
	/**
	 * �û����Ϻ���
	 * 
	 * @param string $op   ִ�еĲ���: ����(insert), ����(update), ɾ��(delete), ��¼(login), ע��(logout)
	 * @param array  $user �û�����: �û�ID[user_id], �û���[username], ����[user_password], Email[user_email]�ȵ�
	 */
	function phpbb_user($op, &$user)
	{
		// ���ӵ�phpBB���ݿ�
		$phpbb_set = phpbb_set();
		$phpbb_dbc = $phpbb_set['dbc'];
		$prefix = $phpbb_set['prefix'];
		$user_id = $user['user_id'];

		if ( $user_id == 2 )
		{
			die("˵��: �û�ID 2��phpBB��Ĭ�Ϲ���Ա�����������������н��в����������������һ��ע���û�������ע��һ���µ��û����������IDΪ 2 ���û�������ϵ��վ����Ա��");
		}

		switch ($op)
		{
			case 'insert':
				// ����ֻ�������ٵ��û�����.
				$sql = "INSERT INTO " . $prefix ."users (`user_id`, `username`, `user_password`, `user_regdate`, `user_email`) VALUES ($user_id, '" . $user['username'] . "', '" . $user['user_password'] . "', " . time() . ", '" . $user['user_email'] . "')";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				// �����û���
				$sql = "INSERT INTO " . $prefix . "groups (`group_type`, `group_name`, `group_description`, `group_moderator`, `group_single_user`) VALUES (1, '" . $user['username'] . "', 'Personal User', 0, 1)";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
				$group_id = mysql_insert_id($phpbb_dbc);

				// �����û������û���
				$sql = "INSERT INTO " . $prefix . "user_group (`group_id`, `user_id`, `user_pending`) VALUES($group_id, $user_id, 0)";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				// ����Ҫ���µ�����
				unset($user['username'],$user['user_password'],$user['user_email']);
				// ������������
				phpbb_update_profile_fields($user, $phpbb_dbc, $prefix);
				break;

			case 'update':
				// ��������
				phpbb_update_profile_fields($user, $phpbb_dbc, $prefix);
				break;

			case 'delete':
				$sql = "SELECT u.username, g.group_id
					FROM " . $prefix . "users u, " . $prefix . "user_group ug, " . $prefix . "groups g  
					WHERE  u.user_id = $user_id
						AND ug.user_id = u.user_id
						AND g.group_id = ug.group_id 
						AND g.group_single_user = 1";
				$result = mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
				$row = mysql_fetch_assoc($result);

				$sql = "UPDATE " . $prefix . "posts
					SET poster_id = -1, post_username = '" . str_replace("\\'", "''", addslashes($row['username'])) . "' 
					WHERE poster_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "UPDATE " . $prefix . "topics
					SET topic_poster = -1 
					WHERE topic_poster = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "UPDATE " . $prefix . "vote_users
					SET vote_user_id = -1
					WHERE vote_user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "SELECT group_id
					FROM " . $prefix . "groups
					WHERE group_moderator = $user_id";
				$result = mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

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
					mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
				}

				$sql = "DELETE FROM " . $prefix . "users
					WHERE user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "user_group
					WHERE user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "groups
					WHERE group_id = " . $row['group_id'];
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "auth_access
					WHERE group_id = " . $row['group_id'];
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "topics_watch
					WHERE user_id = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "DELETE FROM " . $prefix . "banlist
					WHERE ban_userid = $user_id";
				mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");

				$sql = "SELECT privmsgs_id
					FROM " . $prefix . "privmsgs
					WHERE privmsgs_from_userid = $user_id 
						OR privmsgs_to_userid = $user_id";
				$result = mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
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

					mysql_query($delete_sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $delete_sql . "\n");
					mysql_query($delete_text_sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $delete_text_sql . "\n");
				}
				break;

			case 'login':
				// ����û���������е�¼����
				$sql = "SELECT user_id FROM " . $prefix . "users WHERE `user_id` = $user_id";
				$result = mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
				if ( mysql_num_rows($result) == 1 )
				{
					// ����session��cookie
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
	 * ��ȡphpBB�����ã��������ݿ�����(ֻ֧��MySQL)����ȡ���ݱ�ǰ׺
	 */
	function phpbb_set()
	{
		global $phpbb_root_path;
		include($phpbb_root_path.'config.php');

		if (!strstr($dbms, 'mysql'))
		{
			die('ֻ֧��ʹ��MySQL��phpBB����ʹ�õ����ݿ�Ϊ: ' . $dbms);
		}

		$phpbb_dbc = mysql_connect($dbhost, $dbuser, $dbpasswd);
		mysql_select_db($dbname, $phpbb_dbc);
		$phpbb_set['dbc'] = $phpbb_dbc;
		$phpbb_set['prefix'] = $table_prefix;
		return $phpbb_set;
	}

	/**
	 * �����û�����
	 *
	 * @param array  $user ��õ��û�����
	 * @param object $phpbb_dbc ���ݿ�����
	 * @param string $prefix ���ݿ�ǰ׺
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
			mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
		}
	}

	/**
	 * ��ȡphpBB��cookie����
	 *
	 * @param  object $phpbb_dbc ���ݿ�����
	 * @param  string $prefix ���ݱ�ǰ׺
	 * @return array  $cookie_set ����cookie������Ϣ������
	 */
	function phpbb_cookie_set(&$phpbb_dbc, $prefix)
	{
		$sql = 	"SELECT config_name, config_value
		FROM " . $prefix . "config";
		$result = mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
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
	 * ��phpBB��Session���������
	 *
	 * @param  object  $phpbb_dbc ���ݿ�����
	 * @param  string  $prefix ���ݱ�ǰ׺
	 * @param  integer $user_id �û�ID
	 * @return string  $session_id �û���Session ID
	 */
	function phpbb_insert_session(&$phpbb_dbc, $prefix, $user_id)
	{
		$session_id = md5(uniqid(mt_rand(), true));
		$sql = "INSERT INTO " . $prefix . "sessions (`session_id`, `session_user_id`, `session_start`, `session_time`, `session_ip`, `session_page`, `session_logged_in`, `session_admin`) VALUES ('$session_id', $user_id, " . time() . ", " . time() . ", '" . phpbb_encoded_client_ip() . "' , 0, 1, 0)";

		mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
		return $session_id;
	}

	/**
	 * �����ݿ���ɾ��Session
	 *
	 * @param object  $phpbb_dbc ���ݿ�����
	 * @param string  $prefix ���ݱ�ǰ׺
	 * @param integer $user_id �û�ID
	 */
	function phpbb_delete_session(&$phpbb_dbc, $prefix, $user_id)
	{
		$sql = "DELETE FROM " . $prefix . "sessions WHERE `session_user_id` = " . $user_id . " AND `session_ip`='" .phpbb_encoded_client_ip(). "'";
		mysql_query($sql, $phpbb_dbc) or die('��ѯʧ��: ' . mysql_error() . " \n" . $sql . "\n");
	}

	/**
	 * ����Cookie
	 *
	 * @param array   $phpbb_cookie_set phpBB��Cookie��������
	 * @param integer $user_id �û�ID
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
	 * ɾ��Cookie
	 *
	 * @param array $phpbb_cookie_set phpBB��Cookie��������
	 */
	function phpbb_unset_cookies($phpbb_cookie_set)
	{
		$sessiondata = array();
		setcookie($phpbb_cookie_set['cookie_name'] . '_data', serialize($sessiondata), $current_time - 31536000, $phpbb_cookie_set['cookie_path'], $phpbb_cookie_set['cookie_domain'], $phpbb_cookie_set['cookie_secure']);
		setcookie($phpbb_cookie_set['cookie_name'] . '_sid', '', $current_time - 31536000, $phpbb_cookie_set['cookie_path'], $phpbb_cookie_set['cookie_domain'], $phpbb_cookie_set['cookie_secure']);
	}

	/**
	 * ���ɷ���phpBB��ʽ��IP��ַ
	 *
	 * @return string 16���Ƶ�IP��ַ�ַ���
	 */
	function phpbb_encoded_client_ip()
	{
		$ip_sep =  explode('.', $_SERVER['REMOTE_ADDR']);
		return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
	}
}
?>