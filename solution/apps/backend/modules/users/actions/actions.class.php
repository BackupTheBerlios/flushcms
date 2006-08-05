<?php

/**
 * users actions.
 *
 * @package    solution
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.3 2006/08/05 01:50:02 arzen Exp $
 */
class usersActions extends autousersActions
{

  
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
    

	$fileName = $this->getRequest()->getFileName("users[photo]");
	$this->getRequest()->moveFile("users[photo]", sfConfig::get('sf_upload_dir').'/'.$fileName);
 
    parent::updateUsersFromRequest();
  }

  public function handleError()
  {
    $this->forward('users', 'create');
  }

}
