<?php
/***************************************************************************  
 *                               extension.inc
 *                            -------------------                         
 *   begin                : Saturday, Feb 13, 2001 
 *   copyright            : (C) 2001 The phpBB Group        
 *   email                : support@phpbb.com                           
 *                                                          
 *   $Id: extension.inc,v 1.1 2006/11/20 08:46:28 arzen Exp $
 *                                                            
 * 
 ***************************************************************************/ 

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

//
// Change this if your extension is not .php!
//
$phpEx = "php";

$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;

?>