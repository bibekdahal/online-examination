<?php

require_once('Session.php');

class Page
{
	public function __construct(){
		echo '<!DOCTYPE HTML>';
		echo '<html>';
	}
	
	public function StartHead($title){
		echo '<head>';
		echo '<title>' .$title. '</title>';
		echo '	<meta charset="utf-8">
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">
			    <title>Bootstrap 101 Template</title>
			
			    <!-- Bootstrap -->
			    <link href="css/bootstrap.min.css" rel="stylesheet">
			    <style>
			    	body {
					  padding-top: 40px;
					  padding-bottom: 40px;
					  background-color: #eee;
					}
				</style>
			    ';
	}
	
	public function AddStyleSheet($styleSheetURI){
		echo '<link rel="stylesheet" type="text/css" href="'.$styleSheetURI.'" />';
	}
	public function AddScript($jsURI){
		echo '<script language="javascript" type="text/javascript" src="'.$jsURI.'"></script>';
	}
	
	public function EndHead(){echo '</head>';}
	public function StartBody(){echo '<body>';}
	public function EndBody()
	{
		echo '</body>';
		echo '	<script src="js/jquery.min.js"></script>
    			<script src="js/bootstrap.min.js"></script>';
	}
	
	public function __destruct(){
		echo '</html>';
	}

}


?>