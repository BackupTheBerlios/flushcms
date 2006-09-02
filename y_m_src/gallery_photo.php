<?php
/**
 *
 * GalleryPhoto.php class.
 *
 * @package    core
 * @author     Harry Lu 
 * @version    CVS: $Id: gallery_photo.php,v 1.1 2006/09/02 10:33:30 arzen Exp $
 */
include_once("Init.php");

include_once($ModuleDir."GalleryPhoto/GalleryPhoto.class.php");

$GalleryPhotoObj = new GalleryPhoto();
$act = $_REQUEST['act'];
$artistid = $_REQUEST["artistid"];
$GalleryPhotoObj->setArtistid($artistid);

switch ($act) {
	case 'Add':
		$GalleryPhotoObj->displayAddForm();
		break;

	case 'AddSubmit':
		$GalleryPhotoObj->addSubmit();
		break;
		
	case 'Del':
		$GalleryPhotoObj->delOne();
		break;

	case 'Update':
		$GalleryPhotoObj->displayUpdateForm();
		break;
		
	case 'UpdateSubmit':
		$GalleryPhotoObj->updateSubmit();
		break;

	case 'BatchNew':
		$GalleryPhotoObj->batchUpdateStatus('new');
		break;

	case 'BatchLive':
		$GalleryPhotoObj->batchUpdateStatus('live');
		break;
		
	case 'BatchDelete':
		$GalleryPhotoObj->batchUpdateStatus('deleted');
		break;		

	default:
		$GalleryPhotoObj->displayList();    
		break;
}

?>
