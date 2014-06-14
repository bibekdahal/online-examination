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
	}
	
	public function AddStyleSheet($styleSheetURI){
		echo '<link rel="stylesheet" type="text/css" href="'.$styleSheetURI.'" />';
	}
	public function AddScript($jsURI){
		echo '<script language="javascript" type="text/javascript" src="'.$jsURI.'"></script>';
	}
	
	public function EndHead(){echo '</head>';}
	public function StartBody(){echo '<body>';}
	public function EndBody(){echo '</body>';}
	
	public function __destruct(){
		echo '</html>';
	}

}


?>