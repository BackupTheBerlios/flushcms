<?php
/**
 *
 * backend.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: backend.php,v 1.6 2006/12/01 11:14:45 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       true);
define('APF_LOGIN_ACCESS',       "Y");
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
if( $controller->getModuleName() == 'left' )
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
		"TEMPLATEDIR" => $WebTemplateFullPath, 
		"WEBBASEDIR" => $WebBaseDir, "SITETITLE" => $i18n->_('site_title'), "CHARSET" => $i18n->getCharset(),));
	$template->parse("OUT", array (
		"body",
	));
	$template->p("OUT");
	exit;
}
elseif( $controller->getModuleName() == 'right' )
{

}
else
{
	//
	// Generate frameset
	//
	$template->setFile(array(
		"body" => "index_frameset.html")
	);

	$template->setVar(array(
		"S_FRAME_NAV" => "backend.php/left",
		"S_FRAME_MAIN" => "backend.php/right")
	);


	$template->parse("OUT", array (
		"body",
	));
	$template->p("OUT");

	exit;

}
$controller->dispatch();
?>
