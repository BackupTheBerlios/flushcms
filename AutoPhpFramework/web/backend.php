<?php
/**
 *
 * backend.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: backend.php,v 1.12 2006/12/18 23:41:23 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       false);
define('APF_LOGIN_ACCESS',       "Y");
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
if( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'top' )
{
	$template->setFile(array(
		"body" => "top.html")
	);
	$template->setBlock("body", "bodyleft");
	$lang_arr = $template->getUndefined("body");
	if (is_array($lang_arr)) 
	{
		foreach($lang_arr as $key=>$value)
		{
			if (eregi("lang_",$key)) 
			{
				$lang_key = ltrim($key,"lang_");
				$template->setVar($key,$i18n->_($lang_key));
			}
		}
	}
	$template->setVar(array (
		"JSTOOLKIT_DIR" => $WebJSToolkitPath, 
		"TEMPLATEDIR" => $WebTemplateFullPath, 
		"WEBBASEDIR" => $WebBaseDir, "SITETITLE" => $i18n->_('site_title'), "CHARSET" => $i18n->getCharset(),));
	$template->parse("OUT", array (
		"body",
	));
	$template->p("OUT");
	exit;
}
else if( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'left' )
{
	$template->setFile(array(
		"body" => "left.html")
	);
	$template->setBlock("body", "bodyleft");
	$lang_arr = $template->getUndefined("body");
	foreach($lang_arr as $key=>$value)
	{
		if (eregi("lang_",$key)) 
		{
			$lang_key = ltrim($key,"lang_");
			$template->setVar($key,$i18n->_($lang_key));
		}
	}
	$template->setVar(array (
		"USERID" => $userid, 
		"TEMPLATEDIR" => $WebTemplateFullPath, 
		"WEBBASEDIR" => $WebBaseDir, "SITETITLE" => $i18n->_('site_title'), "CHARSET" => $i18n->getCharset(),));
	$template->parse("OUT", array (
		"body",
	));
	$template->p("OUT");
	exit;
}
elseif( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'right' )
{

}
else if (!getenv("PATH_INFO"))
{
	//
	// Generate frameset
	//
	$template->setFile(array(
		"body" => "index_frameset.html")
	);

	$template->setVar(array(
		"S_FRAME_TOP" => "backend.php?pane=top",
		"S_FRAME_NAV" => "backend.php?pane=left",
		"S_FRAME_MAIN" => "backend.php?pane=right")
	);

	$template->setVar(array (
		"TEMPLATEDIR" => $WebTemplateFullPath, 
		"WEBBASEDIR" => $WebBaseDir, "SITETITLE" => $i18n->_('site_title'), "CHARSET" => $i18n->getCharset(),));
	$template->parse("OUT", array (
		"body",
	));
	$template->p("OUT");

	exit;

}
$controller->dispatch();
?>
