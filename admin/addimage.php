<?php

require_once('../classes/Questions.php');
$questions = new Questions;

$questions->AddUploadedImage(intval($_POST['setid']));
?>