<?php

/**
 * questioncategory actions.
 *
 * @package    solution
 * @subpackage questioncategory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.3 2006/08/13 14:41:36 arzen Exp $
 */
class questioncategoryActions extends autoquestioncategoryActions
{
  
  protected function updateQuestionCategoryFromRequest()
  {
    $active = $this->getRequestParameter('active');
    if ($active) 
    {
		$this->question_category->setActive($active);
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$this->question_category->setAddIp($ip); 
    parent::updateQuestionCategoryFromRequest();
  }
  
}
