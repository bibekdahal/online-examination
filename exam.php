<?php
require_once 'Pages.php';
require_once('classes/Questions.php');
$loginPage->StartHead('Online Exam');
?>

<?php
$loginPage->Endhead();
$loginPage->StartBody();

/*$user -> StartSession();
if (!$user->loggedin()){
	echo '
	<div class="container">
		<h1>You are not logged in.</h1>
	</div>
	';
	exit(0);
}*/

$questions = new Questions;

$setid = 1;
$userid = 1;//$_SESSION['user_id'];

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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>
            <li class="active"><a href="./">Fixed top</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
<div class="container">
	<br/><br/>
	<form method="post" role="form">
<?php
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