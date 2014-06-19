<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->AddQuestion(intval($_POST['setid']), intval($_POST['qsn']), $_POST['question'], 
						$_POST['optiona'], $_POST['optionb'], $_POST['optionc'], $_POST['optiond']);
?>