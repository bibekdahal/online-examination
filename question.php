<?php

require_once('classes/Questions.php');
$questions = new Questions;

if (isset($_REQUEST['optid'])){
	$optid = intval($_REQUEST['optid']);
	if ($optid==0)
		$questions->EchoOpta(intval($_REQUEST['setid']), intval($_REQUEST['qsn']));
	elseif ($optid==1)
		$questions->EchoOptb(intval($_REQUEST['setid']), intval($_REQUEST['qsn']));
	elseif ($optid==2)
		$questions->EchoOptc(intval($_REQUEST['setid']), intval($_REQUEST['qsn']));
	elseif ($optid==3)
		$questions->EchoOptd(intval($_REQUEST['setid']), intval($_REQUEST['qsn']));

}
else{
	$questions->EchoQuestion(intval($_REQUEST['setid']), intval($_REQUEST['qsn']));
	
}

?>