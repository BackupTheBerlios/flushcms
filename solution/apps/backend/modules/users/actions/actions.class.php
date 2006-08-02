<?php

/**
 * users actions.
 *
 * @package    solution
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.1 2006/08/02 14:20:06 arzen Exp $
 */
class usersActions extends autousersActions
{

  public function handleError()
  {
    $this->forward('users', 'create');
  }

}
