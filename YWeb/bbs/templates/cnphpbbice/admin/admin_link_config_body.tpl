<h1>{L_LINK_CONFIG}</h1>

<p>{L_LINK_CONFIG_EXPLAIN}</p>

<form action="{S_LINK_CONFIG_ACTION}" method="post">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_LINK_CONFIG}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_LOCK_SUBMIT_SITE}</span></td>
	  <td class="row2"><input type="radio" name="lock_submit_site" value="1" {LOCK_SUBMIT_SITE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="lock_submit_site" value="0" {LOCK_SUBMIT_SITE_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_SITE_LOGO}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="100" size="60" name="site_logo" value="{SITE_LOGO}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_SITE_URL}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="100" size="60" name="site_url" value="{SITE_URL}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_WIDTH}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="5" size="5" name="width" value="{WIDTH}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HEIGHT}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="2" size="5" name="height" value="{HEIGHT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_LINKSPP}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="9" size="5" name="linkspp" value="{LINKSPP}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DISPLAY_INTERVAL}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="9" size="5" name="display_interval" value="{INTERVAL}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DISPLAY_LOGO_NUM}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="9" size="5" name="display_logo_num" value="{LOGO_NUM}" /></td>
	</tr>
	<!-- tr>
	  <td class="row1"><span class="genmed">{L_ALLOW_GUEST_SUBMIT_SITE}</span></td>
	  <td class="row2"><input type="radio" name="allow_guest_submit_site" value="1" {ALLOW_GUEST_SUBMIT_SITE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_guest_submit_site" value="0" {ALLOW_GUEST_SUBMIT_SITE_NO} /> {L_NO}</td>
	</tr -->
	<tr>
	  <td class="row1"><span class="genmed">{L_ALLOW_NO_LOGO}</span></td>
	  <td class="row2"><input type="radio" name="allow_no_logo" value="1" {ALLOW_NO_LOGO_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_no_logo" value="0" {ALLOW_NO_LOGO_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DISPLAY_LINKS_LOGO}</span></td>
	  <td class="row2"><input type="radio" name="display_links_logo" value="1" {DISLAY_LINKS_LOGO_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="display_links_logo" value="0" {DISLAY_LINKS_LOGO_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_LINK_EMAIL_NOTIFY}</span></td>
	  <td class="row2"><input type="radio" name="email_notify" value="1" {EMAIL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="email_notify" value="0" {EMAIL_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_LINK_PM_NOTIFY}</span></td>
	  <td class="row2"><input type="radio" name="pm_notify" value="1" {PM_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="pm_notify" value="0" {PM_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>
</table></form>
<div align="center"><span class="copyright">Links MOD v1.2.2 by <a href="http://www.phpbb2.de" target="_blank">phpBB2.de</a> and OOHOO and CRLin</span></div>
<br clear="all" />
