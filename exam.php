<?php
require_once 'Pages.php';
require_once('classes/Questions.php');
$questions = new Questions;

$loginPage->StartHead("Online Exam");
$loginPage->Endhead();
$loginPage->StartBody();

//---------------------------- Start of Body --------------------------------
?>

<div class="container">
	<h1>Online Exam</h1>
	<br/><br/>
	<form role="form">
<?php
	$num = $questions->GetNumQuestions(1);
	for ($i=0; $i<$num; $i++)
	{
		$questions->GetQuestion(1, $i+1, $q, $o[0], $o[1], $o[2], $o[3]);
		echo '
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">'.($i+1).'. ' . $q .
					 '</h3>
				  </div>
				  <div class="panel-body">';
		
		for ($j=0; $j<4; $j++)
		{
			if ($j==0 || $j==2)
				echo '<div class="row">';
			echo '
			 	<div class="col-md-6">
					<div class="radio">
					  <label>
					    <input type="radio" name="optionsRadios'.$i.'" value="option'.($i*4+$j).'" '.(($j==0)?'checked':'').'>
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
	</form>
</div>

<?php
//----------------------------- Body Ends -----------------------------------
$loginPage->EndBody();
?>