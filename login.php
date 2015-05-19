<?php
    include_once "common/base.php";
    $pageTitle = "Login Marine Life Finder";
    include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">
<?php  if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['username'])): ?>
        <p>You are currently <strong>logged in.</strong></p>
        <p><a href="/logout.php">Log out</a></p>
<?php
    elseif(!empty($_POST['username']) && !empty($_POST['password'])):
        include_once 'inc/class.users.inc.php';
        $users = new MLFUsers($db);
        if($users->accountLogin()===TRUE):
            echo "<meta http-equiv='refresh' content='0;".BASE_URL."'>";
            exit;
        else:
?>
        <h2>Login Failed&mdash;Try Again?</h2>
        <form method="post" action="login.php" name="loginform" id="loginform">
            <div class="form-group">
            	<label for="username">Email</label>
                <input type="text" name="username" id="username" class="" required="required" autofocus="autofocus"/>
                <br /><br />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="" required="required" />
                <br /><br />
                <input type="submit" name="login" id="login" value="Login" class="button" />
            </div>
        </form>
        <p><a href="/password.php">Did you forget your password?</a></p>
<?php endif; else: ?>

        <h2>Your list awaits...</h2>
        <form method="post" action="login.php" name="loginform" id="loginform">
            <div class="form-group">
            	<label for="username">Email</label>
                <input type="text" name="username" id="username" class="" required="required" autofocus="autofocus" />
                <br /><br />
				<label for="password">Password</label>
                <input type="password" name="password" id="password" class="" required="required" />
                <br /><br />
                <input type="submit" name="login" id="login" value="Login" class="button" />
            </div>
        </form><br /><br />
        <p><a href="password.php">Did you forget your password?</a></p>
<?php endif; ?>
	</div>
	<div class="col-md-4"></div>
</div>
	<?php include_once ROOT_PATH."common/footer.php"; ?>
</div>
