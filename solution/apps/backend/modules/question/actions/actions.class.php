<?php
/**
 * question actions.
 *
 * @package    solution
 * @subpackage question
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.4 2006/08/15 05:03:21 arzen Exp $
 */
class questionActions extends autoquestionActions
{
	public function executeShow()
	{
		$this->question = QuestionPeer :: retrieveByPk($this->getRequestParameter('id'));

		$c = new Criteria();
		$c->add(SolutionPeer::QUESTION_ID, $this->question->getId());
		$c->addDescendingOrderByColumn(SolutionPeer::CREATED_AT);
		$this->solutions = SolutionPeer :: doSelect($c);

		$this->forward404Unless($this->question);
	}

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
		parent :: updateQuestionFromRequest();
	}

	public function executeAddSolution()
	{
		$id = $this->getRequestParameter('id');
		$this->forward404Unless($id);
		return $this->redirect("solution/create?qid={$id}"); //?qid={$id}
	}

}