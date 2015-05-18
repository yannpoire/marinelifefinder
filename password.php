<?php
    include_once "common/base.php";
    $pageTitle = "Reset Your Password";
    include_once "common/header.php";
	include_once "common/mainnav.php";
?>

<div class="container">
	<div class="row">
		<h2>Reset Your Password</h2>
		<p>Enter the email address you signed up with and we'll send you a link to reset your password.</p>
        <form action="db-interaction/users.php" method="post">
            <div class="form-group">
                <input type="hidden" name="action" value="resetpassword" />
                <label for="username">Email</label>
                <input type="text" name="username" id="username" class="form-control" />
                <br /><br />
                <input type="submit" name="reset" id="reset" value="Reset Password" class="btn btn-default" />
            </div>
        </form>
	</div>
</div>
<?php include_once "common/footer.php"; ?>