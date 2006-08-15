<?php

/**
 * solution actions.
 *
 * @package    solution
 * @subpackage solution
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.3 2006/08/15 01:22:51 arzen Exp $
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
  public function executeEdit ()
  {
    $this->solution = $this->getSolutionOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->solution = $this->getSolutionOrCreate();

      $this->updateSolutionFromRequest();

      $this->saveSolution($this->solution);

      $this->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('solution/create');
      }
      else
      {
        return $this->redirect('solution/edit?qid='.$this->solution->getQuestionId().'&id='.$this->solution->getId());
      }
    }
    else
    {
      // add javascripts
      $this->getResponse()->addJavascript('/sf/js/prototype/prototype');
      $this->getResponse()->addJavascript('/sf/js/sf_admin/collapse');
    }
  }
  
}
