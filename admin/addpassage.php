<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->AddPassage(intval($_POST['setid']), intval($_POST['qsn']), $_POST['passage']);
?>