<?php

require_once('../classes/Questions.php');
$questions = new Questions;

echo $questions->GetNumQuestions(intval($_REQUEST['setid']));

?>