<?php

require_once('Page.php');


$mainPage = new Page;
$mainPage->StartHead("Test Page");
$mainPage->EndHead();
$mainPage->StartBody();
echo 'Hello World';
$mainPage->EndBody();

?>