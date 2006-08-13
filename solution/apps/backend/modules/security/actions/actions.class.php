<?php

/**
 * security actions.
 *
 * @package    solution
 * @subpackage security
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.1 2006/08/13 06:53:05 arzen Exp $
 */
class securityActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  }
  
	public function executeLogin()
	{
	  $c = new Criteria();
	  $c->add(UsersPeer::USER_NAME, $this->getRequestParameter('login'));
	  $c->add(UsersPeer::USER_PWD, $this->getRequestParameter('password'));
	  $user_record = UsersPeer::doSelectOne($c);

	  if ($user_record)
	  {
		$this->getUser()->setAuthenticated(true);
		
		$c = new Criteria();
		$c->add(RolePeer::ID, $user_record->getRoleId());
		$user_role = RolePeer::doSelectOne($c);
		$this->getUser()->addCredential($user_role->getRoleName());
		return $this->redirect('users');
	  }
	  else
	  {
		$this->getRequest()->setError('login', 'incorrect entry');
		return $this->forward('security', 'index');
	  }

	}
	
	public function executeLogout()
	{
		$this->getUser()->setAuthenticated(false);
		return $this->forward('security', 'index');
	}
  
}
