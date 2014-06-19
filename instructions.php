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
            <li class="active"><a href="instructions.php">Instruction</a></li>            
            <li ><a href="exam.php"><strong>Exam Page</strong></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="timer" href="#"></a></li>
            <li ><a href="./">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">
	</div>

<?php
$instructionPage->EndBody();

?>