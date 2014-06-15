<?php
require_once 'Pages.php';
 
$_SESSION = array(); 
$params = session_get_cookie_params();
  
setcookie(session_name(), '', time() - 42000, $params["path"],  $params["domain"],  $params["secure"],  $params["httponly"]);
 
// Destroy session 
session_destroy();
header('Location: index.php');
?>