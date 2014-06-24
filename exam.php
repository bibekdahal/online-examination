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
            <li ><a href="instructions.php">Instructions</a></li>            
            <li class="active"><a href="exam.php"><strong>Exam Page</strong></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="timer" href="#"></a></li>
            <li class="active"><a id="logout" href="logout.php">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    
<div class="container">
		<br/><br/>
		
<?php
	if($user->loggedin()){
		try{
			if($user->ExamStarted()){
			}
		}catch(Exception $e){
			if($e->GetMessage() == 'NotStarted'){
				echo '<span style="font-size:20px;">Your exam is not started yet, please wait...</span><br/>';
				echo '<div id="rtimer" style="font-size:120px;"> </div></div>';
				$loginPage->EndBody();
				$endtime = $user->GetStartTime();
				echo
				'
<script type="text/javascript">

var TimeLimit = new Date("'.(date('r', $endtime)).'");
function countdownto() {
	  var date = Math.round((TimeLimit-new Date())/1000);
	  if (date<=0){window.open("exam.php","_self"); return;}
	  var hours = Math.floor(date/3600);
	  date = date - (hours*3600);
	  var mins = Math.floor(date/60);
	  date = date - (mins*60);
	  var secs = date;
	  if (hours<10) hours = \'0\'+hours;
	  if (mins<10) mins = \'0\'+mins;
	  if (secs<10) secs = \'0\'+secs;
	  $("#rtimer").text(hours+\':\'+mins+\':\'+secs);
	  setTimeout("countdownto()",1000);
 }
$(document).ready(function() {
	countdownto();});
</script>
				';
			}
			else if($e->GetMessage() == 'Expired'){
				$setid = $user->GetQuestionSet();
				$num = $questions->GetNumQuestions($setid);
				$userid = $user->GetUserId();
				$submitted = false;
				for ($i=0; $i<$num; $i++)
					if (isset($_POST['optionsRadios'.$i])){
						$questions->AddAnswer($userid, $setid, $i+1, intval($_POST['optionsRadios'.$i]));
						$submitted=true;
			}
					
				echo '<span style="font-size:20px;">Your exam time is finished.';
				if ($submitted) echo ' All answers have been submitted.';
				echo '</span>';
			}
			return;
		}
	}else{
		echo '<span style="font-size:20px;">Current Status: Not logged in, please <a href="login.php">log in</a> first</span>';
		return;
	}
	echo 
	'
		<form method="post" role="form">
	';
	$endtime = $user->GetStartTime() + 10800;
	$setid = $user->GetQuestionSet();
	$num = $questions->GetNumQuestions($setid);	
	$userid = $user->GetUserId();
	
	$submitted = false;
	for ($i=0; $i<$num; $i++)
		if (isset($_POST['optionsRadios'.$i])){
			$questions->AddAnswer($userid, $setid, $i+1, intval($_POST['optionsRadios'.$i]));
			$submitted=true;
		}
		
	if ($submitted) {
		echo '
		<div class="container" style="font-size:20px;">
			Your answers are submitted.
		</div>
		';
		return;
	}

	for ($i=0; $i<$num; $i++)
	{
		$passage = $questions->GetPassage($setid, $i+1);
		if ($passage!=""){
			echo '
			<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">' . $passage .
					 '</h3>
				  </div>
			</div>';
		}
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
    <button id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
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
	  if (date<=0){$("#submit").click();}
	  var hours = Math.floor(date/3600);
	  date = date - (hours*3600);
	  var mins = Math.floor(date/60);
	  date = date - (mins*60);
	  var secs = date;
	  if (hours<10) hours = '0'+hours;
	  if (mins<10) mins = '0'+mins;
	  if (secs<10) secs = '0'+secs;
	  $("#timer").text(hours+':'+mins+':'+secs);
	  setTimeout("countdownto()",1000);
 }


$(document).ready(function() {
	//$("#logout").text("Log Out");
	countdownto();
	<?php
	for ($i=0; $i<$num; $i++)
	echo '$(\'input[name="optionsRadios'.$i.'"]\').change( function() {$(this).closest(".panel-body").css( "background-color", "#edf3f1" ); var j = parseInt($(this).val()); answer('.($i+1).', j);});';
	?>});

function answer(sn, option)
{
	$.post( "answer.php", { userid: <?php echo $userid ?>, setid: <?php echo $setid ?>, qsn: sn, option: option } ,
  function(data,status){
    //alert("Data: " + data + "\nStatus: " + status);
  });
	
}
	
</script>