
<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_SERVER_NAME}</td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="server_name" value="{SERVER_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SERVER_PORT}<br /><span class="gensmall">{L_SERVER_PORT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SCRIPT_PATH}<br /><span class="gensmall">{L_SCRIPT_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" name="script_path" value="{SCRIPT_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SITE_NAME}<br /><span class="gensmall">{L_SITE_NAME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="sitename" value="{SITENAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SITE_DESCRIPTION}</td>
		<td class="row2"><input class="post" type="text" size="40" maxlength="255" name="site_desc" value="{SITE_DESCRIPTION}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ACCT_ACTIVATION}</td>
		<td class="row2"><input type="radio" name="require_activation" value="{ACTIVATION_NONE}" {ACTIVATION_NONE_CHECKED} />{L_NONE}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_USER}" {ACTIVATION_USER_CHECKED} />{L_USER}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_ADMIN}" {ACTIVATION_ADMIN_CHECKED} />{L_ADMIN}</td>
	</tr>
	<tr>
		<td class="row1">{L_VISUAL_CONFIRM}<br /><span class="gensmall">{L_VISUAL_CONFIRM_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="enable_confirm" value="1" {CONFIRM_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="enable_confirm" value="0" {CONFIRM_DISABLE} />{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_AUTOLOGIN}<br /><span class="gensmall">{L_ALLOW_AUTOLOGIN_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="allow_autologin" value="1" {ALLOW_AUTOLOGIN_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="allow_autologin" value="0" {ALLOW_AUTOLOGIN_NO} />{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOLOGIN_TIME} <br /><span class="gensmall">{L_AUTOLOGIN_TIME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="{AUTOLOGIN_TIME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_BOARD_EMAIL_FORM}<br /><span class="gensmall">{L_BOARD_EMAIL_FORM_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} /> {L_ENABLED}&nbsp;&nbsp;<input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} /> {L_DISABLED}</td>
	</tr>
	<tr>
		<td class="row1">{L_FLOOD_INTERVAL} <br /><span class="gensmall">{L_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SEARCH_FLOOD_INTERVAL} <br /><span class="gensmall">{L_SEARCH_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="{SEARCH_FLOOD_INTERVAL}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_LOGIN_ATTEMPTS}<br /><span class="gensmall">{L_MAX_LOGIN_ATTEMPTS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="max_login_attempts" value="{MAX_LOGIN_ATTEMPTS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LOGIN_RESET_TIME}<br /><span class="gensmall">{L_LOGIN_RESET_TIME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="login_reset_time" value="{LOGIN_RESET_TIME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_TOPICS_PER_PAGE}</td>
		<td class="row2"><input class="post" type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_POSTS_PER_PAGE}</td>
		<td class="row2"><input class="post" type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_HOT_THRESHOLD}</td>
		<td class="row2"><input class="post" type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_STYLE}</td>
		<td class="row2">{STYLE_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_STYLE}<br /><span class="gensmall">{L_OVERRIDE_STYLE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_LANGUAGE}</td>
		<td class="row2">{LANG_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_DATE_FORMAT}<br /><span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="default_dateformat" value="{DEFAULT_DATEFORMAT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SYSTEM_TIMEZONE}</td>
		<td class="row2">{TIMEZONE_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_GZIP}</td>
		<td class="row2"><input type="radio" name="gzip_compress" value="1" {GZIP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="gzip_compress" value="0" {GZIP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_PRUNE}</td>
		<td class="row2"><input type="radio" name="prune_enable" value="1" {PRUNE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="prune_enable" value="0" {PRUNE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_BIRTHDAY_REQUIRED}<br /></td>
		<td class="row2"><input type="radio" name="birthday_required" value="1" {BIRTHDAY_REQUIRED_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="birthday_required" value="0" {BIRTHDAY_REQUIRED_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_BIRTHDAY_GREETING}<br /><span class="gensmall">{L_BIRTHDAY_GREETING_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="birthday_greeting" value="1" {BIRTHDAY_GREETING_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="birthday_greeting" value="0" {BIRTHDAY_GREETING_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_USER_AGE}<br /></td>
		<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="max_user_age" value="{MAX_USER_AGE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_MIN_USER_AGE}<br /><span class="gensmall">{L_MIN_USER_AGE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="min_user_age" value="{MIN_USER_AGE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_BIRTHDAY_LOOKFORWARD}<br /><span class="gensmall">{L_BIRTHDAY_LOOKFORWARD_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="3" name="birthday_check_day" value="{BIRTHDAY_LOOKFORWARD}" /></td>
	</tr>

	<tr> 
		<td class="row1">{L_BLUECARD_LIMIT_2}<br /><span class="gensmall">{L_BLUECARD_LIMIT_2_EXPLAIN}</span></td> 
		<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="bluecard_limit_2" value="{BLUECARD_LIMIT_2}" /></td> 
	</tr> 
	<tr> 
		<td class="row1">{L_BLUECARD_LIMIT}<br /><span class="gensmall">{L_BLUECARD_LIMIT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="bluecard_limit" value="{BLUECARD_LIMIT}" /></td> 
	</tr> 
	<tr> 
    	<td class="row1">{L_MAX_USER_BANCARD}<br /><span class="gensmall">{L_MAX_USER_BANCARD_EXPLAIN}</span></td> 
    	<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="max_user_bancard" value="{MAX_USER_BANCARD}" /></td> 
	</tr> 
	<tr> 
    	<td class="row1">{L_REPORT_FORUM}<br /><span class="gensmall">{L_REPORT_FORUM_EXPLAIN}</span></td> 
    	<td class="row2">{S_REPORT_FORUM}</td> 
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_DISABLE_BOARD_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD}<br /><span class="gensmall">{L_DISABLE_BOARD_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD_MSG}<br /><span class="gensmall">{L_DISABLE_BOARD_MSG_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="board_disable_msg" value="{BOARD_DISABLE_MSG}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD_DOWNTIME}<br /><span class="gensmall">{L_DISABLE_BOARD_DOWNTIME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="board_disable_downtime" value="{BOARD_DISABLE_DOWNTIME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD_NOTES}<br /><span class="gensmall">{L_DISABLE_BOARD_NOTES_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="board_disable_notes" value="{BOARD_DISABLE_NOTES}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD_ADMIN_MOD}<br /><span class="gensmall">{L_DISABLE_BOARD_ADMIN_MOD_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="board_disable_admin_mod" value="{DISABLE_BOARD_ADMIN_MOD_NONE}" {DISABLE_BOARD_ADMIN_MOD_NONE_CHECKED} />{L_NONE}&nbsp; &nbsp;<input type="radio" name="board_disable_admin_mod" value="{DISABLE_BOARD_ADMIN_MOD_MOD}" {DISABLE_BOARD_ADMIN_MOD_MOD_CHECKED} />{L_MOD}&nbsp; &nbsp;<input type="radio" name="board_disable_admin_mod" value="{DISABLE_BOARD_ADMIN_MOD_ADMIN}" {DISABLE_BOARD_ADMIN_MOD_ADMIN_CHECKED} />{L_D_ADMIN}</td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_HIDE_POST}</th>
	</tr>
	<tr>
		<td class="row1">{L_CASHSYSTEMTYPE}<br /><span class="gensmall">{L_CASH_TYPE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="cash_system_type" value="1" {CASHTYPE_POINTS} /> POINTS&nbsp;&nbsp;<input type="radio" name="cash_system_type" value="2" {CASHTYPE_CASHMOD2} /> CASH MOD 2&nbsp;&nbsp;<input type="radio" name="cash_system_type" value="0" {CASHTYPE_OTHERS} /> {L_CASH_OTHERS}</td>
	</tr>
	<tr>
		<td class="row1">{L_CASH_FIELDNAME}<br /><span class="gensmall">{L_CASH_FIELD_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="cash_field_name" value="{CASH_FIELD_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_CASH_NAME}<br /><span class="gensmall">{L_CASH_NAME_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="cash_type_name" value="{CASH_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_HIDE4REPLY}</td>
		<td class="row2"><input type="radio" name="allow_hide4reply" value="1" {HIDE4REPLY_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_hide4reply" value="0" {HIDE4REPLY_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SELL_POST}</td>
		<td class="row2"><input type="radio" name="allow_sellpost" value="1" {SELLPOST_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_sellpost" value="0" {SELLPOST_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_SELLINGPRICE}<br /><span class="gensmall">{L_MAX_PRICE_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="max_sellingprice" value="{MAX_SELLINGPRICE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_MIN_SELLINGPRICE}<br /><span class="gensmall">{L_MIN_PRICE_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="min_sellingprice" value="{MIN_SELLINGPRICE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_HIDE4POSTS}</td>
		<td class="row2"><input type="radio" name="allow_hide4posts" value="1" {HIDE4POSTS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_hide4posts" value="0" {HIDE4POSTS_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_POSTS_REQUIRED}<br /><span class="gensmall">{L_MAX_POSTS_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="max_postsrequired" value="{MAX_POSTSREQUIRED}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_MIN_POSTS_REQUIRED}<br /><span class="gensmall">{L_MIN_POSTS_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="min_postsrequired" value="{MIN_POSTSREQUIRED}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_HIDE4FORTUNE}</td>
		<td class="row2"><input type="radio" name="allow_hide4fortune" value="1" {HIDE4FORTUNE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_hide4fortune" value="0" {HIDE4FORTUNE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_FORTUNE_REQUIRED}<br /><span class="gensmall">{L_MAX_POSTS_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="max_fortunerequired" value="{MAX_FORTUNEREQUIRED}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_MIN_FORTUNE_REQUIRED}<br /><span class="gensmall">{L_MIN_POSTS_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="min_fortunerequired" value="{MIN_FORTUNEREQUIRED}" /></td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_COOKIE_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_COOKIE_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_DOMAIN}</td>
		<td class="row2"><input class="post" type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_NAME}</td>
		<td class="row2"><input class="post" type="text" maxlength="16" name="cookie_name" value="{COOKIE_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_PATH}</td>
		<td class="row2"><input class="post" type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_SECURE}<br /><span class="gensmall">{L_COOKIE_SECURE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />{L_DISABLED}&nbsp; &nbsp;<input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />{L_ENABLED}</td>
	</tr>
	<tr>
		<td class="row1">{L_SESSION_LENGTH}</td>
		<td class="row2"><input class="post" type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" /></td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_PRIVATE_MESSAGING}</th>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_PRIVATE_MESSAGING}</td>
		<td class="row2"><input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />{L_ENABLED}&nbsp; &nbsp;<input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />{L_DISABLED}</td>
	</tr>
	<tr>
		<td class="row1">{L_INBOX_LIMIT}</td>
		<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SENTBOX_LIMIT}</td>
		<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SAVEBOX_LIMIT}</td>
		<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" /></td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_ABILITIES_SETTINGS}</th>
	</tr>
		<tr> 
      	<td class="row1">{L_WHO_IS_ONLINE_TIME}</td> 
      	<td class="row2"><input class="post" type="text" name="who_is_online_time" size="5" maxlength="5" value="{WHO_IS_ONLINE_TIME}" /></td> 
   	</tr>
	<tr>
		<td class="row1">{L_MAX_POLL_OPTIONS}</td>
		<td class="row2"><input class="post" type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_HTML}</td>
		<td class="row2"><input type="radio" name="allow_html" value="1" {HTML_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_html" value="0" {HTML_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOWED_TAGS}<br /><span class="gensmall">{L_ALLOWED_TAGS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_BBCODE}</td>
		<td class="row2"><input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SMILIES}</td>
		<td class="row2"><input type="radio" name="allow_smilies" value="1" {SMILE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_smilies" value="0" {SMILE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SMILIES_PATH} <br /><span class="gensmall">{L_SMILIES_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="smilies_path" value="{SMILIES_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SIG}</td>
		<td class="row2"><input type="radio" name="allow_sig" value="1" {SIG_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_sig" value="0" {SIG_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_SIG_LENGTH}<br /><span class="gensmall">{L_MAX_SIG_LENGTH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="5" maxlength="4" name="max_sig_chars" value="{SIG_SIZE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_NAME_CHANGE}</td>
		<td class="row2"><input type="radio" name="allow_namechange" value="1" {NAMECHANGE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_namechange" value="0" {NAMECHANGE_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_SQR_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_QUICK_REPLY}</td>
		<td class="row2"><input type="radio" name="allow_quickreply" value="1" {QUICKREPLY_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_quickreply" value="0" {QUICKREPLY_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <td class="row1">{L_ANONYMOUS_SHOW_SQR}</td>
	  <td class="row2">{ANONYMOUS_SQR_SELECT}</td>
	</tr>
	<tr>
	  <td class="row1">{L_ANONYMOUS_SQR_MODE}</td>
	  <td class="row2"><input type="radio" name="anonymous_sqr_mode" value="0" {ANONYMOUS_SQR_MODE_BASIC} />{L_ANONYMOUS_SQR_MODE_BASIC}&nbsp;&nbsp;<input type="radio" name="anonymous_sqr_mode" value="1" {ANONYMOUS_SQR_MODE_ADVANCED} />{L_ANONYMOUS_SQR_MODE_ADVANCED}</td>
	</tr>
	<tr>
	  <td class="row1">{L_ANONYMOUS_OPEN_SQR}</td>
	  <td class="row2"><input type="radio" name="anonymous_open_sqr" value="1" {ANONYMOUS_OPEN_SQR_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="anonymous_open_sqr" value="0" {ANONYMOUS_OPEN_SQR_NO} />{L_NO}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_AVATAR_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_LOCAL}</td>
		<td class="row2"><input type="radio" name="allow_avatar_local" value="1" {AVATARS_LOCAL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_local" value="0" {AVATARS_LOCAL_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_REMOTE} <br /><span class="gensmall">{L_ALLOW_REMOTE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="allow_avatar_remote" value="1" {AVATARS_REMOTE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_remote" value="0" {AVATARS_REMOTE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_UPLOAD}</td>
		<td class="row2"><input type="radio" name="allow_avatar_upload" value="1" {AVATARS_UPLOAD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_upload" value="0" {AVATARS_UPLOAD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_FILESIZE}<br /><span class="gensmall">{L_MAX_FILESIZE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="4" maxlength="10" name="avatar_filesize" value="{AVATAR_FILESIZE}" /> Bytes</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_AVATAR_SIZE} <br />
			<span class="gensmall">{L_MAX_AVATAR_SIZE_EXPLAIN}</span>
		</td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="avatar_max_height" value="{AVATAR_MAX_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="avatar_max_width" value="{AVATAR_MAX_WIDTH}"></td>
	</tr>
	<tr>
		<td class="row1">{L_AVATAR_STORAGE_PATH} <br /><span class="gensmall">{L_AVATAR_STORAGE_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="avatar_path" value="{AVATAR_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_AVATAR_GALLERY_PATH} <br /><span class="gensmall">{L_AVATAR_GALLERY_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="avatar_gallery_path" value="{AVATAR_GALLERY_PATH}" /></td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_COPPA_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_COPPA_FAX}</td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="coppa_fax" value="{COPPA_FAX}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COPPA_MAIL}<br /><span class="gensmall">{L_COPPA_MAIL_EXPLAIN}</span></td>
		<td class="row2"><textarea name="coppa_mail" rows="5" cols="30">{COPPA_MAIL}</textarea></td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_EMAIL_SETTINGS}</th>
	</tr>
	<!-- Added by Email Disable MOD -->
 	<tr>
 	  <td class="row1">{L_EMAIL_ENABLED}<br /><span class="gensmall">{L_EMAIL_ENABLED_EXPLAIN}</span></td>
 	  <td class="row2"><input type="radio" name="email_enabled" value="1" {EMAIL_ENABLED_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="email_enabled" value="0" {EMAIL_ENABLED_NO} /> {L_NO}</td>
 	</tr>
 	<!-- Finish Email Disable MOD -->
	<tr>
		<td class="row1">{L_ADMIN_EMAIL}</td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_EMAIL_SIG}<br /><span class="gensmall">{L_EMAIL_SIG_EXPLAIN}</span></td>
		<td class="row2"><textarea name="board_email_sig" rows="5" cols="30">{EMAIL_SIG}</textarea></td>
	</tr>
	<tr>
		<td class="row1">{L_USE_SMTP}<br /><span class="gensmall">{L_USE_SMTP_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="smtp_delivery" value="1" {SMTP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="smtp_delivery" value="0" {SMTP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_SERVER}</td>
		<td class="row2"><input class="post" type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_USERNAME}<br /><span class="gensmall">{L_SMTP_USERNAME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_PASSWORD}<br /><span class="gensmall">{L_SMTP_PASSWORD_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br clear="all" />
