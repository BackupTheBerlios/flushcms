<?php

/**
 * role actions.
 *
 * @package    solution
 * @subpackage role
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.2 2006/08/09 05:19:34 arzen Exp $
 */
class roleActions extends autoroleActions
{

  protected function updateRoleFromRequest()
  {
    $active = $this->getRequestParameter('active');
    if ($active) 
    {
		$this->role->setActive($active);
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$this->role->setAddIp($ip); 
    parent::updateRoleFromRequest();
  }
  
}
