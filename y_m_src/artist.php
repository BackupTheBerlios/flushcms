<?php
/**
 *
 * artist.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: artist.php,v 1.1 2006/08/30 10:58:36 arzen Exp $
 */
include_once("Init.php");

include_once($ModuleDir."Artist/Artist.class.php");
$ArtistObj = new Artist();
$act = $_REQUEST['act'];

switch ($act) {
	case 'Add':
		$ArtistObj->displayAddForm();
		break;

	case 'AddSubmit':
		$ArtistObj->addSubmit();
		break;
		
	case 'Del':
		$ArtistObj->delOne();
		break;

	case 'Update':
		$ArtistObj->displayUpdateForm();
		break;
		
	case 'UpdateSubmit':
		$ArtistObj->updateSubmit();
		break;

	default:
		$ArtistObj->displayList();    
		break;
}

?>
