<?php
    include_once "common/base.php";
    $pageTitle = "Sign up on Marine Life Finder!";
    include_once "common/header.php";
	include_once "common/mainnav.php";

    if(!empty($_POST['username'])):
        include_once "inc/class.users.inc.php";
        $users = new MLFUsers($db);
        echo $users->createAccount();
    else:
?>
<div class="container">
	<!-- Example row of columns -->
	<div class="row">
        <h1>Sign up</h1>
        <h2>Sign up for an account now! Unlock features such as saving custom searches, creating favorite lists and more.</h2>
        <p>Join the community of people who share interest.</p>
        <form method="post" action="signup.php" id="registerform" role="form">
            <div class="form-group" style="width: 200px;">
                <label for="username">Email</label><br />
                <input type="text" name="username" id="username" class="form-control"  /><br />
                <input type="submit" name="register" id="register" value="Sign me up!" class="btn btn-default" role="button" />
            </div>
        </form>
	</div>
	<hr>
<div>
	
<?php
	endif;
	include_once 'common/footer.php';
?>
</div>