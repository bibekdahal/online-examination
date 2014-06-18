<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->NewQuestionSet($_REQUEST['imagefolder']);
echo 'Added Successfully';
?>