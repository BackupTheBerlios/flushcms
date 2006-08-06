<?php

/**
 * users actions.
 *
 * @package    solution
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.5 2006/08/06 07:37:12 arzen Exp $
 */
class usersActions extends autousersActions
{

	public function executeShow ()
	{
		$this->users = UsersPeer::retrieveByPk($this->getRequestParameter('id'));
	 
    	$this->forward404Unless($this->users);
	}
  
  protected function updateUsersFromRequest()
  {
    $user_password = $this->getRequestParameter('password1');
    $user_password2 = $this->getRequestParameter('password2');
    $user_gender = $this->getRequestParameter('gender');
    if ($user_password && ($user_password==$user_password2))
    {
      $this->users->setUserPwd($user_password);
    }
    if (isset($user_gender))
    {
      $this->users->setGender($user_gender);
    }
    if (!$this->getRequest()->getError("users{photo}") && $fileName = $this->getRequest()->getFileName("users[photo]"))
    {
		$this->getRequest()->moveFile("users[photo]", sfConfig::get('sf_upload_dir_name').'/'.$fileName);
		$this->users->setPhoto($fileName);
    }
	$ip = $_SERVER['REMOTE_ADDR'];
	$this->users->setAddIp($ip); 
    parent::updateUsersFromRequest();
  }

  public function handleError()
  {
    $this->forward('users', 'create');
  }

}
