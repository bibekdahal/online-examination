<?php

require_once('classes/Questions.php');
$questions = new Questions;

$questions->AddAnswer($_POST['userid'], $_POST['setid'], $_POST['qsn'], $_POST['option']);

?>