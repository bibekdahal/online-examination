<?php
require_once 'Pages.php';
$loginPage->StartHead("Log in");
$loginPage->AddStyleSheet("css/signin.css");
$loginPage->Endhead();
$loginPage->StartBody();

//---------------------------- Start of Body --------------------------------
?>
    <div class="container">
      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="number" pattern="[0-9]*" class="form-control" placeholder="Roll Number" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </form>
</div>

<?php
//----------------------------- Body Ends -----------------------------------
$loginPage->EndBody();
?>