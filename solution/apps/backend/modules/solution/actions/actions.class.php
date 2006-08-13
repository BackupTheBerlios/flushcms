<?php

/**
 * solution actions.
 *
 * @package    solution
 * @subpackage solution
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.2 2006/08/13 23:33:43 arzen Exp $
 */
class solutionActions extends autosolutionActions
{
 
  protected function updateSolutionFromRequest()
  {
    $active = $this->getRequestParameter('active');
    $question_id = $this->getRequestParameter('question_id');
    if ($active) 
    {
		$this->solution->setActive($active);
	}
    if ($question_id) 
    {
		$this->solution->setQuestionId($question_id);
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$this->solution->setAddIp($ip); 
    parent::updateSolutionFromRequest();
  }
  
}
