<?php
require_once 'Pages.php';
require_once('classes/Questions.php');
$questions = new Questions;

$loginPage->StartHead('Online Exam');
?>

<?php
$loginPage->Endhead();
$loginPage->StartBody();

$setid = 1;
$userid = 1;

$num = $questions->GetNumQuestions($setid);
$submitted = false;
for ($i=0; $i<$num; $i++)
	if (isset($_POST['optionsRadios'.$i])){
		$questions->AddAnswer($userid, $setid, $i+1, intval($_POST['optionsRadios'.$i]));
		$submitted=true;
	}
	
if ($submitted) {
	echo '
	<div class="container">
		<h1>Your answers are submitted.</h1>
	</div>
	';
	exit(0);
}
//---------------------------- Start of Body --------------------------------
?>

<div class="container">
	<h1>Online Exam</h1>
	<br/><br/>
	<form method="post" role="form">
<?php
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
		echo 'Current Status: Not logged in, please log in first';
		return;
	}
	$num = $questions->GetNumQuestions(1);
	for ($i=0; $i<$num; $i++)
	{
		$questions->GetQuestion($setid, $i+1, $q, $o[0], $o[1], $o[2], $o[3]);
		$option = $questions->GetAnswer($userid, $setid, $i+1);
		echo '
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">'.($i+1).'. ' . $q .
					 '</h3>
				  </div>
				  <div class="panel-body" '. (($option>-1)?'style="background-color: #cdc;"':'') .'>';
		
		for ($j=0; $j<4; $j++)
		{
			if ($j==0 || $j==2)
				echo '<div class="row">';
			echo '
			 	<div class="col-md-6">
					<div class="radio">
					  <label>
					    <input type="radio" name="optionsRadios'.$i.'" value="'.$j.'" '. (($option==$j)?'checked':'') .'>
					    '.$o[$j].'
					  </label>
					</div>
				';
			echo '</div>';
			if ($j==1 || $j==3)
				echo '</div>';
		}
		echo '</div></div>';
	}
?>
	<br/> <br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</form>
</div>

<?php
//----------------------------- Body Ends -----------------------------------
$loginPage->EndBody();

?>

<script type="text/javascript">

$(document).ready(function() {
	<?php
	for ($i=0; $i<$num; $i++)
	echo '$(\'input[name="optionsRadios'.$i.'"]\').change( function() {$(this).closest(".panel-body").css( "background-color", "#cdc" ); var j = parseInt($(this).val()); answer('.($i+1).', j);});';
	?>});

function answer(sn, option)
{
	$.post( "answer.php", { userid: <?php echo $userid ?>, setid: <?php echo $setid ?>, qsn: sn, option: option } ,
  function(data,status){
    //alert("Data: " + data + "\nStatus: " + status);
  });
	
}
	
</script>