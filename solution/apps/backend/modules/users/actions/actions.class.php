<?php

/**
 * users actions.
 *
 * @package    solution
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.2 2006/08/04 23:25:37 arzen Exp $
 */
class usersActions extends autousersActions
{

  public function executeEdit()
  {

    // Finish off the edit screen in the usual way
    parent::executeEdit();
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
 
    parent::updateUsersFromRequest();
  }

  public function handleError()
  {
    $this->forward('users', 'create');
  }

}
