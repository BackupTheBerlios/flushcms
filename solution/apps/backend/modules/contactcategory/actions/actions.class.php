<?php

/**
 * contactcategory actions.
 *
 * @package    solution
 * @subpackage contactcategory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.2 2006/08/28 23:27:32 arzen Exp $
 */
class contactcategoryActions extends autocontactcategoryActions
{
  protected function updateContactCategoryFromRequest()
  {
    $active = $this->getRequestParameter('active');
    if ($active) 
    {
		$this->contact_category->setActive($active);
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$this->contact_category->setAddIp($ip); 
    parent::updateContactCategoryFromRequest();
  }

}
