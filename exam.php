<?php
require_once 'Pages.php';
require_once('classes/Questions.php');
$questions = new Questions;

$loginPage->StartHead('Online Exam');
$loginPage->Endhead();
$loginPage->StartBody();

$setid = 1;
$userid = 1;
//---------------------------- Start of Body --------------------------------
?>

<div class="container">
	<h1>Online Exam</h1>
	<br/><br/>
	<form role="form">
<?php
	$num = $questions->GetNumQuestions($setid);
	for ($i=0; $i<$num; $i++)
	{
		$questions->GetQuestion($setid, $i+1, $q, $o[0], $o[1], $o[2], $o[3]);
		echo '
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">'.($i+1).'. ' . $q .
					 '</h3>
				  </div>
				  <div class="panel-body">';
		
		for ($j=0; $j<4; $j++)
		{
			$option = $questions->GetAnswer($userid, $setid, $i+1);
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
	echo '$(\'input[name="optionsRadios'.$i.'"]\').change( function() {var j = parseInt($(this).val()); answer('.($i+1).', j);});';
	?>});

function answer(sn, option)
{
	$.post( "answer.php", { userid: <?php echo $userid ?>, setid: <?php echo $setid ?>, qsn: sn, option: option } ,
  function(data,status){
    //alert("Data: " + data + "\nStatus: " + status);
  });
	
}
	
</script>