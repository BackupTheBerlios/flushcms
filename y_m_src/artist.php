<?php
/**
 *
 * artist.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: artist.php,v 1.2 2006/09/01 10:48:12 arzen Exp $
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

	case 'UpdateSelected':
		$ArtistObj->updateSelected();
		break;

	default:
		$ArtistObj->displayList();    
		break;
}

?>
