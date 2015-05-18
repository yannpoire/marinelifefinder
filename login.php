<?php
    include_once "common/base.php";
    $pageTitle = "Login Marine Life Finder";
    include_once "common/header.php";
	include_once "common/mainnav.php";
?>

<div class="container">
	<div class="row">
<?php  if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['username'])): ?>
        <p>You are currently <strong>logged in.</strong></p>
        <p><a href="/logout.php">Log out</a></p>
<?php
    elseif(!empty($_POST['username']) && !empty($_POST['password'])):
        include_once 'inc/class.users.inc.php';
        $users = new MLFUsers($db);
        if($users->accountLogin()===TRUE):
            echo "<meta http-equiv='refresh' content='0;/'>";
            exit;
        else:
?>
        <h2>Login Failed&mdash;Try Again?</h2>
        <form method="post" action="login.php" name="loginform" id="loginform">
            <div class="form-group">
            	<label for="username">Email</label>
                <input type="text" name="username" id="username" class="form-control" />
                <br /><br />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
                <br /><br />
                <input type="submit" name="login" id="login" value="Login" class="button" />
            </div>
        </form>
        <p><a href="/password.php">Did you forget your password?</a></p>
<?php endif; else: ?>

        <h2>Your list awaits...</h2>
        <form method="post" action="login.php" name="loginform" id="loginform">
            <div class="form-group">
                <input type="text" name="username" id="username" class="form-control" />
                <label for="username">Email</label>
                <br /><br />
                <input type="password" name="password" id="password" class="form-control" />
                <label for="password">Password</label>
                <br /><br />
                <input type="submit" name="login" id="login" value="Login" class="button" />
            </div>
        </form><br /><br />
        <p><a href="password.php">Did you forget your password?</a></p>
<?php endif; ?>
</div>
</div>


        <div style="clear: both;"></div>
<?php include_once "common/footer.php"; ?>