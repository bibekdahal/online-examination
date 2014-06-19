<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->NewQuestionSet($_POST['imagefolder']);
echo 'Added Successfully';
?>