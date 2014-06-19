<?php
require_once('pages.php');
require_once('classes/Questions.php');
$questions = new Questions;
	
	if($user->loggedin()){
		try{
			if($user->ExamStarted()){
			}
		}catch(Exception $e){
			if($e->GetMessage() == 'NotStarted'){
				echo 'Your exam is not started yet, please wait...';
			}
			else if($e->GetMessage() == 'Expired'){
				echo 'Your exam time is finished.';
			}
			echo '<br/>'.$e->getmessage();
			return;
		}
	}else{
		echo 'Current Status: Not logged in, please <a href="login.php">log in</a> first';
		return;
	}

$questions->AddAnswer($_POST['userid'], $_POST['setid'], $_POST['qsn'], $_POST['option']);

?>