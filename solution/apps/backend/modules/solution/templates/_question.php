<?php
$qid = $sf_request->getParameter('qid');
$c = new Criteria();
$c->add(QuestionPeer::ID, $qid);
$data = QuestionPeer::doSelect($c);
if ($data[0]) 
{
	echo $data[0]->getQuestion();
	echo input_hidden_tag('question_id',$qid);
	echo input_hidden_tag('qid',$qid);
}
?>
