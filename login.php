<?php

// Login Test User
// Username: test_user
// Password: 6ZaxN2Vzm9NUJT2y

require_once 'Pages.php';
$loginError = false;
//$user -> StartSession();




if (isset($_POST['un'], $_POST['psss'])) {
	$username = $_POST['un'];
	$password = $_POST['psss'];
	if ($user -> login($username, $password) == true) {
	} else {
		$loginError = true;
	}
}
else
{
	//echo 'no login data presented';
}

$loginPage -> StartHead("Log in");
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<?php $loginPage -> StartHead("Log in");
	$loginPage -> AddStyleSheet("css/signin.css");
	$loginPage -> Endhead();
	$loginPage -> StartBody();
	
	if($user->loggedin()){
	echo 
				header("Location: instructions.php");
				die();
			'<p>
				Continue with  <a href="exam.php">examination</a>.
			</p>';
	echo '<p>
				If you are done, please <a href="logout.php">log out</a>.
			</p>';
			$loginPage->EndBody();
			return;
}
	//---------------------------- Start of Body --------------------------------
?>
<div class="container">
	<?php
	if ($loginError == TRUE) {
		echo '
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
&times;
</button>
<strong>Oh nose!</strong> Can\'t remember you, sorry for that. 
</div>';
	}
	?>

	<form class="form-signin" action="login.php" method="post" role="form">
		<h2 class="form-signin-heading">Log in</h2>
		<input type="text"  name="un" class="form-control" placeholder="Username" required autofocus>
		<input type="password" name="pwd" class="form-control" placeholder="Password" required>
		</br>
		<button class="btn btn-lg btn-primary btn-block" type="submit" onclick="formhash(this.form, this.form.pwd);">
			Sign in
		</button>
		<div class = "form-bttmtext">
			
			<p>
				<?php
					if($user->LoggedIn()) echo 'Current Status: Logged in'; 
					else echo 'Current Status: Not logged in';
				?>
			</p>
		</div>

	</form>

</div>

<?php
//----------------------------- Body Ends -----------------------------------
$loginPage -> AddScript("js/sha512.js");
$loginPage -> AddScript("js/forms.js");
$loginPage -> EndBody();
?>