<?php
/***************************************************************************
 *                              page_tail.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: page_tail.php,v 1.1 2006/11/20 08:46:27 arzen Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}
global $do_gzip_compress;
//
// Show the overall footer.
//
$admin_link = ( $userdata['user_level'] == ADMIN ) ? '<a href="admin/index.' . $phpEx . '?sid=' . $userdata['session_id'] . '">' . $lang['Admin_panel'] . '</a><br /><br />' : '';

$template->set_filenames(array(
	'overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl')
);

$gzip_text = ($board_config['gzip_compress']) ? "GZIP compression enabled" : "GZIP compression disabled"; 
$excuted_queries = $db->num_queries;
$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$endtime = $mtime; 
$gentime = round(($endtime - $starttime), 6);	// You can adjust the number 6

if ($userdata['user_level'] == ADMIN)
{
	$template->assign_vars(array(
		'GENERATION_TIME' => $gentime,
		'NUMBER_QUERIES' => $excuted_queries,
		'GZIP_TEXT' =>  $gzip_text,
		)
	);

	$template->assign_block_vars('generation_time_switch', array() );
}

$template->assign_vars(array(
	//'PHPBB_VERSION' => '2' . $board_config['version'],
	'TRANSLATION_INFO' => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''), 
	'ADMIN_LINK' => $admin_link)
);

$template->pparse('overall_footer');

//
// Close our DB connection.
//
$db->sql_close();

//
// Compress buffered output if required and send to browser
//
if ( $do_gzip_compress )
{
	//
	// Borrowed from php.net!
	//
	$gzip_contents = ob_get_contents();
	ob_end_clean();

	$gzip_size = strlen($gzip_contents);
	$gzip_crc = crc32($gzip_contents);

	$gzip_contents = gzcompress($gzip_contents, 9);
	$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
	echo pack('V', $gzip_crc);
	echo pack('V', $gzip_size);
}

exit;

?>