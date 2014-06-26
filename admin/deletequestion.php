<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->DeleteQuestion(intval($_POST['setid']), intval($_POST['qsn']));
?>