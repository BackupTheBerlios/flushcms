<?php

/**
 * solution actions.
 *
 * @package    solution
 * @subpackage solution
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.1 2006/08/13 14:41:36 arzen Exp $
 */
class solutionActions extends autosolutionActions
{
  public function executeCreate ()
  {
    $id = $this->getRequestParameter('qid');
    parent::executeCreate ();
  }

}
