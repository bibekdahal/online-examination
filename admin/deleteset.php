<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$setid = intval($_POST['setid']) ;
if ($setid>=0)
	$questions->DeleteQuestionSet($setid);
else
	$questions->DeleteAllSets();
?>