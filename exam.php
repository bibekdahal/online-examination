<?php
require_once 'Pages.php';
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
	$num = 100;
	for ($i=0; $i<$num; $i++)
	{
		echo '
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">'.($i+1).'.

What is <img src="test-images/image0.png" />?<br/>


					 </h3>
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
					    Option '.($j+1).'
					  </label>
					</div>
				';
			echo '</div>';
			if ($j==1 || $j==3)
			echo '</div>';
		}
		
		echo '	  </div>
				</div>
		';
	}
?>
	</form>
</div>

<?php
//----------------------------- Body Ends -----------------------------------
$loginPage->EndBody();
?>