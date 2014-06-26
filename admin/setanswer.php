<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->SetAnswer(intval($_POST['setid']), intval($_POST['qsn']), intval($_POST['option']));
?>