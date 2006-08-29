<?php
/**
 *
 * index.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: index.php,v 1.1 2006/08/29 10:19:11 arzen Exp $
 */
include_once("Init.php");

include_once($ModuleDir."Artist/Artist.class.php");
$ArtistObj = new Artist();
$ArtistObj->displayList();    
?>
