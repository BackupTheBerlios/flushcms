<?php

/**
 * question actions.
 *
 * @package    solution
 * @subpackage question
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.2 2006/08/09 16:03:56 arzen Exp $
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

}
