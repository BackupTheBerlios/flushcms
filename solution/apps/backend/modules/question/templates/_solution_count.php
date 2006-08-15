<?php
$qid = $question->getId();
$c = new Criteria();
$c->add(SolutionPeer::QUESTION_ID, $qid);
echo $data = SolutionPeer::doCount($c);

?>
