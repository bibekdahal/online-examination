<?php
require_once 'Pages.php';
require_once('classes/Questions.php');
$loginPage->StartHead('Online Examination');

?>

<?php
$loginPage->Endhead();
$loginPage->StartBody();


$questions = new Questions;
//---------------------------- Start of Body --------------------------------
?>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-brand">Online Examination</div>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="instructions.php">Instruction</a></li>            
            <li class="active"><a href="exam.php"><strong>Exam Page</strong></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="timer" href="#"></a></li>
            <li ><a href="./">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    
<div class="container">
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
		echo 'Current Status: Not logged in, please <a href="login.php">log in</a> first';
		return;
	}
	$endtime = $user->GetStartTime() + 10800;
	
	$num = $questions->GetNumQuestions(1);		
	$setid = 1;
	$userid = $_SESSION['user_id'];
	
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
		return;
	}

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
				  <div class="panel-body" '. (($option>-1)?'style="background-color: #edf3f1;"':'') .'>';
		
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

var TimeLimit = new Date('<?php echo date('r', $endtime) ?>');
function countdownto() {
	  var date = Math.round((TimeLimit-new Date())/1000);
	  var hours = Math.floor(date/3600);
	  date = date - (hours*3600);
	  var mins = Math.floor(date/60);
	  date = date - (mins*60);
	  var secs = date;
	  if (hours<10) hours = '0'+hours;
	  if (mins<10) mins = '0'+mins;
	  if (secs<10) secs = '0'+secs;
	  $("#timer").html(hours+':'+mins+':'+secs);
	  setTimeout("countdownto()",1000);
 }


$(document).ready(function() {
	countdownto();
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