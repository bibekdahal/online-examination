<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->AddQuestion(intval($_REQUEST['setid']), intval($_REQUEST['qsn']), $_REQUEST['question'], 
						$_REQUEST['optiona'], $_REQUEST['optionb'], $_REQUEST['optionc'], $_REQUEST['optiond']);
echo 'Added Successfully';
?>