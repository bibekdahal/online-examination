<?php

require_once('../classes/Questions.php');
$questions = new Questions;

echo $questions->GetCorrectAnswer(intval($_POST['setid']), intval($_POST['qsn']));
?>