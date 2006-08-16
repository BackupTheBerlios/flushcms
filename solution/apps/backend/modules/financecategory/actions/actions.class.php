<?php

/**
 * financecategory actions.
 *
 * @package    solution
 * @subpackage financecategory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.2 2006/08/16 05:30:57 arzen Exp $
 */
class financecategoryActions extends autofinancecategoryActions
{

  protected function updateFinanceCategoryFromRequest()
  {
    $active = $this->getRequestParameter('active');
    if ($active) 
    {
		$this->finance_category->setActive($active);
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$this->finance_category->setAddIp($ip); 
    parent::updateFinanceCategoryFromRequest();
  }

}
