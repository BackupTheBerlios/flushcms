<?php
/**
 *
 * profile_items.php
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: profile_items.php,v 1.1 2006/09/02 10:33:30 arzen Exp $
 */
include_once("Init.php");

include_once($ModuleDir."Artist/ProfileItems.class.php");
$ProfileItemsObj = new ProfileItems();
$act = $_REQUEST['act'];

switch ($act) {
	case 'Add':
		$ProfileItemsObj->displayAddForm();
		break;

	case 'AddSubmit':
		$ProfileItemsObj->addSubmit();
		break;
		
	case 'Del':
		$ProfileItemsObj->delOne();
		break;

	case 'Update':
		$ProfileItemsObj->displayUpdateForm();
		break;
		
	case 'UpdateSubmit':
		$ProfileItemsObj->updateSubmit();
		break;

	case 'MoveDown':
		$ProfileItemsObj->executeDown();
		break;

	case 'MoveUp':
		$ProfileItemsObj->executeUp();
		break;

	default:
		$ProfileItemsObj->displayList();    
		break;
}

?>        