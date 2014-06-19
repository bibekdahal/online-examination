<?php

require_once 'Pages.php';

$instructionPage->StartHead('Instructions');
$instructionPage->EndHead();
$instructionPage->StartBody();
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
            <li class="active"><a href="instructions.php">Instructions</a></li>            
            <li ><a href="exam.php"><strong>Exam Page</strong></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="timer" href="#"></a></li>
            <li ><a href="logout.php">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<br/><br/>
	<div class="container" style="font-size:20px">
		<ul>
			<li>Click on Exam Page above to start giving exam</li>
			<li>The timer during the exam at the top right corner gives the remaining time to finish the exam</li>
			<li>Total duration is 3 hours</li>
			
			
		<br/><br/>
		<a href="exam.php">Start Exam</a>
		</ul>
	</div>

<?php
$instructionPage->EndBody();

?>