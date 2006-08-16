<?php

/**
 * finance actions.
 *
 * @package    solution
 * @subpackage finance
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.2 2006/08/16 05:30:57 arzen Exp $
 */
class financeActions extends autofinanceActions
{
	protected function updateFinanceFromRequest()
	{
		$active = $this->getRequestParameter('active');
		$debit = $this->getRequestParameter('debit');
		$category = $this->getRequestParameter('category');
		if ($active)
		{
			$this->finance->setActive($active);
		}
		if ($debit)
		{
			$this->finance->setDebit($debit);
		}
		if ($category)
		{
			$this->finance->setCategory($category);
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		$this->finance->setAddIp($ip);
		parent :: updateFinanceFromRequest();
	}

}
