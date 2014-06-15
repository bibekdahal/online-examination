<?php
require_once 'Pages.php';

/*

if (isset($_POST['email'], $_POST['p'])) {
$email = $_POST['email'];
$password = $_POST['p']; // The hashed password.

if (login($email, $password, $mysqli) == true) {
// Login success
header('Location: ../protected_page.php');
} else {
// Login failed
header('Location: ../index.php?error=1');
}
} else {
// The correct POST variables were not sent to this page.
echo 'Invalid Request';
}

*/


$user->GetSession()->Start();
$loginPage -> StartHead("Log in");
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<?php $loginPage -> AddStyleSheet("css/bootstrap.min.css");
$loginPage -> Endhead();
$loginPage -> StartBody();


//---------------------------- Start of Body --------------------------------
?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Project name</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#about">About</a>
				</li>
				<li>
					<a href="#contact">Contact</a>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
<div class="container">

	<br/>
	<br/>
	<br/>

	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
			&times;
		</button>
		<strong>Warning!</strong> Better check yourself, you're not looking too good.
	</div>

	<form class="form-signin" role="form">
		<h2 class="form-signin-heading">Please sign in</h2>

		<input type="email" class="form-control" placeholder="Email address" required autofocus>
		<input type="password" class="form-control" placeholder="Password" required>

		<label class="checkbox">
			<input type="checkbox" value="remember-me">
			Remember me </label>
		<button class="btn btn-lg btn-primary btn-block" type="submit">
			Sign in
		</button>

	</form>
</div>

<?php
//----------------------------- Body Ends -----------------------------------
$loginPage -> AddScript("js/jquery.min.js");
$loginPage -> AddScript("js/bootstrap.min.js");
$loginPage -> EndBody();
?>