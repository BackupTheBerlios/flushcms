<?php
/**
 * Copyright Yahoo! Hong Kong Limited. (c) 2006. All rights reserved.
 *
 * gallery_event.php
 *  
 * Created on 2006-9-1
 * Modify List as below:
 * Date        Author    Version  Changes
 * 2006-09-01  Harry Lu  1.0      Initial    
 * 
 */
  
include_once("Init.php");

include_once($ModuleDir."GalleryEvent/GalleryEvent.class.php");
$GalleryEventObj = new GalleryEvent();
$act = $_REQUEST['act'];
$artistid = $_REQUEST["artistid"];
$GalleryEventObj->setArtistid($artistid);

switch ($act) {
	case 'Add':
		$GalleryEventObj->displayAddForm();
		break;

	case 'AddSubmit':
		$GalleryEventObj->addSubmit();
		break;
		
	case 'Del':
		$GalleryEventObj->delOne();
		break;

	case 'Update':
		$GalleryEventObj->displayUpdateForm();
		break;
		
	case 'UpdateSubmit':
		$GalleryEventObj->updateSubmit();
		break;

	default:
		$GalleryEventObj->displayList();    
		break;
}

?>
