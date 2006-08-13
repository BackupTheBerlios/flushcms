<?php

/**
 * question actions.
 *
 * @package    solution
 * @subpackage question
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.3 2006/08/13 14:41:36 arzen Exp $
 */
class questionActions extends autoquestionActions
{
  
  protected function updateQuestionFromRequest()
  {
    $active = $this->getRequestParameter('active');
    $category = $this->getRequestParameter('category');
    if ($active) 
    {
		$this->question->setActive($active);
	}
    if ($category) 
    {
		$this->question->setCategory($category);
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$this->question->setAddIp($ip); 
    parent::updateQuestionFromRequest();
  }
  
  public function executeAddSolution ()
  {
    $id = $this->getRequestParameter('id');
    $this->forward404Unless($id);
    return $this->redirect("solution/create?qid={$id}");//?qid={$id}
  }

}
